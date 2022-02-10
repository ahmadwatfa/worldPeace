<?php


namespace App\Repository;

use App\Http\Controllers\Api\BaseController;
use App\Models\Api\FcmToken ;
use App\Models\Api\Notification ;
use App\Models\FcmNotification;

use App\Models\User;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class NotificationRepository extends BaseController
{

    function sendNotification($sender_id, $recever_id, $event, $event_id)
    {

        if ($sender_id != $recever_id) {
            // create notification
            $notification = $this->createNotification($sender_id, $recever_id, $event, $event_id);

            $tokens = FcmToken::where('user_id', $recever_id)->where('status', 1)->pluck('fcm_token')->toArray();

            $sender = User::find($sender_id);
            $title = __('app.notification_action.' . $event);
            $message = __('app.notification_message.' . $event, ['user' => $sender->name]);

            if (count($tokens) > 0)
                $this->fcm($title, $message, $notification, $tokens);
//            $fcm=$this->fcm($title, $message, $notification, $tokens);
        }
    }

    function fcm($title, $body, $data, $tokens, $badge = 1)
    {

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
            ->setSound('default')->setBadge($badge);

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => $data]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $downstreamResponse = FcmToken::sendTo($tokens, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();

        // return Array - you must remove all this tokens in your database
        $downstreamResponse->tokensToDelete();

        // return Array (key : oldToken, value : new token - you must change the token in your database)
        $downstreamResponse->tokensToModify();

        // return Array - you should try to resend the message to the tokens in the array
        $downstreamResponse->tokensToRetry();

        // return Array (key:token, value:error) - in production you should remove from your database the tokens
        $downstreamResponse->tokensWithError();

        $fcm = [
            'numberSuccess' => $downstreamResponse->numberSuccess(),
            'numberFailure' => $downstreamResponse->numberFailure(),
            'numberModification' => $downstreamResponse->numberModification()
        ];


        return $fcm;
    }

    function createNotification($sender_id, $recever_id, $event, $event_id)
    {
        $notification = Notification::create([
            'user_id' => $sender_id,
            'receaver_id' => $recever_id,
            'event' => $event,
            'event_id' => $event_id
        ]);
        return $notification;
    }
}

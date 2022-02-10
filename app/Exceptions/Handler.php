<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $e)
    {
        if ($e instanceof ValidationException){
            if ($request->wantsJson()){
                $errors = [];
                $error = [];
                $message = null;

                foreach ($e->errors() as $key => $value){
                    $error['field_name']=$key;
                    $error['message']=$value[0];

                    if (!isset($message))
                    $message = $value[0];
                    $errors[] = $error;
                }

                return response()->json([
                    'status'=>false,
                    'statusCode'=>422,
                    'message'=>$message,
                    'items'=>$errors,
                ]);

            }
        }
        return parent::render($request, $e); // TODO: Change the autogenerated stub
    }

}

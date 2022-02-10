<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\RestPasswordRepository;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    private $restPassword;
    public function __construct(RestPasswordRepository $restPassword)
    {
        $this->$restPassword = $restPassword;
    }
    public function rest(Request $request)
    {
        return  $this->RestPasswordRepository->forget($request->all());
    }
}

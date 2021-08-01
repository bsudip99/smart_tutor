<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        echo "a";
    }

    public function session_auth_admin()
    {
            if(session()->has('LoggedUserID')){
                return true;
            }

    }

    public function session_auth_user()
    {
            if(session()->has('name')){
                return true;
            }

    }
   
    
}

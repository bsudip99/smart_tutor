<?php

namespace App\Http\Traits;

trait AuthTrait
{
    public function session_auth_admin()
    {
            if(session()->has('LoggedUserID')){
                return true;
            }
            else{
                return redirect('/admin')->with('fail','Cannot access the page without Login');
            }

    }

    public function session_auth_user()
    {
            if(session()->has('name')){
                return true;
            }
            else
            {
                return redirect('/')->with('fail','Cannot access the page without Login');
            }

    }
}
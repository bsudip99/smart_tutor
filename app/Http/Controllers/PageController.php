<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Subjects;


class PageController extends Controller
{
    public function index()
    {
        $subject = new Subject();
        $subject_data['subjects'] = $subject->where('status','1')->select()->get();
        return view('pages.index',['subject_data'=>$subject_data]);
    }

     public function profile()
    {
       if(session()->has('name'))
       {
        return view('pages.profile');  
       }
       return redirect('/')->with('fail', 'Cannot access the page without Login');
    }

    public function myProfile()
    {
       if(session()->has('name'))
       {
            $user= Str::lower(session()->all()['table']);
            return redirect($user.'/myprofile');
       }
       return redirect('/')->with('fail', 'Cannot access the page without Login');
    }



   
}

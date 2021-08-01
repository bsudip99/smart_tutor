<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Classes;
use App\Models\Requests;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Tutor;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
      
        return view('admin.login_page');
    }

    public function login_page()
    {
        return view('admin.login_page');
    }

    public function login(Request $req)
    {
    //Validate
        $req->validate([
            'email_id'=>'required|email',
            'password'=>'required'
        ]);
        
        $userInfo = Admin::where('email_id','=', $req->email_id)->first();

        if(!$userInfo){
            
            return back()->with('fail', 'No Email found');
        }
        else
        {
            if(Hash::check($req->password, $userInfo->password))
            {
                
                
                $req->session()->put('LoggedUserID',$userInfo->id);
                $req->session()->put('LoggedUserName',$userInfo->name);
                return redirect('admin/dashboard')->with('success','Welcome to Smart Tutor Admin');

            }
            else
            {

            
                return back()->with('fail','Incorrect Password');
            }
        }
        
   
    }

    public function dashboard()
    {

        if(session()->has('LoggedUserName')){

        $tutors= new Tutor();
        $students= new Student();
        $subjects= new Subject();
        $classes= new Classes();
        $requests= new Requests();

        $tutor = $tutors->count();
        $student = $students->count();
        $subject = $subjects->count();
        $class = $classes->count();
        $request = $requests->count();

        

        return view('admin.dashboard',["tutor"=>$tutor,"student"=>$student,"subject"=>$subject,"class"=>$class,"request"=>$request]);
        }
        else{
            return redirect('/admin/login_page')->with('fail','You need to login first');
        }
    }

    public function logout()
    {
       session()->flush();
        Auth::logout();
       return redirect('/admin');
       

    }


   
}

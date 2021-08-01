<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Tutor;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use App\Models\Classes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;




class LoginController extends Controller
{
    public function index()
    {
    }



    public function login(Request $req)
    {

        //Validate
        $req->validate([
            'email_id' => 'required|email',
            'password' => 'required'
        ]);

        if ($req->user == "Tutor") {
            $userInfo = Tutor::where('email_id', '=', $req->email_id)->first();
        } elseif ($req->user == "Student") {
            $userInfo = Student::where('email_id', '=', $req->email_id)->first();
        }

        if (!$userInfo) {

            return back()->with('fail', 'No Email found');
        } else {

            if (Hash::check($req->password, $userInfo->password)) {


                $req->session()->put('id', $userInfo->id);
                $req->session()->put('name', $userInfo->name);
                session([
                    'id' => $userInfo->id,
                    'name' => $userInfo->name,
                    'email_id' => $userInfo->email_id,
                    'table' => Str::lower($req->user)
                ]);

                return redirect('myProfile')->with('success', 'Welcome to Smart Tutor ');
                // if ($req->user == "Tutor") {
                //     return redirect('tutor/profile/'.$userInfo->id)->with('success', 'Welcome to Smart Tutor ');
                // } elseif ($req->user == "Student") {
                //     return redirect('student/profile')->with('success', 'Welcome to Smart Tutor ');
                // }
            } else {
                return back()->with('fail', 'Incorrect Password');
            }
        }
    }

    public function register(Request $req)
    {


        $name = $req->name;
        $gender = $req->gender;
        $phone_no = $req->phone_no;
        $email = $req->email_id;
        $pass_not_hash = $req->password;
        $password = Hash::make($req->password);
        $dob = $req->dob;
        $address = $req->address;
    

       
    

        

        if ($req->user == "0") {

            $req->validate([
                'name' => 'required',
                'phone_no' => 'required',
                'email_id' => 'required|email|unique:tutors,email_id',
                'password' => 'required',
                'psw-repeat' => 'required_with:password|same:password'
            ]);
          

            try {
                $tutor = new Tutor;
                $tutor->name = $name;
                $tutor->dob = $dob;
                $tutor->email_id = $email;
                $tutor->phone_no = $phone_no;
                $tutor->address = $address;
                $tutor->password = $password;
                $tutor->gender = $gender;
                if($req->class && $req->subject){
                    $classes = $req->class;
                    $subjects = $req->subject;
                    $len = count($req->class);
                    $cs = "";
                    for($i=1; $i < $len; $i++)
                    {
                        $temp_class = $classes[$i];
                        $temp_subject = $subjects[$i];
                        
                        $temp_cs = $temp_class.'.'.$temp_subject;
                        $cs = $cs. ",".$temp_cs;
                        if($i == "1")
                        {
                            $cs = $temp_cs;
                        }
                    
                    }
                    $subject_ids = $cs;
    
                    $tutor->subject_ids = $subject_ids;
                }
    
                if($req->fee)
                {
                    $tutor->fee = $req->fee;
                }

                if($req->experience != "none")
                {
                    $tutor->experience = $req->experience;
                }
             
                if ($tutor->save()) {
                    session([
                        'id' => $tutor->id,
                        'name' => $name,
                        'email_id' => $email,
                        'table' => 'tutor',
                    ]);

                    return redirect()->route('send-register-mail',['email' => $email,'table' => 'tutor']);
                }

                
                
                return redirect('myProfile')->with('success', 'Welcome to Smart Tutor.Please Verify your email by clicking on link we sent to your email.You wont be shown to students until you are verified ');
                // return redirect('user/profile')->with('status', "Insert successfully");
            } catch (Exception $e) {
                return redirect('user/register_page')->with('failed', "operation failed");
            }
        } elseif ($req->user == "1") {

            $req->validate([
                'name' => 'required',
                'phone_no' => 'required',
                'email_id' => 'required|email|unique:students,email_id',
                'password' => 'required',
                'psw-repeat' => 'required_with:password|same:password'
            ]);
            try {
                $student = new Student;
                $student->name = $name;
                $student->dob = $dob;
                $student->email_id = $email;
                $student->phone_no = $phone_no;
                $student->address = $address;
                $student->password = $password;
                $student->gender = $gender;
                if ($student->save()) {
                    session([
                        'id' => $student->id,
                        'name' => $name,
                        'email_id' => $email,
                        'table' => 'student'
                    ]);

                    return redirect()->route('send-register-mail',['email' => $email,'table' => 'student']);
                }
                
                return redirect('myprofile')->with('success', 'Welcome to Smart Tutor.Please Verify your email by clicking on link we sent to your email.');
            } catch (Exception $e) {
                return redirect('user/register_page')->with('failed', "operation failed");
            }
        }
    }

    public function register_page()
    {
        // $subjects = new Subject;
        // $class = new Classes;
        $subject = DB::table('subjects')->get();
        $classes = DB::table('class')->get();

        return view('pages.register',['subjects'=>$subject,'classes'=>$classes]);
    }

    public function logout()
    {
        session()->flush();
        Auth::logout();
       return redirect('/');
    }

  
}

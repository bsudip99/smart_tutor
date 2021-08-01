<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailSend;
use App\Models\Student;
use App\Models\Tutor;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MailController extends Controller
{
    public function sendEmail($email,$password) {
        $to_email = $email;
        $to_password = Crypt::encrypt($password);
        $main_text = ' You have been registered to Smart Tutor.'.' Please verify your email by clicking in below link.'.'<a href="'. URL::to('/') .'/verifyEmail?'. $to_email.'&'.$password.'" target="_blank">Click here</a>';
        $details = [
            'user' => 'Sudip ',
            'main_text' => $main_text
        ];
        print_r($details);
        exit;
        // $to_email = "sudipbhandaridon@gmail.com";

        Mail::to($to_email)->send(new MailSend($details));

        return "<p> Success! Your E-mail has been sent.</p>";

    }


    public function sendVerificationEmail()
    {
        $to_email= $email = session()->all()['email_id'];
        $user= session()->all()['table'];
        $table = session()->all()['table']."s";
        $to_password = Crypt::encrypt($to_email);
        $extra_text = '';
        $url =    '<a href="'.URL::to('/').'/verifyEmail'.$user.'?key='.$to_password.' "target="_blank">Click here</a>';
        $clean_url =  URL::to('/').'/verifyEmail'.$user.'?key='.$to_password;
        $name = "User";

        $tutors = DB::table($table)->where('email_id',$to_email)->select('name')->get();
        if(count($tutors))
        {
            $name = $tutors[0]->name;
        }
        $details = [
            'user' => $name,
            'url' => $url,
            'extra' => $extra_text,
            'clean_url' => $clean_url
        ];
        Mail::to($to_email)->send(new MailSend($details));
        return redirect($user.'/myprofile')->with('success','Email Sent to '.$to_email.'. Please Check your email to Verify');
        
    }

    public function sendRegisterEmail($email,$table)
    {
        $to_email = $email;
        $to_password = Crypt::encrypt($email);
        $user = $table;
        $table = $user."s";
        $extra_text = '';
        $url =    '<a href="'.URL::to('/').'/verifyEmail'.$user.'?key='.$to_password.' "target="_blank">Click here</a>';
        $clean_url =  URL::to('/').'/verifyEmail'.$user.'?key='.$to_password;
        $name = "User";
        
        $tutors = DB::table($table)->where('email_id',$email)->select('name')->get();
        if(count($tutors))
        {
            $name = $tutors[0]->name;
        }
        $details = [
            'user' => $name,
            'url' => $url,
            'extra' => $extra_text,
            'clean_url' => $clean_url
        ];
        Mail::to($to_email)->send(new MailSend($details));
        return redirect($user.'/myprofile')->with('success','Email Sent to '.$to_email.'. Please Check your email to Verify');
    }


    function verifyRegisterMail(Request $req)
    {
        $c_password = $req->query('key');
         try {
            $email = Crypt::decrypt($c_password);
        } catch (DecryptException $e) {
               return redirect('/')->with('fail','Email Not Verified. Try Again!');
        }

        $tutors_model = new Tutor();
        $tutors = $tutors_model->where('email_id',$email)->select('id','name')->get();
        if(count($tutors))
        {
                $tutors_model->where('id',$tutors[0]->id)->update(['email_verify' => '1']);
                return redirect('/')->with('success','Email Verified.');
        }
        return redirect('/')->with('fail','Email Not Verified. Try Again!');
        
    }

    function verifyRegisterMailStudent(Request $req)
    {
        $c_password = $req->query('key');

        
         try {
            $email = Crypt::decrypt($c_password);
        } catch (DecryptException $e) {

            return redirect('/')->with('fail', 'Email Not Verified. Try Again');
        }

        $student_model = new Student();
        $students = $student_model->where('email_id',$email)->select('id','name')->get();
        if(count($students))
        {
                $student_model->where('id',$students[0]->id)->update(['email_verify' => '1']);
                return redirect('/')->with('success','Email Verified.');
        }
        return redirect('/')->with('fail','Email Not Verified. Try Again!');
        
    }


    function forgotPassword(Request $req)
    {
        
        $email = $req->email_id;
        $user_id = $req->user;
        if($user_id == "Tutor")
        {
            $table_model = new Tutor();
            $data = $table_model->where('email_id',$email)->select('id','name')->get();
        }
        elseif($user_id == "Student")
        {
            $table_model = new Student();
            $data = $table_model->where('email_id',$email)->select('id','name')->get();
        }

        if(count($data))
        {
            $rand = rand(10000000,99999999);
            $password = Hash::make($rand);
            $table_model->where('id',$data[0]->id)->update(['password'=>$password]);
            $name = $data[0]->name;

            $details = [
                'user' => $name,
                'password'=>$rand
            ];
            Mail::to($email)->send(new ForgotPassword($details));
            return response()->json(['success'=>'Your password is changed and mail is sent!']);
        
        }
        else
        {
        return response()->json(['success'=>'Your email is not registered!']);
        }
    }

}
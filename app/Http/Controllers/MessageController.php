<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Requests;
use App\Models\Student;
use App\Models\Tutor;
use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Validator;

use App\Lib\PusherFactory;

class MessageController extends Controller
{


    
    //admin

    public function index()
    {
        if(session()->has('name'))
        {

            $table_name = session()->all()['table']."s_id";
            $user_id = session()->all()['id'];
            if(session()->all()['table'] == "tutor")
            {
                $select_id = "students_id";
                $users_model = new Student();
            }
            elseif(session()->all()['table'] == "student")
            {
                $select_id = "tutors_id";
                $users_model = new Tutor();
            }
          
            
            DB::enableQueryLog();

                $requests = new Requests();
                $select_ids = $requests->where($table_name,'=',"$user_id")->where('status','=','1')->get($select_id)->toArray();
            
                if(count($select_ids))
                {
                
              
                    foreach($select_ids as $select_id_1){
                        $user_array[] = $select_id_1[$select_id];
                        // $user_array = array('1','2');
                    }
                   
                    $users = $users_model->whereIn('id',$user_array)->select()->get();
                }
                return view('pages.message.home', ['users'=> $users]);
            

          

        }

        return redirect('/')->with('fail', 'Cannot access the page without Login');
    }


    public function getLoadLatestMessages(Request $request)
    {

        if(!session()->has('name'))
        {
            return redirect('/')->with('fail', 'Cannot access the page without Login');
        }
        if(!$request->user_id) {
            return;
        }
       
            
        DB::enableQueryLog();
        $messages_model = new Message();
            $user_id = session()->all()['id'];

            if(session()->all()['table'] == "tutor")
            {
               $student_id = $request->user_id;
               $tutors_id = $user_id;
            }

            elseif(session()->all()['table'] == "student")
            {
                $tutors_id = $request->user_id;
                $student_id = $user_id;
            }
            // $messages = $messages_model->where('tutors_id', $user_id)->where('students_id', $request->user_id)->orWhere('tutors_id', $request->user_id)->orWhere('students_id', $user_id)->get();
            $messages = $messages_model->join('tutors','chat.tutors_id','=','tutors.id')->join('students','chat.students_id','=','students.id')->where('chat.tutors_id', $tutors_id)->where('chat.students_id', $student_id)->orderBy('created_at', 'DESC')->select('chat.*','tutors.name as tutors_name','tutors.pic as tutors_pic','students.name as students_name','students.pic as students_pic')->get()->toArray();
// dd(DB::getQueryLog());

        $return = [];
        foreach ($messages as $message) {
           
            $return[] = view('pages.message.message-line')->with('message', $message)->render();
        }
        return response()->json(['state' => 1, 'messages' => $return]);
    }

    public function postSendMessage(Request $request)
    {

        if(!session()->has('name'))
        {
            return redirect('/')->with('fail', 'Cannot access the page without Login');
        }
        if(!$request->to_user || !$request->message) {
            return;
        }

        $message = new Message();
        $user_id = session()->all()['id'];

        $message->sender =session()->all()['table'];
     
        if(session()->all()['table'] == "tutor")
        {
           $message->tutors_id = $user_id;
           $message->students_id = $request->to_user;
        }
        elseif(session()->all()['table'] == "student")
        {
            $message->students_id = $user_id;
           $message->tutors_id = $request->to_user;


        }
        $message->chat_text = $request->message;
        $message->save();
        // prepare some data to send with the response
        // $dateTime = \Carbon\Carbon::parse($message['created_at']);
        
        // $message->dateTimeStr = date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString()));
        // $message->dateHumanReadable = $message->created_at->diffForHumans();
        // $message->fromUserName = $message->fromUser->name;
        // $message->from_user_id = Auth::user()->id;
        // $message->toUserName = $message->toUser->name;
        // $message->to_user_id = $request->to_user;

        // PusherFactory::make()->trigger('chat', 'send', ['data' => $message]);
        // return response()->json(['state' => 1, 'data' => $message]);


    }


}
   

   


 

   
   
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Requests;
use App\Models\Student;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Validator;

class RequestController extends Controller
{

    //admin
    public function requestList()
    {

        if(session()->has('LoggedUserName'))
        {
            $requests = DB::select('SELECT r.*,t.name as tutor_name ,s.name as student_name FROM request r INNER JOIN tutors t INNER JOIN students s  ON r.tutors_id = t.id AND r.students_id = s.id ');
            return view('admin.requestlist', ['requests'=> $requests]);
        }
        return redirect('/admin')->with('fail', 'Cannot access the page without Login');

    }

    public function requestAdd()
    {
        if(session()->has('LoggedUserName'))
        {
            $tutors = DB::select('Select name,id from tutors');
            $students = DB::select('Select name,id from students');
            // $subjects = DB::select('Select subject,id from subjects');
            return view('admin.editRequest',['tutors'=>$tutors, 'students'=>$students]);
        }
        return redirect('/admin')->with('fail', 'Cannot access the page without Login');
   

    }

    public function addRequest(Request $req)
    {
        if(session()->has('LoggedUserName'))
        {
            $request = new Requests;
            $request->tutors_id = $req->tutor_id;
            $request->students_id = $req->student_id;
            // $request->subject_id = $req->subject_id;
            $request->request_text = $req->request_text;
            if($request->save())
            {
                return redirect('/admin/requestLists')->with('success', 'New Request Added');
            }

            
          
        }
        return redirect('/admin')->with('fail', 'Cannot access the page without Login');
   
    }




    public function approveRequest($id)
    {
        if(session()->has('LoggedUserName'))
        {
            $requests = DB::update('update request set status = "1" where id = ?', [$id]); 
          
            return redirect('/admin/requestLists')->with('success', 'Update Succesful');
        }
        return redirect('/admin')->with('fail', 'Cannot access the page without Login');
   

    }

    public function unapproveRequest($id)
    {
        if(session()->has('LoggedUserName'))
        {
            $requests = DB::update('update request set status = "0" where id = ?', [$id]); 
          
            return redirect('/admin/requestLists')->with('success', 'Update Succesful');
        }
        return redirect('/admin')->with('fail', 'Cannot access the page without Login');
   

    }



    public function sendRequest(Request $req)
    {
        if(session()->has('name'))
        {
          
        $validator  = Validator::make($req->all(), [
            'request_text' =>'required'
        ]);

        if ($validator->passes()) {
            $request = new Requests;
            $request->tutors_id = $req->tutor_id;
            $request->students_id = session()->all()['id'];
            $request->request_text = $req->request_text;
            if($request->save()){
            return response()->json(['success'=>'Sent Request succesfully']);
            }  
            
        }
        return response()->json(['error'=>$validator->errors()->all()]);
        

    }
    return response()->json(['error'=>'You need to login to send request']);
    }

    public function requests()
    {
        if(session()->all()['table'] == "tutor"){
            return redirect('/tutorrequests');
        }  
        elseif(session()->all()['table'] == "student")
        {
            return redirect('/studentrequests');

        }
    }


    public function tutorRequests()
    {
        $id = session()->all()['id'];
        $request = new Requests;
        $tutor_requests = DB::table('request')
                            ->where('tutors_id',$id)  
                            ->join('tutors','request.tutors_id','=','tutors.id')
                            ->join('students','request.students_id','=','students.id')
                            ->select('request.*','tutors.name as tutor_name','students.name as student_name')
                            ->get();
        return view('pages.tutorRequest',['requests' => $tutor_requests]);
    }


    public function studentRequests()
    {
        $id = session()->all()['id'];
        $request = new Requests;
        $student_requests = $request
                            ->where('students_id',$id)  
                            ->join('tutors','request.tutors_id','=','tutors.id')
                            ->join('students','request.students_id','=','students.id')
                            ->select('request.*','tutors.name as tutor_name','students.name as student_name')
                            ->get();
        return view('pages.studentRequest',['requests' => $student_requests]);
    }

    function updateReqStatus(Request $req)
    {
        $reqeust_id = $req->req_id;
        $status = $req->status;
        $request = new Requests;
        if($request->where('id',$reqeust_id)->update(['status' => $status]))
        {   
            if($status == "1"){
                return response()->json(['success'=>'Approved succesfully']);
            }
            else
            {
                return response()->json(['success'=>'Unapproved succesfully']); 
            }
        }
        else
        {
            return response()->json(['fail'=>'Update Not Succesful']); 
        }
    }


    //admin above

  
}

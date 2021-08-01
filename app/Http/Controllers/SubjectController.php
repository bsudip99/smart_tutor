<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Subject;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function subjectList()
    {

        
        if(session()->has('LoggedUserName'))
        {
            $subjects = DB::select('Select * FROM subjects');
            return view('admin.subjectlist', ['subjects'=> $subjects]);
        }
        return redirect('/admin/login_page')->with('fail', 'Cannot access the page without Login');

       
       
       
    }

    public function subjectAdd()
    {
        if(session()->has('LoggedUserName'))
        {
        return view('admin.editSubject');
        }
        return redirect('/admin/login_page')->with('fail', 'Cannot access the page without Login');
    }

    public function addSubject(Request $req)
    {
        if(session()->has('LoggedUserName'))
        {
          
            $subject = new Subject;
            $subject->subject = $req->name;
            $subject->detail = $req->subject_detail;
            $subject->status = $req->active;
            if(!$req->active)
            {
                $subject->status ="0";
            }
            $update_data[] = array('subject'=>$subject->subject,'detail'=>$subject->detail,'status'=>$subject->status);
            if($req->id)
            {
              $subject->id = $req->id;
             if($subject->whereId($subject->id)->update($update_data[0]))
             {
                return redirect('/admin/subjectLists')->with('success', 'Subject Updated');

             }
            }
            else{

              if($subject->save())
              {
                  return redirect('/admin/subjectLists')->with('success', 'New Subject Added');
              }

            }
         
            
          
        }
        return redirect('/admin/login_page')->with('fail', 'Cannot access the page without Login');
   
    }

    
    function editSubject($id = NULL)
    {
        if(session()->has('LoggedUserID'))
       {
        $subjects = DB::table('subjects')->where('id',$id)->first();
        return view('admin.editSubject',['subjects'=>$subjects]);  
       }
       return redirect('/admin/login_page')->with('fail', 'Cannot access the page without Login');
    }


    function deleteSubject($id)
    {
        if(session()->has('LoggedUserID'))
        {
         $subjects = DB::table('subjects')->where('id',$id)->delete();
         return redirect('/admin/subjectLists')->with('success','Subject Deleted');
        }
        return redirect('/admin')->with('fail', 'Cannot access the page without Login');
     
    }

  
}

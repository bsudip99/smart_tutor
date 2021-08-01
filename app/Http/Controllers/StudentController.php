<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;

class StudentController extends Controller
{
    public function studentList()
    {
 
        if(session()->has('LoggedUserID'))
        {
              
            $students = DB::select('select * from students');
       

            return view('admin.studentlist', ['students'=> $students]);  
        }
        return redirect('/admin')->with('fail', 'Cannot access the page without Login');
       
    }

    public function studentAdd()
    {
        
        if(session()->has('LoggedUserID'))
        {
         return view('admin.editStudent');  
        }
        return redirect('/admin')->with('fail', 'Cannot access the page without Login');
  
    }

    public function addStudent(Request $req)
    {
        if(session()->has('LoggedUserName'))
        {
          
            $student = new Student;
            $student->name = $req->name;
            $student->dob = $req->dob;
            $student->phone_no = $req->phone_no;
            $student->email_id = $req->email_id;
            if($req->password)
            {
              $student->password = Hash::make($req->password);
            }
            $student->address = $req->address;
            $student->biography = $req->biography;
            $student->gender = $req->gender;
          
          
            if($req->image)
            {
              $student->pic = $req->image;
            }
            if($req->id)
            {
              $student->id = $req->id;
              $student->update($student[],$req[]);
            }
            else{

              if($student->save())
              {
                  return redirect('/admin/studentLists')->with('success', 'New Student Added');
              }
            }

            
          
        }
        return redirect('/admin')->with('fail', 'Cannot access the page without Login');
   
    }


    function editProfileAdmin($id = NULL)
    {
        if(session()->has('LoggedUserID'))
       {
        $students = DB::table('students')->where('id',$id)->first();
        return view('admin.editStudent',['students'=>$students]);  
       }
       return redirect('/admin')->with('fail', 'Cannot access the page without Login');
    }


    function profile()
    {
      if(session()->has('name'))
      {
      
        $id = session()->all()['id'];
       
       $students = DB::table('students')->where('id',$id)->first();
       return view('pages.studentprofile',['student'=>$students]);  
      }
      return redirect('/')->with('fail', 'Cannot access the page without Login');
    }

    function saveStudentProfile(Request $req)
    {
      if(session()->has('name'))
      {
        $req->id = session()->all()['id'];
          $student = new Student;
          $student->name = $req->name;
         
          $student->dob = $req->dob;
          $student->phone_no = $req->phone_no;

         
          $student->address = $req->address;
          $student->biography = $req->biography;
          $student->gender = $req->gender;
         
          $update_data[] = array('name'=> $student->name,'dob'=> $student->dob, 'phone_no'=>$student->phone_no, 'address'=>$student->address,
          'biography'=>$student->biography,'gender' => $student->gender);
          if($req->password)
          {
          
            $student->password = Hash::make($req->password);
            $update_data[0] = array_merge($update_data[0], array('password' => $student->password));
          }
        
          if($req->file('image'))
          {
            $image_name = DB::table('students')->where('id',$req->id)->get('pic');
           
          
            $image = $req->file('image');
            $imagename = time().".".$image->extension();
            $filePath = public_path('storage\assets\img\student');
            $tempfilePath = public_path('storage\assets\img\temp');
            
           
            $img = Image::make($image->path());
            $img->resize(null,700,function($const){
              $const->aspectRatio();
            })->save($filePath.'/'.$imagename,100);
              // $image->move($filePath,$imagename);
            
            // $student->pic = $req->image->move($filePath,$imagename);
            $update_data[0] = array_merge($update_data[0], array('pic' => $imagename));
    
            if($image_name[0]->pic){
              $previous_image = $filePath."/".$image_name[0]->pic;
          
              if(is_file($previous_image)){
                unlink($previous_image);
                }
            }
          }

          if($req->id)
          {
           
            $student->id = $req->id;
            // $student->where('id',$req->id);
            // $student->update($update_data);

         $student->whereId($student->id)->update($update_data[0]);
          
            
           
          }
   
                return redirect('/student/profile')->with('success', 'Updated');
         
          }

          
        
      
      return redirect('/admin')->with('fail', 'Cannot access the page without Login');
 
    }

  
}

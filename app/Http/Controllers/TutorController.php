<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Tutor;
use App\Models\Subject;
// use App\Models\Classes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PageController;
use App\Http\Traits\AuthTrait;
use App\Models\Tutor_doc;
use Illuminate\Filesystem\Filesystem;
use FILE;
use Illuminate\Support\Str;
use Image;

class TutorController extends Controller
{
   use AuthTrait;

   //admin below
    public function tutorList()
    {
      if(session()->has('LoggedUserID')){
        $tutors = DB::select('select id,name,email_id,email_verify,status from tutors order by id desc');
        return view('admin.tutorlist', ['tutors'=> $tutors]);
      }

      return redirect('/admin/login_page')->with('fail', 'Cannot access the page without Login');

      
       
       
    }

    public function tutorAdd()
    {
        if(session()->has('LoggedUserID'))
        {
    
         return view('admin.editTutor');  
        }
        return redirect('/admin/login_page')->with('fail', 'Cannot access the page without Login');
    }

    public function addTutor(Request $req)
    {
        if(session()->has('LoggedUserName'))
        {

          if(!$req->id)
          {
          $req->validate([
            'name' => 'required',
            'phone_no' => 'required',
            'email_id' => 'required|email|unique:tutors,email_id',
            'password' => 'required',
          ]);
        }

            $tutor = new Tutor;
            $tutor->name = $req->name;
            $tutor->dob = $req->dob;
            $tutor->phone_no = $req->phone_no;
            $tutor->email_id = $req->email_id;
            
            $tutor->address = $req->address;
            $tutor->biography = $req->biography;
            $tutor->gender = $req->gender;
            

            $update_data[] = array('name'=>$tutor->name,'dob'=>$tutor->dob, 'phone_no'=>$tutor->phone_no, 'address'=>$tutor->address,
            'biography'=>$tutor->biography,'gender' => $tutor->gender);
    
            if($req->password)
            {
              $tutor->password = Hash::make($req->password);
              array_merge($update_data[0], array('password' => $tutor->password));
            }

            if($req->experience)
            {
              $tutor->experience = $req->experience;
              array_merge($update_data[0], array('experience' => $tutor->experience));
            }

            if($req->fee)
            {
              $tutor->fee = $req->fee;
              array_merge($update_data[0], array('fee' => $tutor->fee));
            }
           
            if($req->image)
          {
            $image_name = DB::table('tutors')->where('id',$req->id)->select('pic')->get();
          
           
            $image = $req->file('image');
            $imagename = time().".".$image->extension();
            $filePath = public_path('storage\assets\img\tutors');
            $tempfilePath = public_path('storage\assets\img\temp');
          
           
            $img = Image::make($image->path());
            $img->resize(null,700,function($const){
              $const->aspectRatio();
            })->save($filePath.'/'.$imagename,100);
           
            $update_data[0] = array_merge($update_data[0], array('pic' => $imagename));
         
            if(count($image_name)){
            $previous_image = $filePath."/".$image_name[0]->pic;
            if(is_file($previous_image)){
            unlink($previous_image);
            }
          }
          }

          
            if($req->id)
            {
            $tutor->id = $req->id;
            $tutor->whereId($tutor->id)->update($update_data[0]);
            return redirect('/admin/tutorLists')->with('success', 'Tutor Updated');

            }
            else{

              if($tutor->save())
              {
                  return redirect('/admin/tutorLists')->with('success', 'New Tutor Added');
              }
            }

            
          
        }
        return redirect('/admin/login_page')->with('fail', 'Cannot access the page without Login');
   
    }


    function editProfileAdmin($id = NULL)
    {
        if(session()->has('LoggedUserID'))
       {
        $tutors = DB::table('tutors')->where('id',$id)->first();
        return view('admin.editTutor',['tutors'=>$tutors]);  
       }
       return redirect('/admin/login_page')->with('fail', 'Cannot access the page without Login');
    }

//frontend below
    public function profile($id=NULL)
    {
        $tutors = DB::table('tutors')->where('id',$id)->first();
      
        $class = DB::table('class')->get();
        $subjects = DB::table('subjects')->where('status','1')->get();
        return view('pages.profile',['tutor'=>$tutors,'subjects'=>$subjects,'class'=>$class]);  
    }

    
    function myProfile()
    {
      if(session()->has('name'))
      {
       
        if(session()->all()['table'] == "tutor"){
        $id = session()->all()['id'];
        $subject = DB::table('subjects')->where('status','1')->get();
        $classes = DB::table('class')->get();


       $tutors = DB::table('tutors')->where('tutors.id',$id)->leftJoin('tutors_document','tutors.id','=','tutors_document.tutors_id')->first();
       return view('pages.tutorprofile',['tutor'=>$tutors,'subjects'=>$subject,'classes'=>$classes]);  
        }
        else
        {
          return redirect('/')->with('fail', 'Cannot access the page without Tutor Login');
        }
      }
      return redirect('/')->with('fail', 'Cannot access the page without Login');
    }

    function tutors(Request $req)
    {       
      $name = Str::lower($req->name);
      $address = Str::lower($req->address);
      $subject = $req->subject;
      $class = $req->class;
   

      DB::enableQueryLog();
      $tutors = DB::table('tutors')->whereRaw("status = '1'");
      if($name)
      {
      $tutors->whereRaw("lower(`name`) like '%".$name."%'");
      }

      if($address)
      {
      $tutors->whereRaw("lower(`address`) like '%".$address."%'");
      }

      if($subject)
      {
      $tutors->whereRaw("subject_ids like '%.".$subject."%'");
      }
      if($class)
      {
          $tutors->whereRaw("subject_ids like '%".$class.".%'");
      }
    $tutors= $tutors->select(['id','name','address','biography','gender','pic','subject_ids'])->paginate(6);
   
   
      $class = DB::table('class')->get();
      $subjects = DB::table('subjects')->where('status','1')->get();

      if ($req->ajax()) {
    		$view = view('data.data',compact('tutors'))->render();
            return response()->json(['html'=>$view]);
      }

     
   
      return view('pages.alltutor',['tutors'=>$tutors,'class'=>$class,'subjects'=>$subjects]);  
      
    }


   

    function savetutorProfile(Request $req)
    {
      if(session()->has('name'))
      {
        $req->id = session()->all()['id'];
          $tutor = new Tutor;
          $tutor->name = $req->name;
         
          $tutor->dob = $req->dob;
          $tutor->phone_no = $req->phone_no;

         
          $tutor->address = $req->address;
          $tutor->biography = $req->biography;
          $tutor->gender = $req->gender;
          $tutor->fee = $req->fee;
          $tutor->experience = $req->experience;
         
          $update_data[] = array('name'=>$tutor->name,'dob'=>$tutor->dob, 'phone_no'=>$tutor->phone_no, 'address'=>$tutor->address,
          'biography'=>$tutor->biography,'gender' => $tutor->gender,'fee'=>$tutor->fee,'experience'=>$tutor->experience);
          if($req->password)
          {
          
            $tutor->password = Hash::make($req->password);
            $update_data[0] = array_merge($update_data[0], array('password' => $tutor->password));
          }
        
          if($req->file('image'))
          {
            $image_name = DB::table('tutors')->where('id',$req->id)->select('pic')->get();
          
           
            $image = $req->file('image');
            $imagename = time().".".$image->extension();
            $filePath = public_path('storage\assets\img\tutors');
            $tempfilePath = public_path('storage\assets\img\temp');
          
           
            $img = Image::make($image->path());
            $img->resize(null,700,function($const){
              $const->aspectRatio();
            })->save($filePath.'/'.$imagename,100);
           
            $update_data[0] = array_merge($update_data[0], array('pic' => $imagename));
         
            if(count($image_name)){
            $previous_image = $filePath."/".$image_name[0]->pic;
            if(is_file($previous_image)){
            unlink($previous_image);
            }
          }
          }

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
            $update_data[0] = array_merge($update_data[0], array('subject_ids' => $subject_ids));
        }

          if($req->id)
          {
        
            $tutor->id = $req->id;
            // $student->where('id',$req->id);
            // $student->update($update_data);

         $tutor->whereId($tutor->id)->update($update_data[0]);
          }
   
                return redirect('/tutor/myprofile')->with('success', 'Updated');
         
          }

          
        
      
      return redirect('/admin')->with('fail', 'Cannot access the page without Login');
 
    }

    function upload_document()
    {
      if(session()->has('name'))
      {
        $id = session()->all()['id'];
        $document = DB::table('tutors_document')->where('tutors_id',$id)->get();
        return view('pages.tutor_document',['documents' => $document]);
      }
    }

    function submitDocument(Request $req)
    {
      if(session()->has('name'))
      {
        $req->validate([
          'citizenship_doc' => 'required_without:qualification_doc',
          'phone_no' => 'required_without:citizenship_doc',
      ]);

        $tutor_doc = new Tutor_doc;
        $id = session()->all()['id'];
          $tutor_doc->tutors_id = $id;

        if($req->file('citizenship_doc'))
        {
          $image_name = DB::table('tutors_document')->where('tutors_id',$id)->get('citizenship_doc');
          $image = $req->file('citizenship_doc');
          $imagename = time().".".$image->extension();
          $filePath = public_path('storage\assets\img\document\citizenship');
          $tempfilePath = public_path('storage\assets\img\temp');
        
        
          $img = Image::make($image->path());
          $img->resize(null,700,function($const){
            $const->aspectRatio();
          })->save($filePath.'/'.$imagename,100);
  
   
          if(count($image_name)){
            $update_data[] = array('citizenship_doc' => $imagename);
            $previous_image = $filePath."/".$image_name[0]->citizenship_doc;
            if(file_exists($previous_image)){
              unlink($previous_image);
            }
          }
          else
          {
            $tutor_doc->citizenship_doc = $imagename;
          }
        }

        if($req->file('qualification_doc'))
      {
      
        $image_name = DB::table('tutors_document')->where('tutors_id',$id)->get('qualification_certificate');
        $image = $req->file('qualification_doc');
        $imagename = time().".".$image->extension();
        $filePath = public_path('storage\assets\img\document\qualification');
        $tempfilePath = public_path('storage\assets\img\temp');
      
       
        $img = Image::make($image->path());
        $img->resize(null,700,function($const){
          $const->aspectRatio();
        })->save($filePath.'/'.$imagename,100);
       
       
      
        if(count($image_name)){
          if($req->file('citizenship_doc')){
            $update_data[0] = array_merge($update_data[0],array('qualification_certificate' => $imagename));
          }
          else
          {
            $update_data[] = array('qualification_certificate' => $imagename);
          }
          $previous_image = $filePath."/".$image_name[0]->qualification_certificate;
       
          if(file_exists($previous_image)){
            unlink($previous_image);
          }
        }
        else
        {
          $tutor_doc->qualification_certificate = $imagename;
        }
      }

    
      if(count($image_name) && $update_data){
        
        $tutor_doc->where('tutors_id',$id)->update($update_data[0]);
  
      }
      else
      {

        $tutor_doc->save();
      }
  
      return redirect('/uploadDocument')->with('success', 'Updated');

      }
    }


    function tutorRequests()
    {
      
    }

    function getTutorContactDetail(Request $req)
    {
      $id= $req->tutor_id;
      $tutors = new Tutor;
      $tutors_contact = $tutors->where('id',$id)->select('name','phone_no','email_id')->get();
      return response()->json($tutors_contact);
 
    }


    function TutorDetailAjax(Request $req)

    {
      $id= $req->id;

      $tutors = new Tutor;
      // DB::table('tutors')->where('tutors.id',$id)->leftJoin('tutors_document','tutors.id','=','tutors_document.tutors_id')->first();
      $tutors_contact = DB::table('tutors')->where('tutors.id',$id)->leftJoin('tutors_document','tutors.id','=','tutors_document.tutors_id')->select('tutors.*','tutors_document.qualification_certificate' , 'tutors_document.citizenship_doc')->get();
      return response()->json($tutors_contact);

    }


    public function approveTutor($id)
    {
        if(session()->has('LoggedUserName'))
        {
            $requests = DB::update('update tutors set status = "1" where id = ?', [$id]); 
          
            return redirect('/admin/tutorLists')->with('success', 'Update Succesful');
        }
        return redirect('/admin')->with('fail', 'Cannot access the page without Login');
   

    }

    public function unapproveTutor($id)
    {
        if(session()->has('LoggedUserName'))
        {
            $requests = DB::update('update tutors set status = "0" where id = ?', [$id]); 
          
            return redirect('/admin/tutorLists')->with('success', 'Update Succesful');
        }
        return redirect('/admin')->with('fail', 'Cannot access the page without Login');
   

    }
   


  
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Classes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClassesController extends Controller
{
    public function classList()
    {

        
        if(session()->has('LoggedUserName'))
        {
            $classes = DB::select('Select * FROM class order by from_class asc');
            return view('admin.classList', ['classes'=> $classes]);
        }
        return redirect('/admin')->with('fail', 'Cannot access the page without Login');

       
       
       
    }

    public function classAdd()
    {
        return view('admin.editClass');
    }

    public function addClass(Request $req)
    {
        if(session()->has('LoggedUserName'))
        {
          
            $classes = new Classes();
            $classes->from_class = $req->from_class;
            $classes->to_class = $req->to_class;
            $classes->comment = $req->comment;

            $update_data[] = array('from_class'=>$classes->from_class,'to_class'=>$classes->to_class,'comment'=>$classes->comment);
            if($req->id)
            {
              $classes->id = $req->id;
             if($classes->whereId($classes->id)->update($update_data[0]))
             {
                return redirect('/admin/classLists')->with('success', 'Class Updated');

             }
            }
            else{

              if($classes->save())
              {
                  return redirect('/admin/classLists')->with('success', 'New Class Added');
              }

            }          
        }
        return redirect('/admin')->with('fail', 'Cannot access the page without Login');
   
    }

    
    function editClass($id = NULL)
    {
        if(session()->has('LoggedUserID'))
       {
        $class = DB::table('class')->where('id',$id)->first();
        return view('admin.editClass',['classes'=>$class]);  
       }
       return redirect('/admin')->with('fail', 'Cannot access the page without Login');
    }

  
}

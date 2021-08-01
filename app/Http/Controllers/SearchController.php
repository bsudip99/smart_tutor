<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Subjects;
use App\Models\Tutor;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\json_decode;

class SearchController extends Controller
{
    public function ajaxTutorSearch(Request $req)
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
      $tutors=   $tutors->take(6)->get(['id','name','address','biography','gender','pic','subject_ids']);
     
  
        if ($req->ajax()) {
    		$view = view('data.search',compact('tutors'))->render();
            return response()->json(['html'=>$view]);
        }
        
    }

  



   
}

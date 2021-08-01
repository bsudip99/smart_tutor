<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[PageController::class,'index']);


//Route to Admin
Route::get('/admin', [AdminController::class, 'index']);

Route::get('/admin/login_page', [AdminController::class, 'login_page']);


// Route::get('/admin/add_user', [AdminController::class, 'add_user']);

Route::post('/admin/login', [AdminController::class, 'login'])->name('auth.login');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

Route::get('/admin/logout', [AdminController::class, 'logout']);


//tutor
Route::get('/admin/tutorLists', [TutorController::class, 'tutorList']);
Route::get('/admin/tutorAdd', [TutorController::class, 'tutorAdd']);
Route::any('admin/editTutor/{id}', [TutorController::class, 'editProfileAdmin']);
Route::post('admin/addTutor', [TutorController::class, 'addTutor']);
Route::any('admin/tutorDetail', [TutorController::class, 'TutorDetailAjax']);

Route::get('/admin/approveTutor/{id}', [TutorController::class, 'approveTutor']);
Route::get('/admin/unapproveTutor/{id}', [TutorController::class, 'unapproveTutor']);

//student
Route::get('/admin/studentLists', [StudentController::class, 'studentList']);
Route::get('/admin/studentAdd', [StudentController::class, 'studentAdd']);
Route::any('admin/editStudent/{id}', [StudentController::class, 'editProfileAdmin']);
Route::post('admin/addStudent', [StudentController::class, 'addStudent']);




//request
Route::get('/admin/requestLists', [RequestController::class, 'requestList']);
Route::get('/admin/requestAdd', [RequestController::class, 'requestAdd']);
Route::post('/admin/addRequest', [RequestController::class, 'addRequest']);


Route::get('/admin/approveRequest/{id}', [RequestController::class, 'approveRequest']);
Route::get('/admin/unapproveRequest/{id}', [RequestController::class, 'unapproveRequest']);

//class
Route::get('/admin/classLists', [ClassesController::class, 'classList']);
Route::get('/admin/classAdd', [ClassesController::class, 'classAdd']);
Route::post('/admin/addClass', [ClassesController::class, 'addClass']);
Route::get('/admin/editClass/{id}', [ClassesController::class, 'editClass']);



//subject
Route::get('/admin/subjectLists', [SubjectController::class, 'subjectList']);
Route::get('/admin/subjectAdd', [SubjectController::class, 'subjectAdd']);
Route::any('admin/editSubject/{id}', [SubjectController::class, 'editSubject']);
Route::post('/admin/addSubject', [SubjectController::class, 'addSubject']);
Route::any('admin/deleteSubject/{id}', [SubjectController::class, 'deleteSubject']);






//login and register


Route::post('/user/login', [LoginController::class, 'login']);

Route::post('/user/register', [LoginController::class, 'register']);


//register page
Route::get('/user/register_page', [LoginController::class, 'register_page']);

//profile page
Route::get('/user/profile', [PageController::class, 'profile']);


//tutor profile page
Route::get('/tutor/profile', [TutorController::class, 'profile']);

Route::any('tutor/profile/{id}', [TutorController::class, 'profile']);


Route::any('tutor/all', [TutorController::class, 'tutors']);

Route::post('/savetutorProfile', [TutorController::class, 'savetutorProfile']);


//tutor edit page


//student profile page

Route::get('/student/profile', [StudentController::class, 'profile']);
Route::get('/student/myprofile', [StudentController::class, 'profile']);
Route::post('/saveStudentProfile', [StudentController::class, 'saveStudentProfile']);


//myprofile
Route::get('/myProfile', [PageController::class, 'myProfile']);

//tutorMyprofile
Route::get('/tutor/myprofile', [TutorController::class, 'myProfile']);
//logout

Route::get('/logout', [LoginController::class, 'logout']);



Route::any('ajaxTutorSearch', [SearchController::class,'ajaxTutorSearch']);

Route::get('send-mail/{email}/{password}',[MailController::class,'sendEmail'] );

//tutor  verify email

Route::get('verifyEmailtutor',[MailController::class,'verifyRegisterMail']);

//student verify email
Route::get('verifyEmailstudent',[MailController::class,'verifyRegisterMailStudent']);

//tutor student send register mail
Route::get('send-register-mail/{email}/{table}',[MailController::class,'sendRegisterEmail'] )->name('send-register-mail');


//sendVerificationMail
Route::get('sendVerificationMail',[MailController::class,'sendVerificationEmail'] );



Route::any('sendSMS', [ApiController::class,'sms_api']);


Route::any('uploadDocument',[TutorController::class,'upload_document']);
Route::any('submitDocument',[TutorController::class,'submitDocument']);



Route::any('/deleteSubject',[TutorController::class,'deleteSUbject']);



//
Route::any('/sendRequest',[RequestController::class,'sendRequest']);


Route::any('/requests',[RequestController::class,'requests']);

Route::get('/tutorrequests',[RequestController::class,'tutorRequests']); 


Route::get('/studentrequests',[RequestController::class,'studentRequests']); 


Route::post('getTutorContact',[TutorController::class,'getTutorContactDetail']);
Route::post('requestStatus',[RequestController::class,'updateReqStatus']);

//Forgot password
Route::post('forgotPass',[MailController::class,'forgotPassword']);


// Route::get('/messages', [MessageController::class,'fetchMessages']);
Route::get('/allMessage', [MessageController::class,'index']);
Route::get('/allMessage/load-latest-messages', [MessageController::class,'getLoadLatestMessages']);
Route::post('/allMessage/sendMessage', [MessageController::class,'postSendMessage']);
// Route::get('/allMessage', [MessageController::class,'allMessage']);
// Route::post('/messages', [MessageController::class,'sendMessage']);





    



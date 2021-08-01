

@include('admin.layout.adminheader')

@include('admin.layout.adminsidebar')


<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Tutor  {{ $students->name ?? 'Add' }} </h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Admin</a></li>
             <li class="breadcrumb-item active">Student </li>
           </ol>
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   <!-- Main content -->
   <section class="content">
     <div class="container-fluid">
       <!-- Small boxes (Stat box) -->
       <div class="row">
         <div class="col-lg-12 col-sm-12 col-md-12 col-12">
           <!-- small box --> 
           <!-- jquery validation -->
           <div class="card card-primary">
            <div class="card-header">
         
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="quickForm" method="POST" action="/admin/addStudent">
              @csrf
              <div class="row">
                <div class="card-body col-md-6">
                  @if(isset($students))
                  <input type="hidden" name="id" class="form-control" id="id"  value="{{  $students->id ?? '' }}" >
                  @endif
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{  $students->name ?? '' }}" >
                  </div>
                  <div class="form-group">
                    <label for="DOB">Date of Birth</label>
                    <input type="date" name="dob" class="form-control" id="dob" placeholder="DOB" value={{ $students->dob ?? '' }}>
                  </div>
                  <div class="form-group">
                    <label for="name">Phone number</label>
                    <input type="text" name="phone_no" class="form-control" id="phone_no" placeholder="Enter Phone" value={{ $students->phone_no ?? '' }} >
                  </div>

                  <div class="form-group">
                    <label for="name">Gender</label>
                    <select name="gender" class="form-control" id="gender" placeholder="gender"  >
                      <option value="Male" @php if(isset($students->gender) == "Male"){ echo "selected"; }@endphp >Male</option>
                      <option value="Female" @php if(isset($students->gender) == "Female"){ echo "selected"; }@endphp>Female</option>
                      <option value="OtherS" @php if(isset($students->gender) == "Other"){ echo "selected"; }@endphp >Others</option>
                    </select>
                  </div>
               

              
                
                </div>
                <!-- /.card-body -->

                <div class="card-body col-md-6">
                  <label for="email_id">Email address</label>
                  <div class="form-group input-group ">
                     
                   
                    <input type="email" name="email_id" class="form-control" id="email_id" placeholder="Enter email" value="{{ $students->email_id ?? '' }}" aria-describedby="basic-addon2">
                    @if(isset($students))
                    <div class="input-group-append">
                      <span class="input-group-text" id="basic-addon1">
                        @if($students->email_verify == "1")
                         Verified
                      @else
                         Not Verified
                      @endif
                      </span>
                    </div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="password">Change Password? New Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" >
                  </div>

                  <div class="form-group">
                    <label for="email_id">Address</label>
                    <input type="text" name="address" class="form-control" id="address" placeholder="Enter address" value="{{ $students->address ?? '' }}">
                  </div>


                  <div class="form-group">
                    <label for="name">Biography</label>
                    <textarea type="text" name="biography" class="form-control" id="biography" placeholder="Enter Biography" > {{ $students->biography ?? ''}}  </textarea>
                  </div>
      
              
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="card-body col-md-6">



                  <div class="form-group">
                 
                    
                    @if (isset($students->pic))
                 
                    <img src="{{ asset('storage/assets/img/student/'. $students->pic) }}" class="img-thumbnail" style=" max-width:200px; height:auto;" alt=""></img>
                    <span class="alert alert-danger">{{ $students->pic }}</span>
                    @else
                    <img src="{{ asset('storage/assets/img/tutors/User.png') }}" class="img-responsive img-thumbnail" style=" max-width:200px; height:auto;" alt=".."></img>
                    <span class="alert alert-danger"> No Image Uploaded</span>
                    @endif
 
                  </div>
                  
                
                
                

                </div>

                <div class="card-body col-md-6">
                

                  <div class="form-group">
                    <label for="fee">Image</label>
                    <input type="file" name="image" class="form-control" id="image" placeholder="Upload Image" >
                  </div>
                </div>

              
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
         </div>
       </div>
       <!-- /.row -->
       
      
     </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->
 

 @include('admin.layout.adminfooter')

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
 <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
 
 <script>
    $(document).ready(function() {
      $('#table').DataTable();
  } );
   </script>
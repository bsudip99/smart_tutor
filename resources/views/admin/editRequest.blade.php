

@include('admin.layout.adminheader')

@include('admin.layout.adminsidebar')


<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Request </h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Admin</a></li>
             <li class="breadcrumb-item active">Request </li>
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
            <form id="quickForm" method="POST" action="/admin/addRequest">
              
              @csrf
              <div class="row">
                <div class="card-body col-md-6">
                 
              
                
                

                  <div class="form-group">
                    <label for="name">Tutor</label>
                    <select name="tutor_id" class="form-control" id="tutor_id" placeholder="tutor_id"  >
                     @foreach ($tutors as $tutor )
                      <option value="{{ $tutor->id }}" >{{ $tutor->name }}</option>
                     @endforeach
                    </select>
                  </div>
               
                  <div class="form-group">
                    <label for="name">Student</label>
                    <select name="student_id" class="form-control" id="student_id"  >
                     @foreach ($students as $student )
                      <option value="{{ $student->id }}" >{{ $student->name }}</option>
                     @endforeach
                    </select>
                  </div>

              
                
                </div>
                <!-- /.card-body -->

                <div class="card-body col-md-6">
                 
             

                  {{-- <div class="form-group">
                    <label for="name">Subject</label>
                    <select name="subject_id" class="form-control" id="subject_id"  >
                     @foreach ($subjects as $subject )
                      <option value="{{ $subject->id }}" >{{ $subject->subject }}</option>
                     @endforeach
                    </select>
                  </div> --}}
      
                  <div class="form-group">
                    <label for="name">Request Text</label>
                    <textarea type="text" name="request_text" class="form-control" id="request_text" placeholder="Enter Request Text" rows="5">  </textarea>
                  </div>
                </div>
              </div>
              <hr>
 
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
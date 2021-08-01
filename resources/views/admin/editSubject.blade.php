

@include('admin.layout.adminheader')

@include('admin.layout.adminsidebar')


<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Subject </h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Admin</a></li>
             <li class="breadcrumb-item active">Subject </li>
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
            <form id="quickForm" method="POST" action="/admin/addSubject">
              
              @csrf
              <div class="row">
                <div class="card-body col-md-6">
                 
              
                
                
                  <input type="hidden" name="id"   value="{{  $subjects->id ?? '' }}" >
                  <div class="form-group">
                    <label for="name">Subject Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{  $subjects->subject ?? '' }}" >
                  </div>
                
               
                 

              
                
                </div>
                <!-- /.card-body -->

                <div class="card-body col-md-6">
                       

                  <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="active" class="custom-control-input" id="exampleCheck1" value="1" @if(isset($subjects) && $subjects->status)) == "1") checked="checked" @endif>
                      <label class="custom-control-label" for="exampleCheck1">Make Subject Active</a>.</label>
                    </div>
                  </div>
                  {{-- <div class="form-group">
                    <label for="name">Subject Detail</label>
                    <textarea type="text" name="subject_detail" class="form-control" id="subject_detail" placeholder="Enter Subject Detail" > {{  $subjects->detail ?? '' }} </textarea>
                  </div> --}}
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
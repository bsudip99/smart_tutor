

@include('admin.layout.adminheader')

@include('admin.layout.adminsidebar')


<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Student List</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Admin</a></li>
             <li class="breadcrumb-item active">Student List</li>
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
           <table class="table table-repsonsive table-bordered" id="table">
            <thead>
          
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">DOB</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Email Verify?</th>
                    <th class="text-center">Phone number</th>
                    <th class="text-center">Address</th>
                    <th class="text-center">Gender</th>
                    <th class="text-center">Action</th>
                
                </tr>
            </thead>
            <tbody>
              
                  @php
                    $i=1;
                  @endphp
                  @foreach ($students as $student )
                  <tr>
                    <td>{{ $i }} </td>
           
                    <td>{{  $student->name }} </td>
                    <td>{{  $student->dob }} </td>
                     <td>{{  $student->email_id }} </td>
                     <td>
                      @if ($student->email_verify == '1') Verified<i
                          class="fa fa-check-circle"></i> @else Not verified <i
                              class="fa fa-times-circle"></i> @endif
                  </td>
                    <td>{{  $student->phone_no }} </td>
                    <td>{{  $student->address }} </td>
                   
                    <td>{{  $student->gender }} </td> 
                    <td>
                        <a class="btn btn-primary" href="/admin/editStudent/{{ $student->id }}">Edit <i
                                class="fa fa-edit"></i></a>
                       
                    </td>
                    @php
                      $i++;
                    @endphp
                      </tr>
                  @endforeach
              
            </tbody>
        </table>
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
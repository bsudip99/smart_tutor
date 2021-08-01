

@include('admin.layout.adminheader')

@include('admin.layout.adminsidebar')


<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Class </h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Admin</a></li>
             <li class="breadcrumb-item active">Class </li>
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
            <form id="quickForm" method="POST" action="/admin/addClass">
              
              @csrf
              <div class="row">
                <div class="card-body col-md-6">
                  <input type="hidden" name="id"   value="{{  $classes->id ?? '' }}" >
                  <div class="form-group">
                    <label for="name">Class Level Name</label>
                    <input type="text" name="comment" class="form-control" id="name" placeholder="Enter Class level Name" value="{{  $classes->comment ?? '' }}" >
                  </div>
              
                </div>
                <!-- /.card-body -->

                <div class="card-body col-md-6">
                       
                  <div class="form-group">
                    <label for="name">From Class</label>
                    <select  name="from_class" class="form-control" id="from_class">
                      @php $i = 1; @endphp
                      @for($i=0;$i<16;$i++)
                      <option value="{{ $i }}" @if(isset($classes) && $classes->from_class == $i) selected @endif>{{ $i }} </option>
                      @endfor
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="name">To Class</label>
                    <select  name="to_class" class="form-control" id="to_class">
                      @php $i = 1; @endphp
                      @for($i=0;$i<16;$i++)
                      <option value="{{ $i }}" @if(isset($classes) && $classes->to_class == $i) selected @endif>{{ $i }} </option>
                      @endfor
                    </select>
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
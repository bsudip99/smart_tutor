@include('admin.layout.adminheader')

@include('admin.layout.adminsidebar')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tutor List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Tutor List</li>
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
                    <table class="table table-bordered table-responsive" id="table">
                        <thead>

                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center" colspan="2">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Email Verify?</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $i = 1;
                            @endphp
                            @foreach ($tutors as $tutor)
                                <tr>
                                    <td>{{ $i }} </td>
                                    <td>{{ $tutor->name }} </td>
                                    <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#detailModal" onclick="details('{{ $tutor->id }}');">
                                            Details <i class="fas fa-eye"></i>
                                        </button>


                                    </td>
                                    <td>{{ $tutor->email_id }} </td>
                                    <td>
                                        @if ($tutor->email_verify == '1') Verified<i
                                            class="fa fa-check-circle"></i> @else Not verified <i
                                                class="fa fa-times-circle"></i> @endif
                                    </td>

                                    <td>
                                        @if ($tutor->status == '1') Approved<i
                                            class="fa fa-check-circle"></i> @else Not Approved <i
                                                class="fa fa-times-circle"></i> @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="/admin/editTutor/{{ $tutor->id }}">Edit <i
                                                class="fa fa-edit"></i></a>
                                        &nbsp;
                                        @if ($tutor->email_verify == '1' && $tutor->status != '1')
                                            <a class="btn btn-primary"
                                                href="/admin/approveTutor/{{ $tutor->id }}">Approve <i
                                                    class="fa fa-check"></i></a>
                                        @elseif($tutor->email_verify == "1" && $tutor->status=="1")
                                            <a class="btn btn-danger" href="/admin/unapproveTutor/{{ $tutor->id }}">
                                                Unapprove <i class="fa fa-times"></i></a>
                                        @endif
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
<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modal-content">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
        function details(id) {  
          var url = window.location.origin;
          $('#modal-content').empty();
            $.ajax({
                url: "/admin/tutorDetail",
                type: 'GET',
                data: {
                    id:id
                },
                success: function(data) {
                  var bodyData = '';
                      
                var tutor_id= data[0].id;
                var name= data[0].name;
                var email_id= data[0].email_id;
                var gender= data[0].gender;
                var phone_no= data[0].phone_no;
                var pic= data[0].pic;
                var status= data[0].status;
                var address= data[0].address;
                var biography= data[0].biography;
                var dob= data[0].dob;
                var email_verify= data[0].email_verify;
                var experience= data[0].experience;
                var fee= data[0].fee;
                var citizenship_doc= data[0].citizenship_doc;
                var qualification_certificate= data[0].qualification_certificate;


                 bodyData += "<div class='col-md-12'>";
                  bodyData +="<h5> Name :"+name+"</h5> "+"<h5> Gender :"+gender+"</h5> ";
                bodyData+= "<h5> Phone No :"+phone_no+"</h5> "+"<h5> Address :"+address+"</h5> "+"</div>";
                bodyData+="<div class='col-md-12'>"+"<h5> Email Id :"+email_id+"</h5> "+"<h5> Experience :"+experience+"</h5> ";
                bodyData+="<h5> Fee :"+fee+"</h5> "+"<h5> Biography :"+biography+"</h5> "+"</div>";
                if(pic){
                bodyData+="<div class='col-md-8'>"+'<label> Profile Image (Click on image to view)</label>';
                bodyData+="<a href='"+url+"/storage/assets/img/tutors/"+pic+"' target='_blank'><img src= '"+url+"/storage/assets/img/tutors/"+pic+"' style='height:150px;; width:150px;'></a>";
                bodyData+="</div>";
                }
                if(citizenship_doc){
                bodyData+="<div class='col-md-8'>"+'<label> Citizenship Image(Click on image to view) </label>';
                bodyData+="<a href='"+url+"/storage/assets/img/document/citizenship/"+citizenship_doc+"' target='_blank'><img src= '"+url+"/storage/assets/img/document/citizenship/"+citizenship_doc+"' style='height:150px;; width:150px;'></a>"
                bodyData+="</div>";
                } 
                if(qualification_certificate){
                bodyData+="<div class='col-md-8'>"+'<label> Qualification Image(Click on image to view) </label>';
                bodyData+="<a href='"+url+"/storage/assets/img/document/qualification/"+qualification_certificate+"' target='_blank'><img src= '"+url+"/storage/assets/img/document/qualification/"+qualification_certificate+"' style='height:150px;; width:150px;'></a>"
                bodyData+="</div>";
                }
                
                // }
                // alert(bodyData);
                $('#modal-content').append(bodyData);
                $('#detailModal').modal('hide');
                $('#detailModal').modal('show');
                }
            });

        }

</script>

@include('admin.layout.adminfooter')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>

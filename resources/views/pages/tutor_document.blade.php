@include('layout.header');


<div class="container">
    <form name="formDoc" method="POST" enctype="multipart/form-data" action="submitDocument">
        <fieldset>
            <div class="row">
                @csrf
                <div class="col-md-6 col-sm-6 col-md-offset-2 col-sm-offset-2">
                    <label class="form-control" style="text-align: center;"> Citizenship Document</label>


                    @if (isset($documents[0]->citizenship_doc))
                        <img src="{{ asset('storage/assets/img/document/citizenship')."/".$documents[0]->citizenship_doc }}" alt=""
                            style="height:200px; width:200px; display:block;  margin-left:auto; margin-right:auto;">
                    @else
                        <div style="height:200px; text-align:center;"> No File Available </div>
                    @endif

                    <label> Upload New Citizenship document</label>
                    <input type="file" class="form-control" class="text-center" name="citizenship_doc">
                </div>
            </div>
            <hr>

        </fieldset>


        <fieldset>
            <div class="row">

                <div class="col-md-6 col-sm-6 col-md-offset-2 col-sm-offset-2">
                    <label class="form-control" style="text-align: center;"> Highest qualification academic
                        Document</label>


                    @if (isset($documents[0]->qualification_certificate))
                        <img src="{{ asset('storage/assets/img/document/qualification')."/".$documents[0]->qualification_certificate }}" alt=""
                            style="height:200px; width:200px; display:block;  margin-left:auto; margin-right:auto;">
                    @else
                        <div style="height:200px; text-align:center;"> No File available</div>
                    @endif

                    <label> Upload New Academic Document</label>
                    <input type="file" class="form-control" class="text-center" name="qualification_doc">
                </div>
            </div>
            <hr>

        </fieldset>

        <div class="row">
            <div class="col-md-5 col-sm-5 col-md-offset-5 col-sm-offset-5">
                <input type="submit" class="btn btn-warning" value="Submit Images">
            </div>
        </div>
    </form>
</div>

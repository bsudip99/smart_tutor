<!doctype html>
<html lang="en">
  <head>
    <title>Mail From Smart Tutor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-sm-12 m-auto">
                <p> Hi, {{ $details['user'] }} </p>
                <p> Welcome to Smart Tutor</p>
                <p> Please Verify your email by clicking below 
                 <br> {{$details['clean_url'] }} </p>
                  <p> If link is not opening on click,  copy this and paste in new window. </p>
           
                 <p> {{ $details['extra'] }}
                <br/>
                <br/>
                <p> Best Regards</p>
                <p> Team, Smart Tutor </p>
            </div>
        </div>
    </div>
  </body>
</html>
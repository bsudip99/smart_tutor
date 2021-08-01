
  
  @extends('layout.app')
 
  

  @section('content')

  <!-- Start Slider -->
  <section id="mu-slider">
    <!-- Start single slider item -->
    <div class="mu-slider-single">
      <div class="mu-slider-img">
        <figure>
          <img src="{{  asset('storage/assets/img/slider/2.jpg')}}" alt="img">
        </figure>
      </div>
      <div class="mu-slider-content">
        <h4>Welcome To Smart Tutor</h4>
        <span></span>
        <h2>We Will Help You To Learn</h2>
        <p>Are you searching for an effective personal tutor for your child? At Smart Tutor,
          we understand the turmoil to find a well trained private teacher who can improve not only
          the report card of your child but also the understanding and learning experience while
          studying. Smart Tutor has a mission to bridge the gap between qualified home tutors & 
          the parents seeking for personal teachers. 
          Register now and get in touch with subject expert teachers.</p>
    
      </div>
    </div>
    <!-- Start single slider item -->
    <!-- Start single slider item -->
    <div class="mu-slider-single">
      <div class="mu-slider-img">
        <figure>
          <img src="{{  asset('storage/assets/img/slider/1.jpg')}}" alt="img">
        </figure>
      </div>
      <div class="mu-slider-content">
        <h4>Best Price</h4>
        <span></span>
        <h2>Best Education </h2>
        <p> We provide best education platform for students and provide online tutors for reasonable price.</p>   
      </div>
    </div>
    <!-- Start single slider item -->
    <!-- Start single slider item -->
    <div class="mu-slider-single">
      <div class="mu-slider-img">
        <figure>
          <img src="{{  asset('storage/assets/img/slider/3.jpg')}}" alt="img">
        </figure>
      </div>
      <div class="mu-slider-content">
        <h4>Exclusivly For Education</h4>
        <span></span>
        <h2>Education For Everyone</h2>
        <p> Our education is free for all. Just sign up and Enjoy</p>   
      </div>
    </div>
    <!-- Start single slider item -->    
  </section>
  <!-- End Slider -->
  <!-- Start service  -->
  <section id="mu-service">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="mu-service-area">
            <!-- Start single service -->
            <div class="mu-service-single">
              <span class="fa fa-book"></span>
              <h3>Learn Online</h3>
              <p>Our platform is free for everybody to learn online with online tutors </p>
            </div>
            <!-- Start single service -->
            <!-- Start single service -->
            <div class="mu-service-single">
              <span class="fa fa-users"></span>
              <h3>Expert Teachers</h3>
              <p> We verify our tutors and only provide verified and expert tutors.  </p>    </div>
            <!-- Start single service -->
            <!-- Start single service -->
            <div class="mu-service-single">
              <span class="fa fa-table"></span>
              <h3>Best Fee</h3>
              <p>Our tutors are fee reasonable and provide cost effective tution</p>    </div>
            <!-- Start single service -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End service  -->

  <!-- Start about us -->
  <section id="mu-about-us">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-about-us-area">           
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <div class="mu-about-us-left">
                  <!-- Start Title -->
                  <div class="mu-title">
                    <h2>About Us</h2>              
                  </div>
                  <!-- End Title -->
                  <p>Smart Tutor is here to help students/parents to find tutors of their choice. 
                    Many tutors are available for online tutoring as well as home tutoring. Students and parents can browse through us for searching such tutors.
                    This is how it works !
                  </p>
                  <ul>
                    <li>You can register or login(if registered) as tutor or student.</li>
                    <li>If tutor, Provide proper information of yourself and your details so that students/parents can easily send you a request.</li>
                    <li>If Student, Login and search for your tutor of choice and send a request. </li>
                    <li>After a tutor accepts your request, students can contact them via their shown contact details and talk to them.</li>
                    <li>Tutors should upload all the documents and proper information for being activated to show themselves in tutors list.</li>
                  </ul>
                
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="mu-about-us-img">                            
           
                  <a>
                    <img src="{{  asset('storage/assets/img/about-us.jpg')}}" alt="img">
                  </a>
                 
          
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End about us -->

  <!-- Start latest course section -->
  <section id="mu-latest-courses">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="mu-latest-courses-area">
            <!-- Start Title -->
            <div class="mu-title">
              <h2>Our Subjects</h2>
              <p></p>
            </div>
            <!-- End Title -->
            <!-- Start latest course content -->
            <div id="mu-latest-course-slide" class="mu-latest-courses-content">
              
              
                @foreach ($subject_data['subjects'] as $subject )
                  
               
              <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="mu-latest-course-single">
               
                  <div class="mu-latest-course-single-content" >
                    <h4 ><a href="#"></a>{{ $subject->subject }}</h4>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            <!-- End latest course content -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End latest course section -->





  @endsection
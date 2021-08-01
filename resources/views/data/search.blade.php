@if (count($tutors))


    <div class="mu-course-container mu-blog-archive">
        <div class="row">
            @php $i=1; @endphp
            @foreach ($tutors as $tutor)
                <div class="col-md-4 col-sm-4">
                    <article class="mu-blog-single-item">
                        <figure class="mu-blog-single-img">
                            <a href="/tutor/profile/{{ $tutor->id }}">
                                @if ($tutor->pic && file_exists('storage/assets/img/tutors' . '/' . $tutor->pic))
                                    <img alt="img" src="{{ asset('storage/assets/img/tutors/') . '/' . $tutor->pic }}"
                                        style="height:400px;">
                                @else
                                    <img alt="img" src="{{ asset('storage/assets/img/tutors/User.png') }}"
                                        style="height:400px;">


                                @endif

                            </a>
                            <figcaption class="mu-blog-caption">
                                <h3><a href="/tutor/profile/{{ $tutor->id }}">{{ $tutor->name }} </a></h3>
                            </figcaption>
                        </figure>

                        <div class="mu-blog-meta">
                            <b> Gender: </b> {{ $tutor->gender }} <br>
                            <b> Address: </b> {{ $tutor->address }}
                        </div>

                        <div class="mu-blog-description">
                            <p></p>
                            <a class="mu-read-more-btn" href="/tutor/profile/{{ $tutor->id }}">See More</a>
                        </div>
                    </article>
                </div>

                @if ($i % 3 == 0)
        </div>
        <div class="row">
@endif
@php $i++; @endphp
@endforeach
</div>

<div id="more_load">
</div>

<div class="row" id="load_more_button_div" style="text-align:center;">
    <input type="button" class="btn btn-primary" name="loadmore" id="loadmore" onclick="load_more();" value="Load More">

    <div class="ajax-load text-center" style="display:none">
        <p><img src="{{ asset('storage/assets/img/loader.gif') }}">Loading More Tutor </p>
    </div>

</div>
<!-- end course pagination -->
</div>
</div>


@else
<div class="mu-course-container mu-blog-archive">
    <div class="row">
        <div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4" class="text-align:center;">
            <article class="mu-blog-single-item">
                <figure class="mu-blog-single-img">

                    <figcaption class="mu-blog-caption">
                        <h3>No Tutors Found</h3>
                    </figcaption>
                </figure>
            </article>
        </div>
    </div>
</div>
@endif

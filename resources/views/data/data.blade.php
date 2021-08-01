


    

    @php $i=1; @endphp
    @foreach ($tutors as $tutor)
        <div class="row">
        <div class="col-md-4 col-sm-4">
            <article class="mu-blog-single-item">
                <figure class="mu-blog-single-img">
                    <a href="/tutor/profile/{{ $tutor->id }}">
                        @if ($tutor->pic && file_exists('storage/assets/img/tutors' . '/' . $tutor->pic))
                            <img alt="img"
                                src="{{ asset('storage/assets/img/tutors/') . '/' . $tutor->pic }}">
                        @else
                            <img alt="img"
                                src="{{ asset('storage/assets/img/tutors/User.png') }}">


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
    @php$i++; @endphp
</div>
    @endforeach




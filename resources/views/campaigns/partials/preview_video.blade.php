<!-- preview -->

{!! HTML::style('assets/css/video.css') !!}
<div id="fb-root"></div>


<!-- Banner card -->
<div class="banner card-panel z-depth-2 center-align black" onclick="playVideo()">

    {{--<i class="large material-icons icon-play">play_circle_filled</i>--}}
    <i class="large material-icons icon-play">&#xE038;</i>

    <video id="theVideo" class="responsive-video banner-video"
           poster="https://s3-us-west-1.amazonaws.com/enera-publishers/items/{!! $cam->content['images']['video'] !!}">
    <source src="https://s3-us-west-1.amazonaws.com/enera-publishers/items/trailer.mp4" type="video/mp4">

    {{--<source src="http://media.w3.org/2010/05/sintel/trailer.webm" type="video/webm">--}}
    {{--<source src="http://media.w3.org/2010/05/sintel/trailer.ogv" type="video/ogg">--}}
    Tu navegador no soporta reproduccion de video.
    </video>
</div>
<!-- Banner card -->

<!-- botones -->
<div class="card-panel center-align actions-card">


    <a class="btn waves-effect waves-light play-btn indigo z-depth-2" href="#!"
       onclick="playVideo()">
            <span class="white-text left">
                Reproducir video
            </span>
        {{--<i class="material-icons right">play_circle_filled</i>--}}

    </a>

    <a class="btn waves-effect waves-light nav-btn indigo z-depth-2" href="#!"
       success_url="{{Input::get('base_grant_url') }}">
            <span class="white-text left">
                Navegar en internet
            </span>
        <i class="right material-icons">wifi</i>

    </a>


</div>


<!-- end preview -->

<!-- campaign elements -->

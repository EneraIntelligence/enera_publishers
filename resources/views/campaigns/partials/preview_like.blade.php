<!-- preview -->
{!! HTML::style('assets/css/like.css') !!}
<div id="fb-root"></div>


<!-- Banner card -->
<div class="banner card-panel z-depth-2 center-align">
    <img class="responsive-img image-small" style="margin-bottom: -6px;"
         src="https://s3-us-west-1.amazonaws.com/enera-publishers/items/{!! $cam->content['images']['small'] !!}">
</div>
<!-- Banner card -->

<!-- botón de like -->
<div class="card-panel center-align actions-card">
    <div class="container like-container z-depth-2" style="width: 60px; height: 25px;">
        <!-- like button -->
        <div class="fb-like" data-send="false" data-layout="button" data-width="200"
             data-show-faces="false"><img src="{{asset('images/like_facebook.png')}}" alt="" style="width: 115%;"></div>
    </div>


    <!-- deseo navegar sin like -->
    <a class="btn-flat waves-effect waves-orange nav-btn" href="#!"
       success_url="{{Input::get('base_grant_url') }}">
            <span class="blue-text text-darken-4">
                Navegar en internet
            </span>
    </a>

</div>
<!-- botón de like -->

<!-- end preview -->


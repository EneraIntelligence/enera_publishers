<!-- preview -->
{!! HTML::style('assets/css/mailing_list.css') !!}
<div id="fb-root"></div>


<!-- Banner card -->
<div class="banner card-panel z-depth-2 center-align">
    <img class="responsive-img image-small" style="margin-bottom: -6px;"
         src="https://s3-us-west-1.amazonaws.com/enera-publishers/items/{!! $cam->content['images']['small'] !!}">
</div>
<!-- Banner card -->

<!-- botones -->
<div class="card-panel center-align actions-card">

    <a class="btn waves-effect waves-light subscribe-btn indigo z-depth-2" href="#!"
       success_url="{{Input::get('base_grant_url') }}">
            <span class="white-text left">
                Me interesa
            </span>
        <i class="right material-icons">wifi</i>

    </a>

    <!-- deseo navegar sin like -->
    <a class="btn-flat waves-effect waves-orange nav-btn" href="#!"
       success_url="{{Input::get('base_grant_url') }}">
            <span class="blue-text text-darken-4">
                Navegar en internet
            </span>
    </a>

</div>
<!-- botones -->

<!-- end preview -->

<!-- campaign elements -->

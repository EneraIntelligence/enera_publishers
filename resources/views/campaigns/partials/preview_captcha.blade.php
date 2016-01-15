<!-- preview -->
<div class="preview-container">

    <img class="uk-align-center uk-responsive-width phone" src="{!! URL::asset('images/android_placeholder.png') !!}" alt="">

    <!-- captcha preview -->
    <div class="interaction uk-align-center uk-position-relative">

        <img class="interaction-image" src="{!! "https://s3-us-west-1.amazonaws.com/enera-publishers/items/". $cam->content['images']['small'] !!}"alt=""/>

        <input class="uk-text-center" style="width:98%;" type="text" value="Mi producto">

        <div class="uk-clearfix"></div>

        <div style="position:absolute;bottom:0;width: 100%;" class="md-btn md-btn-primary boton">Navegar en internet</div>

    </div>

</div>

<!-- end preview -->
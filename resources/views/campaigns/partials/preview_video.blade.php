<!-- preview -->
<div class="preview-container">

    <img class="uk-align-center uk-responsive-width phone" src="{!! URL::asset('images/android_placeholder.png') !!}" alt="">

    <!-- banner link preview -->
    <div class="interaction uk-align-center uk-position-relative">

        <img style="position:absolute;" src="{!! URL::asset('images/icons/video.svg') !!}" alt="">
        <img class="interaction-image" src="{!! "https://s3-us-west-1.amazonaws.com/enera-publishers/items/". $cam->content['images']['large'] !!}"alt=""/>


        <div class="uk-clearfix"></div>



        <div style="position: absolute; bottom: 0; width: 100%;" class="md-btn md-btn-primary boton">Navegar en internet</div>


    </div>

</div>

<!-- end preview -->
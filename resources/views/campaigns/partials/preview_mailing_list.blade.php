<!-- preview -->
<div class="preview-container">

    <img class="uk-align-center uk-responsive-width phone" src="{!! URL::asset('images/android_placeholder.png') !!}" alt="">

    <!-- mailing list preview -->
    <div class="interaction uk-align-center uk-position-relative">

        <img class="interaction-image" src="{!! "https://s3-us-west-1.amazonaws.com/enera-publishers/items/". $cam->content['images']['small'] !!}"alt=""/>


        <div class="uk-clearfix"></div>


        <div style="width: 100%;" class="md-btn md-btn-primary boton">Suscribirme</div>

        <a style="position: absolute; bottom: 0; width: 100%;" class="uk-hidden-small" href="#">
            <p class="uk-text-truncate uk-text-center uk-margin-bottom-remove">Deseo navegar en internet</p>
        </a>

        <a style="position: absolute; bottom: 0; width: 100%;" class="uk-hidden-medium uk-hidden-large" href="#">
            <p class="uk-text-truncate uk-text-center uk-margin-bottom-remove" style="font-size: 10px">Deseo navegar en internet sin suscribirme</p>
        </a>

    </div>

</div>

<!-- end preview -->
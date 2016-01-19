<!-- preview -->
<div class="preview-container">

    <img class="uk-align-center uk-responsive-width phone" src="{!! URL::asset('images/android_placeholder.png') !!}" alt="">

    <!-- like preview -->
    <div class="interaction uk-align-center uk-position-relative">

        <img class="interaction-image" src="{!! "https://s3-us-west-1.amazonaws.com/enera-publishers/items/". $cam->content['images']['small'] !!}"alt=""/>

        <img class="uk-align-center interaction-imgs" src="{!! URL::asset('images/elements/megusta.jpg') !!}" alt="">
        <div class="uk-clearfix"></div>

        <a style="position: absolute; bottom: 0; width: 100%;" class="uk-hidden-small" href="#">
            <p class="uk-text-truncate uk-text-center uk-margin-bottom-remove">Deseo navegar en internet</p>
        </a>

        <a style="position: absolute; bottom: 0; width: 100%;" class="uk-hidden-medium uk-hidden-large" href="#">
            <p class="uk-text-truncate uk-text-center uk-margin-bottom-remove" style="font-size: 10px">Deseo navegar en internet</p>
        </a>

    </div>

</div>

<!-- end preview -->


<!-- campaign elements -->
<h3 class="heading_c uk-margin-small-bottom">Elementos de la campaña</h3>

<div class="md-list-heading uk-width-large-1 azul">
    <i class="uk-icon-file-picture-o "
       style="margin-right:10px;"></i>Imagen chica :
    <a id="link" class=""
       data-uk-modal="{target:'#modal_lightbox-1'}">{!! isset($cam->content['images']['small'])?$cam->content['images']['small']:'no hay imagen' !!}</a>
    <div class="uk-modal" id="modal_lightbox-1">
        <div class="uk-modal-dialog uk-modal-dialog-lightbox">
            <button type="button"
                    class="uk-modal-close uk-close uk-close-alt"></button>
            <img src="{!! "https://s3-us-west-1.amazonaws.com/enera-publishers/items/". $cam->content['images']['small'] !!}"
                 alt=""/>
            <div class="uk-modal-caption">{!! $cam->content['images']['small'] !!}</div>
        </div>
    </div>
</div>

<div class="md-list-content uk-width-large-1 azul">
    <i class="uk-icon-file-picture-o "
       style="margin-right:10px;"></i>Imagen grande :
    <a id="link" class=""
       data-uk-modal="{target:'#modal_lightbox-2'}">
        {!! isset($cam->content['images']['large'])?$cam->content['images']['large']:'no hay imagen' !!}</a>
    <div class="uk-modal" id="modal_lightbox-2">
        <div class="uk-modal-dialog uk-modal-dialog-lightbox">
            <button type="button"
                    class="uk-modal-close uk-close uk-close-alt"></button>
            <img src="{!! "https://s3-us-west-1.amazonaws.com/enera-publishers/items/". $cam->content['images']['large'] !!}"
                 alt=""/>
            <div class="uk-modal-caption">$cam->content['images']['large']</div>
        </div>
    </div>

</div>

<div class="md-list-content uk-width-large-1 azul">
    <i class="uk-icon-link "  style="margin-right:6px;"></i>
    Url like:
    <a id="link" class=""
       href="http://{{ isset($cam->content['like_url'])? str_replace("http://","",$cam->content['like_url']):'no definido' }}"
       target="_blank">{!! isset($cam->content['like_url'])? $cam->content['like_url']:'Like url no definido www.enera.mx' !!}</a>
</div>
<!-- preview -->
<div class="preview-container">

    <img class="uk-align-center uk-responsive-width phone" src="{!! URL::asset('images/android_placeholder.png') !!}" alt="">

    <!-- banner link preview -->
    <div class="interaction uk-align-center uk-position-relative">

        <img class="interaction-image" src="{!! "https://s3-us-west-1.amazonaws.com/enera-publishers/items/". $cam->content['images']['small'] !!}"alt=""/>


        <div class="uk-clearfix"></div>



        <div style="position: absolute; bottom: 0; width: 100%;" class="md-btn md-btn-primary boton">Navegar en internet</div>


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
    <i class="uk-icon-link"  style="margin-right:6px;"></i>
    link:
    <a id="link" class=""
       href="http://{{ isset($cam->content['link'])? str_replace("http://","",$cam->content['link']):'no definido' }}"
       target="_blank">{!! isset($cam->content['link'])? $cam->content['link']:'Like url no definido www.enera.mx' !!}</a>
</div>
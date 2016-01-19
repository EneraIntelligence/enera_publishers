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

<!-- campaign elements -->
<h3 class="heading_c uk-margin-small-bottom">Elementos de la campaña</h3>

@if(isset($cam->content['images']))
    <div class="md-list-heading uk-width-large-1 azul">
        <i class="uk-icon-file-picture-o "
           style="margin-right:10px;"></i> Imagen Chica :
        <a id="link" class=""
           data-uk-modal="{target:'#captcha-image'}">
            {!! isset($cam->content['images']['small'])?$cam->content['images']['small']:'imagen no definida' !!}</a>
        <div class="uk-modal" id="captcha-image">
            <div class="uk-modal-dialog uk-modal-dialog-lightbox">
                <button type="button"
                        class="uk-modal-close uk-close uk-close-alt"></button>
                @if(isset($cam->content['images']['small']))
                    <img src="{!! "https://s3-us-west-1.amazonaws.com/enera-publishers/items/". $cam->content['images']['small'] !!}"
                         alt=""/>
                @endif
                <div class="uk-modal-caption">{{$cam->content['images']['small']}}</div>
            </div>
        </div>
    </div>
    <div class="md-list-heading uk-width-large-1 azul">
        <i class="uk-icon-file-picture-o "
           style="margin-right:10px;"></i> Imagen Grande :
        <a id="link" class=""
           data-uk-modal="{target:'#captcha-image-2'}">
            {!! isset($cam->content['images']['large'])?$cam->content['images']['large']:'imagen no definida' !!}</a>
        <div class="uk-modal" id="captcha-image-2">
            <div class="uk-modal-dialog uk-modal-dialog-lightbox">
                <button type="button"
                        class="uk-modal-close uk-close uk-close-alt"></button>
                @if(isset($cam->content['images']['large']))
                    <img src="{!! "https://s3-us-west-1.amazonaws.com/enera-publishers/items/". $cam->content['images']['large'] !!}"
                         alt=""/>
                @endif
                <div class="uk-modal-caption">{{$cam->content['images']['large']}}</div>
            </div>
        </div>
    </div>
@else
<div class="md-list-heading uk-width-large-1 azul">
    <i class="uk-icon-file-picture-o "
       style="margin-right:10px;"></i> no hay imagen definida
</div>
@endif

@if(isset($cam->content['mail']))
<div class="md-list-heading uk-width-large-1 azul">
    <i class="uk-icon-envelope " style="margin-right:8px;"></i>
    <span style="cursor: pointer;"
          onclick="viewMailingDetails('{!! $cam->content['mail']['from_name']!!}',
                  '{!! $cam->content['mail']['from_mail']!!}',
                  '{!! $cam->content['mail']['subject']!!}',
                  {{ htmlspecialchars( json_encode( $cam->content['mail']['content'] )) }})">
         <!-- htmlspecialchars($cam->content['mail']['content']) -->
        Ver detalles de mailing</span>
</div>
@else
    <div class="md-list-heading uk-width-large-1 azul">
        <i class="uk-icon-envelope " style="margin-right:8px;"></i>
    <span style="cursor: pointer;"
          onclick="viewMailingDetails('no definido',
                  'no definido',
                  'no definido',
          'no definido')">
         <!-- htmlspecialchars($cam->content['mail']['content']) -->
        Ver detalles de mailing</span>
    </div>
@endif
<!-- create mailing campaign button start -->
<div class="uk-grid uk-margin-medium-top" data="uk-grid-margin">
    <div class="uk-width-1-1">
        <div class="uk-width-medium-1-1">
            <a class="md-btn md-btn-primary"
               onclick="new_campaign.promptMailingCampaign('{{$cam->_id}}')">
                <span class="uk-display-block">Crear campaña de mailing</span>
            </a>
        </div>
    </div>
</div>
<!-- create mailing campaign button end -->


<div class="uk-modal" id="mail-info">
    <div class="uk-modal-dialog uk-modal-dialog-large">

        <a class="uk-modal-close uk-close"></a>

        <div class="uk-modal-header">
            <h2>Detalles de mailing</h2>
        </div>

        <div class="md-list-heading uk-width-large-1 azul">
            Nombre del remitente: <span style="color:black;" id="from_name"></span>
        </div>

        <div class="md-list-heading uk-width-large-1 azul">
            Correo del remitente: <span style="color:black;" id="from_mail"></span>
        </div>

        <div class="md-list-heading uk-width-large-1 azul">
            Asunto: <span style="color:black;" id="subject"></span>
        </div>

        <div class="md-list-heading uk-width-large-1 azul">
            Mensaje:
        </div>

        <div id="content_message">

        </div>

        <div class="uk-modal-footer"></div>


    </div>
</div>


<script>
    function viewMailingDetails(from_name, from_mail, subject, content)
    {

        $("#from_name").html(from_name);
        $("#from_mail").html(from_mail);
        $("#subject").html(subject);
        $("#content_message").html(content);

        var modal = UIkit.modal("#mail-info");
        modal.show();
    }
</script>
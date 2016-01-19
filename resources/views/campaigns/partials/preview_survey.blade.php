<!-- preview -->
<div class="preview-container">

    <img class="uk-align-center uk-responsive-width phone" src="{!! URL::asset('images/android_placeholder.png') !!}"
         alt="">

    <!-- captcha preview -->
    <div class="interaction uk-align-center uk-position-relative">

        <img class="interaction-image"
             src="{!! "https://s3-us-west-1.amazonaws.com/enera-publishers/items/". $cam->content['images']['survey'] !!}"
             alt=""/>

        <h3 class="uk-text-center center-text uk-margin-small">¿Pregunta 1?</h3>
        <div style="width:100%;" class="md-btn md-btn-primary uk-margin-small">A</div>
        <div class="uk-clearfix"></div>
        <div style="width:100%;" class="md-btn md-btn-primary uk-margin-small">B</div>
        <div class="uk-clearfix"></div>
        <div style="width:100%;" class="md-btn md-btn-primary uk-margin-small">C</div>

    </div>

</div>

<!-- end preview -->

<!-- campaign elements -->

<h3 class="heading_c uk-margin-small-bottom">Elementos de la campaña</h3>

@if(isset($cam->content['images']))
    <div class="md-list-heading uk-width-large-1 azul ">
        <i class="uk-icon-file-picture-o "
           style="margin-right:10px;"></i>Imagen Encuesta :
        <a id="link" class=""
           data-uk-modal="{target:'#survey-image'}">
            {!! $cam->content['images']['survey'] !!}</a>
        <div class="uk-modal" id="survey-image">
            <div class="uk-modal-dialog uk-modal-dialog-lightbox">
                <button type="button"
                        class="uk-modal-close uk-close uk-close-alt"></button>
                <img src="{!! URL::asset('https://s3-us-west-1.amazonaws.com/enera-publishers/items/'.$cam->content['images']['survey']) !!}"
                     alt="{{$cam->content['images']['survey']}}"/>
                <div class="uk-modal-caption">{{$cam->content['images']['survey']}}</div>
            </div>
        </div>
    </div>
@else
    <div>
        <i class="uk-icon-file-picture-o "
           style="margin-right:10px;"></i> no hay imagen que mostrar
    </div>
    @endif

            <!------- informacion de survey  ---->
    <div class="md-list-content uk-width-large-1 ">
        @if(isset($cam->content['survey']))
            <div class="azul">
                <i class="uk-icon-th-list " style="margin-right:5px;"></i> Preguntas de la encuesta
            </div>
            <div style="margin-left:10px;padding-top:5px;" >
            @foreach($cam->content['survey'] as $key => $con)
                <span class="azul">P {!! $key[1] !!}:</span>
                <span> &nbsp;{!! $con['question'] !!}</span>
                <br>
                @foreach($con['answers'] as $key => $a)
                    <ul>
                        <li class="p"><p>R {!! $key[1] !!}
                                : {!! $a !!}</p>
                    </ul>
                @endforeach
            @endforeach
            </div>
        @else
            <div class="">
                <i class="uk-icon-th-list " style="margin-right:10px;"></i> no hay preguntas que mostrar
            </div>
        @endif
    </div>
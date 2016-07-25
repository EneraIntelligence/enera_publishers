<!-- campaign elements -->
@if($cam->interaction['name'] != 'survey')
    <div class="md-list-heading uk-width-large-1 azul">
        <i class="uk-icon-file-picture-o "
           style="margin-right:10px;"></i>Imagen chica :
        <a class="waves-effect waves-light modal-trigger"
           href="#image-small">{!! $cam->content['images']['small'] !!}</a>
        <div id="image-small" class="modal modal-fixed-footer" style="height: auto;pointer-events: none; box-shadow: none;
                                                                background: none;">
                    <div class="responsive-img">
                        <img class="" style="display: block;margin: auto;"
                             src="{!! "https://s3-us-west-1.amazonaws.com/enera-publishers/items/". $cam->content['images']['small'] !!}"
                             alt=""/>
                    </div>
        </div>
    </div>

    <div class="md-list-content uk-width-large-1 azul">
        <i class="uk-icon-file-picture-o "
           style="margin-right:10px;"></i>Imagen grande :
        <a class="waves-effect waves-light modal-trigger"
           href="#image-large">{!! $cam->content['images']['large'] !!}</a>
        <div id="image-large" class="modal modal-fixed-footer" style="height: auto;pointer-events: none; box-shadow: none;
                                                                background: none;">
                    <div class="responsive-img">
                        <img class="" style="display: block;margin: auto;"
                             src="{!! "https://s3-us-west-1.amazonaws.com/enera-publishers/items/". $cam->content['images']['large'] !!}"
                             alt=""/>
                    </div>
        </div>
    </div>
@else
    <div class="md-list-content uk-width-large-1 azul">
        <i class="uk-icon-file-picture-o "
           style="margin-right:10px;"></i>Imagen encuesta :
        <a class="waves-effect waves-light modal-trigger"
           href="#survey-image">{!! $cam->content['images']['survey'] !!}</a>
        <div id="survey-image" class="modal modal-fixed-footer" style="height: auto;pointer-events: none; box-shadow: none;
                                                                background: none;">
            <div class="responsive-img" >
                <img class="" style="display: block;margin: auto;"
                     src="{!! "https://s3-us-west-1.amazonaws.com/enera-publishers/items/". $cam->content['images']['survey'] !!}"
                     alt=""/>
            </div>
            {{--<div class="modal-footer">--}}
                {{--<a href="javascript:void(0)"--}}
                   {{--class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>--}}
            {{--</div>--}}
        </div>
    </div>
@endif
@if($cam->interaction['name'] == 'like')
    <div class="md-list-content uk-width-large-1 azul">
        <i class="uk-icon-link "   style="margin-right:6px;"></i>
        Url like:
        <a id="link" class=""
           href="http://{{ isset($cam->content['like_url'])? str_replace("http://","",$cam->content['like_url']):'no definido' }}"
           target="_blank">{!! isset($cam->content['like_url'])? $cam->content['like_url']:'Like url no definido www.enera.mx' !!}</a>
    </div>
@endif

@if($cam->interaction['name'] == 'video')
    <div class="md-list-content uk-width-large-1 azul">
        <i class="uk-icon-file-picture-o "
           style="margin-right:10px;"></i>Video:
        <a class="waves-effect waves-light modal-trigger"
           href="#survey-image">{!! $cam->content['images']['large'] !!}</a>
        <div id="survey-image" class="modal">
            <div class="modal-content">
                <h5>{!! $cam->content['video'] !!}</h5>
                <video width="550" height="300" controls>
                    <source src="{!! URL::asset('https://s3-us-west-1.amazonaws.com/enera-publishers/items/'.$cam->content['video']) !!}"
                            type="video/mp4">
                    Your browser does not support HTML5 video.
                </video>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)"
                   class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
            </div>
        </div>
    </div>
@endif

@if($cam->interaction['name'] == 'survey')
    <div class="md-list-content uk-width-large-1 azul">
        <i class="uk-icon-file-picture-o "
           style="margin-right:10px;"></i>Encuesta:
        <a class="waves-effect waves-light modal-trigger" href="#survey-data">{!! 'Datos' !!}</a>
        <div id="survey-data" class="modal" style="width: 50%;">
            <div style="padding: 25px;">
                <ul class="black-text">
                    <span class="card-title">Preguntas de la encuesta</span>
                    @if(isset($cam->content['survey']))
                        @foreach($cam->content['survey'] as $key => $con)
                            <li data-icon="keyboard_arrow_right">
                                <span class="azul">P {!! $key[1] !!}:</span>
                                <span> &nbsp;{!! $con['question'] !!}</span>
                                @foreach($con['answers'] as $key => $a)
                                    <ul class="black-text">
                                        <li data-icon="remove" style="margin-left: 25px;">
                                            R {!! $key[1] !!}
                                            : {!! $a !!}</li>
                                    </ul>
                                @endforeach
                            </li>
                        @endforeach
                    @else
                        <li data-icon="keyboard_arrow_right">Preguntas no definidas</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endif

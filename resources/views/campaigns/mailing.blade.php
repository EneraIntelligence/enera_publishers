@extends('layouts.main')

@section('content')



<div id="page_content">
    <div id="page_content_inner">

        <div class="md-card uk-margin-large-bottom">
            <div class="md-card-content">

                <h2>Nueva campaña de mailing</h2>
                <h5>{{$campaign_name}}</h5>

                {!!  Form::open( array('url' => "campaigns/send_mailing" ) ) !!}

                <input type="hidden" name="campaign_id" value="{{ $campaign_id }}">
                <input type="hidden" name="campaign_name" value="{{ $campaign_name }}">

                <div class="uk-grid">

                    <div class="uk-width-medium-1-3">
                        <div class="uk-form-row">
                            <div class="md-input-wrapper">
                                <label>Nombre del remitente</label>
                                <input type="text" name="from" class="md-input">
                                <span class="md-input-bar">
                                </span>
                            </div>

                        </div>
                    </div>

                    <div class="uk-width-medium-1-3">
                        <div class="uk-form-row">

                            <div class="md-input-wrapper">
                                <label>Dirección de correo del remitente</label>
                                <input type="text" name="from_mail" class="md-input">
                                <span class="md-input-bar">

                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="uk-width-medium-1-3">
                        <div class="uk-form-row">

                            <div class="md-input-wrapper">
                                <label>Asunto</label>
                                <input type="text" name="subject" class="md-input">
                                <span class="md-input-bar">
                                </span>
                            </div>
                        </div>
                    </div>

                </div>

                <br>
                <br>
                <label>Mensaje</label>
                <br>
                <br>

                <textarea name="content" id="wysiwyg_editor" cols="30" rows="20" autofocus>

                </textarea>

                <br>
                <input class="md-btn md-btn-primary uk-float-center" type="submit" value="enviar">


                {!! Form::close() !!}

            </div>
        </div>

    </div>
</div>




@stop

@section('scripts')

        <!-- ckeditor -->
    {!! HTML::script('bower_components/ckeditor/ckeditor.js') !!}
    {!! HTML::script('bower_components/ckeditor/adapters/jquery.js') !!}

    {!! HTML::script('assets/js/pages/forms_wysiwyg.min.js') !!}

@stop

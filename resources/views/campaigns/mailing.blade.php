@extends('layouts.main')

@section('content')



    <div id="page_content">
        <div id="page_content_inner">


            {!!  Form::open( array('url' => "campaigns/send_mailing" ) ) !!}


            <textarea name="mail" id="wysiwyg_editor" cols="30" rows="20" autofocus>

            </textarea>

            <input class="md-btn md-btn-primary" type="submit" value="enviar">


            {!! Form::close() !!}

        </div>
    </div>




@stop

@section('scripts')

        <!-- ckeditor -->
    {!! HTML::script('bower_components/ckeditor/ckeditor.js') !!}
    {!! HTML::script('bower_components/ckeditor/adapters/jquery.js') !!}

    {!! HTML::script('assets/js/pages/forms_wysiwyg.min.js') !!}

@stop

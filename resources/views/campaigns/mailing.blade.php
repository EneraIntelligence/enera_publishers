@extends('layouts.main')

@section('content')



    <div id="page_content">
        <div id="page_content_inner">




            <textarea id="wysiwyg_editor" cols="30" rows="20" autofocus>

            </textarea>

        </div>
    </div>




@stop

@section('scripts')

        <!-- ckeditor -->
    {!! HTML::script('bower_components/ckeditor/ckeditor.js') !!}
    {!! HTML::script('bower_components/ckeditor/adapters/jquery.js') !!}

    {!! HTML::script('assets/js/pages/forms_wysiwyg.min.js') !!}

@stop

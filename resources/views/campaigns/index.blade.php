@extends('layouts.main')

@section('content')

    <div id="top_bar">
        <div class="md-top-bar">
            <div class="uk-width-large-8-10 uk-container-center">
                <ul class="top_bar_nav" id="snippets_grid_filter">
                    <li class="uk-active" data-uk-filter="">
                        <a href="#">Todas</a>
                    </li>
                    <li data-uk-filter="snippets-lang-php">
                        <a href="#">PHP</a>
                    </li>
                    <li data-uk-filter="snippets-lang-css">
                        <a href="#">CSS</a>
                    </li>
                    <li data-uk-filter="snippets-lang-javascript">
                        <a href="#">jQuery</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


@stop
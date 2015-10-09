@extends('layouts.main')

@section('content')

    <div id="page_content">
        <div id="page_content_inner">

            {{--<h3 class="heading_b uk-margin-bottom">Blank Page</h3>--}}

            <div class="uk-grid" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
                <div class="uk-width-medium-1-6">
                    <div class="md-card" style="">
                        <div class="md-card-content">
                            <img src="{!! URL::asset('images/Enera_logo_400x130.png') !!}">
                        </div>
                    </div>
                </div>
                <div class="uk-width-medium-5-6">
                    <div class="md-card" style="">
                        <div class="md-card-content">

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop
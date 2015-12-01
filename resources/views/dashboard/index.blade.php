@extends('layouts.main')

@section('content')

    <div id="page_content">
        <div id="page_content_inner">
            {{--<h3 class="heading_b uk-margin-bottom">Blank Page</h3>--}}
            <div class="uk-grid" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
                <div class="uk-width-medium-2-6">
                    <div class="md-card" style="">
                        <div class="md-card-content">
                            <img src="{!! URL::asset('images/Enera_logo_400x130.png') !!}">
                        </div>
                    </div>
                    <div class="md-card" style="">
                        <div class="md-card-content">
                            <p>número</p>
                        </div>
                    </div>
                </div>
                <div class="uk-width-medium-4-6">
                    <div class="md-card" style="">
                        <div class="md-card-content">
                            <p>facebook</p>
                        </div>
                    </div>
                </div>
                <div class="uk-width-medium-6-6">
                    <div class="md-card" style="">
                        <div class="md-card-content">
                            <p>graficas</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop
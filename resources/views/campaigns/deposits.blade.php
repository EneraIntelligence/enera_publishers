@extends('layouts.main')
@section('title', ' - Budget')
@section('head_scripts')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.2/js/conekta.js"></script>
    <style>

    </style>
@stop
@section('content')

    <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid uk-grid-divider">
                <div class="uk-width-medium-1-2">
                    <div class="uk-panel uk-panel-box">
                        <h3 class="uk-panel-title">Conekta</h3>
                        <div class="uk-width-medium-4-5 uk-container-center">
                            <div class="uk-panel">
                                <form action="{!! route('budget::conekta') !!}" method="POST" id="card-form">
                                    <span class="card-errors"></span>
                                    <div class="form-row">
                                        <label>
                                            <span>Nombre del tarjetahabiente</span>
                                            <input type="text" size="20" data-conekta="card[name]"/>
                                        </label>
                                    </div>
                                    <div class="form-row">
                                        <label>
                                            <span>Número de tarjeta de crédito</span>
                                            <input type="text" size="20" data-conekta="card[number]"/>
                                        </label>
                                    </div>
                                    <div class="form-row">
                                        <label>
                                            <span>CVC</span>
                                            <input type="text" size="4" data-conekta="card[cvc]"/>
                                        </label>
                                    </div>
                                    <div class="form-row">
                                        <label>
                                            <span>Fecha de expiración (MM/AAAA)</span>
                                            <input type="text" size="2" data-conekta="card[exp_month]"/>
                                        </label>
                                        <span>/</span>
                                        <input type="text" size="4" data-conekta="card[exp_year]"/>
                                    </div>
                                    <button type="submit">¡Pagar ahora!</button>
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-medium-1-2">
                    <div class="uk-panel uk-panel-box">
                        <h3 class="uk-panel-title">Paypal</h3>
                        <div class="uk-width-medium-4-5 uk-container-center">
                            <div class="uk-panel">
                                ...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')

    <script>
        Conekta.setPublishableKey('key_EEMfnnqZZp3AhezEdytCc5A');

        $(function () {
            $("#card-form").submit(function(event) {
                var $form = $(this);

                // Previene hacer submit más de una vez
                $form.find("button").prop("disabled", true);
                Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);

                // Previene que la información de la forma sea enviada al servidor
                return false;
            });
        });

        var conektaSuccessResponseHandler = function(token) {
            var $form = $("#card-form");

            /* Inserta el token_id en la forma para que se envíe al servidor */
            $form.append($("<input type='hidden' name='conektaTokenId'>").val(token.id));

            /* and submit */
            $form.get(0).submit();
        };

        var conektaErrorResponseHandler = function(response) {
            var $form = $("#card-form");

            /* Muestra los errores en la forma */
            $form.find(".card-errors").text(response.message);
            $form.find("button").prop("disabled", false);
        };
    </script>
@stop
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
            <div class="uk-grid">
                <div class="uk-width-medium-1-3 uk-visible-small">
                    <div style="margin: 10px 0 20px 0;">
                        <h4 class="heading_a uk-margin-bottom">Información de presupuestos</h4>
                        <div class="md-card">
                            <div class="md-card-content">
                                <span class="uk-text-muted uk-text-small">Balance Actual</span>
                                <h2 class="uk-margin-remove uk-text-center" id="myTargetElement1">23</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-width-medium-2-3">
                    <h4 class="heading_a uk-margin-bottom">Metodos de pago</h4>
                    <div class="uk-panel uk-panel-box">
                        <div class="col-md-4"></div>
                        <div class="uk-width-medium-2-3 uk-width-small-2-3 uk-container-center">
                            <form action="">
                                <input type="radio" name="pay" value="conekta" checked style="display: inline-block;">
                                <img src="{!! URL::asset('images/icons/iconos_forma_de_pago-03.png') !!}" >
                                <input type="radio" name="pay" value="paypal" style="display: inline-block;">
                                <img src="{!! URL::asset('images/icons/iconos_forma_de_pago-01.png') !!}">
                                <input type="radio" name="pay" value="cupon" style="display: inline-block;">
                                <img src="{!! URL::asset('images/icons/iconos_forma_de_pago-02.png') !!}" >
                            </form>
                            <p style="display: inline-block;">T. Credito</p>
                            <p style="display: inline-block; margin-left: 30px;">Paypal</p>
                            <p style="display: inline-block; margin-left: 30px;">Cupon</p>

                        </div>
                        <div class="col-md-4"  id="conekta">
                            {{--<h3 class="uk-panel-title">Conekta</h3>--}}
                            <div class="uk-width-medium-4-5 uk-container-center">
                                <div class="uk-panel">
                                    <form action="{!! route('budget::conekta') !!}" method="POST" id="card-form"
                                          data-parsley-validate>
                                        <div class="uk-grid" data-uk-grid-margin="">
                                            <div class="uk-width-medium-1">
                                                <span class="card-errors" style="color: red;"></span>
                                                <br>
                                                <hr>
                                                <h2> Datos de Tarjeta</h2>
                                            </div>
                                            <div class="uk-width-medium-1-3">
                                                <div class="uk-form-row">
                                                    <div class="md-input-wrapper"><label>Monto</label>
                                                        <input class="md-input masked_input" id="masked_currency"
                                                               name="money" type="text"
                                                               data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'"
                                                               data-inputmask-showmaskonhover="false"/>
                                                        <span class="md-input-bar"></span></div>
                                                </div>
                                            </div>
                                            <div class="uk-width-medium-2-3">
                                                <div class="uk-form-row">
                                                    <div class="md-input-wrapper"><label>Nombre del
                                                            tarjetahabiente</label>
                                                        <input type="text" class="md-input" data-conekta="card[name]"
                                                               required>
                                                        <span class="md-input-bar"></span></div>
                                                </div>
                                            </div>
                                            <div class="uk-width-medium-2-3">
                                                <div class="uk-form-row">
                                                    <div class="md-input-wrapper"><label>Número de tarjeta de
                                                            crédito</label>
                                                        <input type="text" class="md-input" data-conekta="card[number]"
                                                               required>
                                                        <span class="md-input-bar"></span></div>
                                                </div>
                                            </div>
                                            <div class="uk-width-medium-1-3">
                                                <div class="uk-form-row">
                                                    <div class="md-input-wrapper"><label>CVC</label>
                                                        <input type="text" class="md-input" data-conekta="card[cvc]"
                                                               required
                                                               data-parsley-maxlength="4">
                                                        <span class="md-input-bar"></span></div>
                                                </div>
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                                <div class="uk-form-row">
                                                    <div class="md-input-wrapper"><label>Fecha de expiración
                                                            (MM)</label>
                                                        <input type="text" class="md-input"
                                                               data-conekta="card[exp_month]"
                                                               required
                                                               data-parsley-maxlength="2">
                                                        <span class="md-input-bar"></span></div>
                                                </div>
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                                <div class="uk-form-row">
                                                    <div class="md-input-wrapper"><label>Fecha de expiración
                                                            (AAAA)</label>
                                                        <input type="text" class="md-input"
                                                               data-conekta="card[exp_year]"
                                                               required
                                                               data-parsley-maxlength="4">
                                                        <span class="md-input-bar"></span></div>
                                                </div>
                                            </div>
                                            <div class="uk-width-medium-1">
                                                <hr>
                                                <h2> Datos de Facturación</h2>
                                            </div>
                                            <div class="uk-width-medium-1">
                                                <div class="uk-form-row">
                                                    <div class="md-input-wrapper"><label>Nombre</label>
                                                        <input type="text" name="name" class="md-input"
                                                               data-parsley-required>
                                                        <span class="md-input-bar"></span></div>
                                                </div>
                                            </div>
                                            <div class="uk-width-medium-1">
                                                <div class="uk-form-row">
                                                    <div class="md-input-wrapper"><label>Dirección</label>
                                                        <input type="text" name="address" class="md-input"
                                                               required>
                                                        <span class="md-input-bar"></span></div>
                                                </div>
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                                <div class="uk-form-row">
                                                    <div class="md-input-wrapper"><label>RFC</label>
                                                        <input type="text" name="rfc" class="md-input"
                                                               required>
                                                        <span class="md-input-bar"></span></div>
                                                </div>
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                                <div class="uk-form-row">
                                                    <div class="md-input-wrapper"><label>Pais</label>
                                                        <input type="text" name="country" class="md-input"
                                                               value="México"
                                                               required>
                                                        <span class="md-input-bar"></span></div>
                                                </div>
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                                <div class="uk-form-row">
                                                    <div class="md-input-wrapper"><label>Estado</label>
                                                        <input type="text" name="state" class="md-input"
                                                               required>
                                                        <span class="md-input-bar"></span></div>
                                                </div>
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                                <div class="uk-form-row">
                                                    <div class="md-input-wrapper"><label>Ciudad</label>
                                                        <input type="text" name="city" class="md-input"
                                                               required>
                                                        <span class="md-input-bar"></span></div>
                                                </div>
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                                <div class="uk-form-row">
                                                    <div class="md-input-wrapper"><label>Codigo Postal</label>
                                                        <input type="text" name="cp" class="md-input"
                                                               required>
                                                        <span class="md-input-bar"></span></div>
                                                </div>
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                                <div class="uk-form-row">
                                                    <div class="md-input-wrapper"><label>Telefono</label>
                                                        <input type="text" name="phone" class="md-input"
                                                               required>
                                                        <span class="md-input-bar"></span></div>
                                                </div>
                                            </div>
                                            <div class="uk-width-medium-1">
                                                <div class="uk-form-row">
                                                    <div class="md-input-wrapper"><label>Correo</label>
                                                        <input type="text" name="email" class="md-input"
                                                               required
                                                               data-parsley-type="email">
                                                        <span class="md-input-bar"></span></div>
                                                </div>
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                                <button type="button" class="md-btn md-btn-danger" onclick="window.location='{{ route("budget::index")}}'">Cancelar
                                                </button>
                                                <button type="submit" class="md-btn md-btn-primary">¡Pagar ahora!
                                                </button>
                                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="display: none;" id="paypal">
                            {{--<h3 class="uk-panel-title">Paypal</h3>--}}
                            <div class="uk-width-medium-4-5 uk-container-center">
                                <div class="uk-panel">
                                    <form action="{!! route('budget::conekta') !!}" method="POST" id="card-form"
                                          data-parsley-validate>
                                        <div class="uk-grid" data-uk-grid-margin="">
                                            <div class="uk-width-medium-1">
                                                <br>
                                                <hr>
                                                <div class="uk-form-row">
                                                    <div class="md-input-wrapper"><label>Monto</label>
                                                        <input class="md-input masked_input" id="masked_currency"
                                                               name="money" type="text"
                                                               data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'"
                                                               data-inputmask-showmaskonhover="false"/>
                                                        <span class="md-input-bar"></span></div>
                                                </div>
                                            </div>
                                            <div class="uk-width-medium-1-2" style="margin: 10px 0;">
                                                <button type="button" class="md-btn md-btn-danger" onclick="window.location='{{ route("budget::index")}}'">Cancelar
                                                </button>
                                                <button type="submit" class="md-btn md-btn-primary">Paypal
                                                </button>
                                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4" style="display: none" id="cupon">
                            {{--<h3 class="uk-panel-title">Cupón</h3>--}}
                            <div class="uk-width-medium-4-5 uk-container-center">
                                <div class="uk-panel">
                                    <form action="{!! route('budget::conekta') !!}" method="POST" id="card-form"
                                          data-parsley-validate>
                                        <div class="uk-grid" data-uk-grid-margin="">
                                            <div class="uk-width-medium-1">
                                                <br>
                                                <hr style="margin-top: 10px;">
                                                <div class="uk-form-row">
                                                    <div class="md-input-wrapper"><label>Codigo</label>
                                                        <input class="md-input masked_input"
                                                               name="money" type="text"/>
                                                        <span class="md-input-bar"></span></div>
                                                </div>
                                            </div>
                                            <div class="uk-width-medium-1-2" style="margin: 10px 0;">
                                                <button type="button" class="md-btn md-btn-danger" onclick="window.location='{{ route("budget::index")}}'">Cancelar
                                                </button>
                                                <button type="submit" class="md-btn md-btn-primary">Canjear Cupón
                                                </button>
                                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="uk-width-medium-1-3 uk-hidden-small" style="position: fixed;">
                    <div style="">
                        <h4 class="heading_a uk-margin-bottom">Información de presupuestos</h4>
                        <div class="md-card">
                            <div class="md-card-content">
                                <span class="uk-text-small">Balance actual</span>
                                <h2 class="uk-text-center" id="myTargetElement2" style="margin: 10px;">23</h2>
                                <span class=" uk-text-small">Fondos camapañas activas</span>
                                <div class="uk-width-large-1 uk-width-medium-1 uk-grid-margin">
                                    <ul class="md-list md-list-addon">

                                        @foreach($campaigns as $campaign)
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <i class="md-list-addon-icon material-icons uk-text-success"></i>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading">{{ $campaign->name }}</span>
                                                    <span class="uk-text-small uk-text-muted">
                                                        $ {{ number_format($campaign->balance['current'],2,'.',',') }}
                                                    </span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    {!! HTML::script('bower_components/parsleyjs/dist/parsley.min.js') !!}
    {!! HTML::script('bower_components/parsleyjs/src/i18n/es.js') !!}
    {!! HTML::script('bower_components/countUp.js/countUp.js') !!}
    {!! HTML::script('bower_components/ion.rangeslider/js/ion.rangeSlider.min.js') !!}
    {!! HTML::script('bower_components/jquery.inputmask/dist/jquery.inputmask.bundle.min.js') !!}
    {!! HTML::script('assets/js/pages/forms_advanced.min.js') !!}

    <script>
        Conekta.setPublishableKey('key_EEMfnnqZZp3AhezEdytCc5A');

        $(function () {
            $("#card-form").submit(function (event) {
                var $form = $(this);

                // Previene hacer submit más de una vez
                $form.find("button").prop("disabled", true);
                Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);

                // Previene que la información de la forma sea enviada al servidor
                return false;
            });
        });

        var conektaSuccessResponseHandler = function (token) {
            var $form = $("#card-form");

            /* Inserta el token_id en la forma para que se envíe al servidor */
            $form.append($("<input type='hidden' name='conektaTokenId'>").val(token.id));

            /* and submit */
            $form.get(0).submit();
        };

        var conektaErrorResponseHandler = function (response) {
            var $form = $("#card-form");

            /* Muestra los errores en la forma */
            $form.find(".card-errors").text(response.message);
            $form.find("button").prop("disabled", false);
        };

        $('#card-form').parsley();

        var divs = document.querySelectorAll('input');
        console.log(divs.length);
        for (var i = 0; i == divs.length; i++) {
            console.log(divs.length);
        }

        var option = {
            useEasing: false,
            useGrouping: true,
            separator: ',',
            decimal: '.',
            prefix: '$  ',
            suffix: ' MXN'
        };

        var balance = 100;
        var demo1 = new CountUp("myTargetElement1", 0, 100, 2, 3.0, option);
        var demo2 = new CountUp("myTargetElement2", 0, 100, 2, 3.0, option);
        demo1.start();
        demo2.start();


        $("input[name='pay']").change(function () {
            var int = $('input[name="pay"]:checked').val();
            if (int == 'conekta') {
                document.getElementById('conekta').style.display = 'block';
                document.getElementById('paypal').style.display = 'none';
                document.getElementById('cupon').style.display = 'none';
            } else if (int == 'paypal') {
                document.getElementById('conekta').style.display = 'none';
                document.getElementById('paypal').style.display = 'block';
                document.getElementById('cupon').style.display = 'none';
            }
            else if (int == 'cupon') {
                document.getElementById('conekta').style.display = 'none';
                document.getElementById('paypal').style.display = 'none';
                document.getElementById('cupon').style.display = 'block';
            }
        });
    </script>
@stop
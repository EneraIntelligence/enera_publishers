@extends('layouts.main_materialize')
@section('title', 'Budget')
@section('head_scripts')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.2/js/conekta.js"></script>
    {!! HTML::style(asset('assets/css/deposits.css')) !!}

    <style>

    </style>
@stop
@section('content')
    <div class="container " style="width: 85%;">
        <div class="row">
            <div class="col s12">
                <div class="col s12 margin-breadcrumb" >
                    <a href="#!" class="breadcrumb">Home</a>
                    <a href="#!" class="breadcrumb">Presupuestos</a>
                    <a href="#!" class="breadcrumb">Depositos</a>
                </div>
            </div>
            <div class="col s12 l4 hide-on-large-only">
                <h4 class="heading_a">Información de presupuestos</h4>
                <div class="col s12" style="padding: 0;">
                    <div class="">
                        <div class="card white table-of-contents">
                            <div class="card-content black-text">
                                <span class="text-small">Balance actual</span>
                                <h2 class="center-align amount" id="myTargetElement1" style="margin: 10px;"></h2>
                                <div class="uk-width-medium-1 center-align">
                                    <a class="waves-effect waves-light btn blue" href="{{ route("budget::deposits")}}"
                                       style="margin: 10px;">Agregar fondos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 l8">
                <div class="col s12">
                    <h4 class="heading_a">Metodos de pago</h4>
                    <div class="card white">
                        <div class="card-content black-text">
                            <div class="row">
                                <div class="col s12">
                                    <ul class="tabs">
                                        <li class="tab col s3"><a class="active" href="#pp">Paypal</a></li>
                                        <li class=" tab col s3 "><a href="#conekta">Terjeta de Credito</a></li>
                                        <li class="tab col s3"><a href="#giftcard">Giftcard</a></li>
                                    </ul>
                                </div>
                                <div id="pp" class="col s12">
                                    {!! Form::open(['route' => 'budget::paypal.store','method'=>'post', 'class' => 'formValidate', 'id'=>"paypal" ,
                                             'novalidate'=>"novalidate"]) !!}
                                    <div class="uk-grid" data-uk-grid-margin="">
                                        <div class="uk-width-medium-1">
                                            <br>
                                            <h2 class="heading_a">Deposita mediante PayPal</h2>
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper md-input-filled">
                                                    <label>Monto</label>
                                                    <input class="md-input masked_input"
                                                           id="budget_input" name="amount" type="text"
                                                           data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'"
                                                           data-inputmask-showmaskonhover="false"
                                                           value="1000" required>
                                                    <span class="md-input-bar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                        </div>

                                        <div class="uk-width-medium-1">
                                            <h3 class="heading_a"> Datos de Facturación</h3>
                                        </div>
                                        <div class="uk-width-medium-1">
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper">
                                                    <label>Nombre</label>
                                                    <input type="text" name="name" class="md-input"
                                                           data-parsley-required>
                                                    <span class="md-input-bar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1">
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper">
                                                    <label>Dirección</label>
                                                    <input type="text" name="address" class="md-input"
                                                           data-parsley-required>
                                                    <span class="md-input-bar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper">
                                                    <label>RFC</label>
                                                    <input type="text" name="rfc" class="md-input"
                                                           data-parsley-required>
                                                    <span class="md-input-bar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper md-input-filled">
                                                    <label>Pais</label>
                                                    <input type="text" name="country" class="md-input"
                                                           value="México" data-parsley-required>
                                                    <span class="md-input-bar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper">
                                                    <label>Estado</label>
                                                    <input type="text" name="state" class="md-input"
                                                           data-parsley-required>
                                                    <span class="md-input-bar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper">
                                                    <label>Ciudad</label>
                                                    <input type="text" name="city" class="md-input"
                                                           data-parsley-required>
                                                    <span class="md-input-bar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper">
                                                    <label>Codigo Postal</label>
                                                    <input type="text" name="cp" class="md-input"
                                                           data-parsley-required>
                                                    <span class="md-input-bar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper">
                                                    <label>Telefono</label>
                                                    <input type="text" name="phone" class="md-input"
                                                           data-parsley-required>
                                                    <span class="md-input-bar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1">
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper">
                                                    <label>Correo</label>
                                                    <input type="text" name="email" class="md-input"
                                                           data-parsley-required
                                                           data-parsley-type="email">
                                                    <span class="md-input-bar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                        </div>
                                        <div class="uk-width-medium-1" style="margin: 10px 0;">
                                            <button type="button" class="waves-effect waves-light btn red"
                                                    onclick="window.location='{!! route("budget::index") !!}'">
                                                Cancelar
                                            </button>
                                            <button type="submit" class="waves-effect waves-light btn blue b-mobile">
                                                Paypal
                                            </button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                <div id="conekta" class="col s12">
                                    <div class="col-md-4" id="conekta">

                                        <div class="uk-width-medium-4-5 uk-container-center">
                                            <div class="uk-panel">
                                                <form action="{!! route('budget::conekta') !!}" method="POST"
                                                      id="card-form" class="formValidate" novalidate="novalidate"
                                                      data-parsley-validate>
                                                    <div class="container-center">
                                                        <div class="uk-width-medium-1">
                                                            <span class="card-errors" style="color: red;"></span>
                                                            <h3 class="heading_a">Conekta</h3>
                                                            <h2 class="heading_a">Datos de Tarjeta</h2>
                                                        </div>
                                                        <div class="uk-width-medium-1-3">
                                                            <div class="uk-form-row">
                                                                <div class="md-input-wrapper"><label>Monto</label>
                                                                    <input class="md-input masked_input"
                                                                           id="budget_input"
                                                                           name="money" type="text"
                                                                           data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'"
                                                                           data-inputmask-showmaskonhover="false"
                                                                           data-parsley-multipleof="3"
                                                                           data-parsley-required/>
                                                                    <span class="md-input-bar"></span></div>
                                                                <p id="balance"></p>
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-medium-2-3">
                                                            <div class="uk-form-row">
                                                                <div class="md-input-wrapper">
                                                                    <label>Nombre del tarjetahabiente</label>
                                                                    <input type="text" class="md-input"
                                                                           data-conekta="card[name]" name="cname"
                                                                           required>
                                                                    <span class="md-input-bar"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-medium-2-3">
                                                            <div class="uk-form-row">
                                                                <div class="md-input-wrapper">
                                                                    <label>Número de tarjeta de crédito</label>
                                                                    <input type="text" class="md-input"
                                                                           data-conekta="card[number]" name="cnumber"
                                                                           required>
                                                                    <span class="md-input-bar"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-medium-1-3">
                                                            <div class="uk-form-row">
                                                                <div class="md-input-wrapper">
                                                                    <label>CVC</label>
                                                                    <input type="text" class="md-input"
                                                                           data-conekta="card[cvc]" name="cvc"
                                                                           required
                                                                           data-parsley-maxlength="4">
                                                                    <span class="md-input-bar"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="uk-form-row">
                                                                <div class="md-input-wrapper"><label>Fecha de expiración
                                                                        (MM)</label>
                                                                    <input type="text" class="md-input"
                                                                           data-conekta="card[exp_month]" name="month"
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
                                                                           data-conekta="card[exp_year]" name="year"
                                                                           required
                                                                           data-parsley-maxlength="4">
                                                                    <span class="md-input-bar"></span></div>
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-medium-1">
                                                            <hr>
                                                            <h2 class="heading_a"> Datos de Facturación</h2>
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
                                                                <div class="md-input-wrapper md-input-filled"><label>Pais</label>
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
                                                                <div class="md-input-wrapper"><label>Codigo
                                                                        Postal</label>
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
                                                            <button type="button"
                                                                    class="waves-effect waves-light btn red"
                                                                    onclick="window.location='{{ route("budget::index")}}'">
                                                                Cancelar
                                                            </button>
                                                            <button type="submit"
                                                                    class="waves-effect waves-light btn blue b-mobile">¡Pagar
                                                                ahora!
                                                            </button>
                                                            <input type="hidden" name="_token"
                                                                   value="<?php echo csrf_token(); ?>">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="giftcard" class="col s12">
                                    {!! Form::open(['route'=>'budget::giftcard.exchange', 'method'=>'POST', 'class' => 'formValidate', 'id'=>"gift-card" ,
                                             'novalidate'=>"novalidate"]) !!}
                                    <div class="container-center">
                                        <div class="uk-width-medium-1">
                                            <br>
                                            <h2 class="heading_a">GiftCard Code</h2>
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper">
                                                    <label>Ingresa aquí tu GiftCard Code</label>
                                                    <input class="md-input masked_input"
                                                           name="coupon" type="text"/>
                                                    <span class="md-input-bar"></span></div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1">
                                            <h3 class="heading_a"> Datos de Facturación</h3>
                                        </div>
                                        <div class="uk-width-medium-1">
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper">
                                                    <label>Nombre</label>
                                                    <input type="text" name="name" class="md-input"
                                                           data-parsley-required>
                                                    <span class="md-input-bar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1">
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper">
                                                    <label>Dirección</label>
                                                    <input type="text" name="address" class="md-input"
                                                           data-parsley-required>
                                                    <span class="md-input-bar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper">
                                                    <label>RFC</label>
                                                    <input type="text" name="rfc" class="md-input"
                                                           data-parsley-required>
                                                    <span class="md-input-bar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper md-input-filled">
                                                    <label>Pais</label>
                                                    <input type="text" name="country" class="md-input"
                                                           value="México" data-parsley-required>
                                                    <span class="md-input-bar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper">
                                                    <label>Estado</label>
                                                    <input type="text" name="state" class="md-input"
                                                           data-parsley-required>
                                                    <span class="md-input-bar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper">
                                                    <label>Ciudad</label>
                                                    <input type="text" name="city" class="md-input"
                                                           data-parsley-required>
                                                    <span class="md-input-bar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper">
                                                    <label>Codigo Postal</label>
                                                    <input type="text" name="cp" class="md-input"
                                                           data-parsley-required>
                                                    <span class="md-input-bar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper">
                                                    <label>Telefono</label>
                                                    <input type="text" name="phone" class="md-input"
                                                           data-parsley-required>
                                                    <span class="md-input-bar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1">
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper">
                                                    <label>Correo</label>
                                                    <input type="text" name="email" class="md-input"
                                                           data-parsley-required
                                                           data-parsley-type="email">
                                                    <span class="md-input-bar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                        </div>
                                        <div class="uk-width-medium-1" style="margin: 10px 0;">
                                            <button type="button" class="waves-effect waves-light btn red"
                                                    onclick="window.location='{{ route("budget::index")}}'">
                                                Cancelar
                                            </button>
                                            <button type="submit" class="waves-effect waves-light btn blue b-mobile">Canjear
                                                Cupón
                                            </button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 l4 hide-on-med-and-down" colspan="">
                <div class="col s12">
                    <h4 class="heading_a">Información de presupuestos</h4>
                    <div class="card white">
                        <div class="card-content black-text">
                            <span class="text-small">Balance actual</span>
                            <h2 class="center-align amount" id="myTargetElement2" style="margin: 10px;"></h2>
                            <span class=" uk-text-small">Fondos camapañas activas</span>
                            <table class="balance">
                                <tbody>
                                <tr>
                                    <td class="p25" height="20">
                                        <i class="md-list-addon-icon material-icons blue-text">
                                            &#xE918;
                                        </i>
                                    </td>
                                    <td class="p75" height="20">
                                        <span class="td-heading">Total Asignado</span>
                    <span class="text-small text-muted">
                    $ {{ number_format($campaigns->sum('balance.current'),2,'.',',') }}
                    </span>
                                    </td>
                                </tr>
                                @foreach($campaigns as $campaign)
                                    <tr>
                                        <td height="20">
                                            <i class="md-list-addon-icon material-icons uk-text-success"></i>
                                        </td>
                                        <td height="20">
                                            <span class="td-heading">{{ $campaign->name }}</span>
                    <span class="text-small text-muted">
                    $ {{ number_format($campaign->balance['current'],2,'.',',') }}
                    </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('scripts')

    {!! HTML::script('js/jquery-validation/dist/jquery.validate.js') !!}
    {!! HTML::script('bower_components/countUp.js/countUp.js') !!}

    <script>
        $(document).ready(function () {
            $("#paypal").validate({
                rules: {
                    amount: {
                        required: true,
                        min: 100
                    },
                    name: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    rfc: {
                        required: true,
                        minlength: 12
                    },
                    country: {
                        required: true
                    },
                    state: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    cp: {
                        required: true
                    },
                    phone: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    }
                },
                //For custom messages
                messages: {
                    amount: {
                        required: "* Ingresa una cantidad ",
                        min: "* La cantidad debe ser minimo $100.00"

                    },
                    name: {
                        required: "* Ingresa un nombre",
                        min: "* El nombre debe tener minomo "

                    },
                    address: {
                        required: "* Ingresa un nombre",
                        min: "* El nombre debe tener minomo "

                    },
                    rfc: {
                        required: "* Ingresa un Registro Federal de Causante",
                        min: "* El rfc debe tener minimo 12 caracteres "
                    },
                    country: {
                        required: "* Ingresa un Pais"

                    },
                    state: {
                        required: "* Ingresa un estado"

                    },
                    city: {
                        required: "* Ingresa un estado"

                    },
                    cp: {
                        required: "* Ingresa un ciudad"

                    },
                    phone: {
                        required: "* Ingresa un telefono"

                    },
                    email: {
                        required: "* Ingresa un correo electronico",
                        email: '* Ingresa un emial valido'

                    }
                },
                errorElement: 'div',
                errorPlacement: function (error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            $("#card-form").validate({
                rules: {
                    money: {
                        required: true,
                        min: 100
                    },
                    cnumber: {
                        required: true
                    },
                    cname: {
                        required: true
                    },
                    cvc: {
                        required: true
                    },
                    month: {
                        required: true,
                        minlength: 2
                    },
                    year: {
                        required: true,
                        minlength: 4
                    },
                    name: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    rfc: {
                        required: true,
                        minlength: 12
                    },
                    country: {
                        required: true
                    },
                    state: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    cp: {
                        required: true
                    },
                    phone: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    }
                },
                //For custom messages
                messages: {
                    money: {
                        required: "* Ingresa una cantidad ",
                        min: "* La cantidad debe ser minimo $100.00"

                    },
                    cnumber: {
                        required: "Ingresa el número de tu tarjeta"
                    },
                    cname: {
                        required: "Ingresa el nombre del tarjetahabiente "
                    },
                    cvc: {
                        required: "Ingresa el númmero CVC de tu tarjeta"
                    },
                    month: {
                        required: "Ingresa el mes de expiración de tu tarjeta",
                        minlength: "Ingresa el mes con dos digitos Ej: 01"
                    },
                    year: {
                        required: "ingresa el año de expiracion de tu tarjeta",
                        minlength: "Ingresa la año con cuatro digitos Ej: 2016"
                    },
                    name: {
                        required: "* Ingresa un nombre",
                        min: "* El nombre debe tener minomo "

                    },
                    address: {
                        required: "* Ingresa un nombre",
                        min: "* El nombre debe tener minomo "

                    },
                    rfc: {
                        required: "* Ingresa un Registro Federal de Causante",
                        min: "* El rfc debe tener minimo 12 caracteres "
                    },
                    country: {
                        required: "* Ingresa un Pais"

                    },
                    state: {
                        required: "* Ingresa un estado"

                    },
                    city: {
                        required: "* Ingresa un estado"

                    },
                    cp: {
                        required: "* Ingresa un codigo postal valido"

                    },
                    phone: {
                        required: "* Ingresa un telefono"

                    },
                    email: {
                        required: "* Ingresa un correo electronico",
                        email: '* Ingresa un emial valido'

                    }
                },
                errorElement: 'div',
                errorPlacement: function (error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            $("#gift-card").validate({
                rules: {
                    coupon: {
                        required: true,
                        min: 100
                    },
                    name: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    rfc: {
                        required: true,
                        minlength: 12
                    },
                    country: {
                        required: true
                    },
                    state: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    cp: {
                        required: true
                    },
                    phone: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    }
                },
                //For custom messages
                messages: {
                    coupon: {
                        required: "* Ingresa el númepr del cupon "
                    },
                    name: {
                        required: "* Ingresa un nombre"
                    },
                    address: {
                        required: "* Ingresa una dirección"
                    },
                    rfc: {
                        required: "* Ingresa un Registro Federal de Causante",
                        min: "* El rfc debe tener minimo 12 caracteres "
                    },
                    country: {
                        required: "* Ingresa un Pais"

                    },
                    state: {
                        required: "* Ingresa un estado"

                    },
                    city: {
                        required: "* Ingresa un estado"

                    },
                    cp: {
                        required: "* Ingresa un codigo postal valido"

                    },
                    phone: {
                        required: "* Ingresa un telefono"

                    },
                    email: {
                        required: "* Ingresa un correo electronico",
                        email: '* Ingresa un emial valido'

                    }
                },
                errorElement: 'div',
                errorPlacement: function (error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

        });
    </script>
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

//        $('#card-form').parsley();

        var divs = document.querySelectorAll('input');
        for (var i = 0; i == divs.length; i++) {
            console.log(divs.length);
        }

        $("#budget_input").change(function () {

            var budgetStr = $("#budget_input").val().substr(1);//remove $
            budgetStr = budgetStr.replace(/,/g, '');//remove commas

            var budget = parseFloat(budgetStr);
            var msg = "";

            $("#balance").css("color", "black");
            if (budget < 100) {
                msg = '<div style="color:red" class="md-input-danger"> La cantidad debe ser al menos $100</div> ';
            }
            if (budget > 20000) {
                msg = '<div style="color:red" class="md-input-danger"> La cantidad debe ser menor $20,000</div> ';
            }

            $("#balance").html(msg);
        });


        var option = {
            useEasing: false,
            useGrouping: true,
            separator: ',',
            decimal: '.',
            prefix: '$  ',
            suffix: ' MXN'
        };

        var balance = {!! $admin->wallet->current !!};
        var demo1 = new CountUp("myTargetElement1", 0, balance, 2, 3.0, option);
        var demo2 = new CountUp("myTargetElement2", 0, balance, 2, 3.0, option);
        demo1.start();
        demo2.start();

    </script>

@stop


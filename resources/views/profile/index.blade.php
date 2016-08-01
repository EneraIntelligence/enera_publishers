@extends('layouts.main_materialize')
@section('title', ' Perfil')
@section('head_scripts')
    {!! HTML::style(asset('assets/css/profile.css')) !!}
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content blue">
                        <div class="row">
                            <div class="col s6 m2 l1">
                                <img class="img"
                                     src="https://s3-us-west-1.amazonaws.com/enera-publishers/avatars/{!! isset($user->image) ? $user->image : 'user.png'!!}"
                                     alt="User avatar"/>
                            </div>
                            <div class="col s6 m3 l3">
                                <div class="chip chip-profile">
                                    <p>Activas: {{$active}}</p>
                                </div>
                                <div class="chip chip-profile">
                                    <p>Canceladas: {{$canceled}}</p>
                                </div>
                                <div class="chip chip-profile">
                                    <p>Terminadas: {{$closed}}</p>
                                </div>
                            </div>
                            <div class="col s12 m7 l8">
                                <h4 class="truncate name-profile center-align">{!! $user->name['first'] . " " . $user->name['last'] !!}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content white">
                        <div class="row">
                            <form action="{!! route('edit.profile') !!}" method="post" id="commentForm" data-parsley-validate
                                  enctype="multipart/form-data"
                                  class="uk-form-stacked">
                                <fieldset>
                                    <legend>Infomación Personal</legend>
                                    <div class="input-field col s12 m6 error-field">
                                        <i class="material-icons prefix">keyboard_arrow_right</i>
                                        <input type="text" name="email" value="{{$user->email}}" disabled="disabled">
                                        <label for="email">Correo</label>
                                    </div>
                                    <div class="input-field col s12 m6 error-field">
                                        <i class="material-icons prefix">keyboard_arrow_right</i>
                                        <input type="text" name="facebook" disabled="disabled" class="editable" value="{{$user->socialnetwork['facebook']}}">
                                        <label for="facebook">Facebook</label>
                                    </div>
                                    <div class="input-field col s12 m6 error-field">
                                        <i class="material-icons prefix">keyboard_arrow_right</i>
                                        <input type="text" name="twitter" disabled="disabled" class="editable" value="{{$user->socialnetwork['twitter']}}">
                                        <label for="twitter">Twitter</label>
                                    </div>
                                    <div class="input-field col s6 m6 error-field">
                                        <i class="material-icons prefix">keyboard_arrow_right</i>
                                        <input type="text" name="google" disabled="disabled" class="editable" value="{{$user->socialnetwork['googleplus']}}">
                                        <label for="google">Google+</label>
                                    </div>
                                    <div class="input-field col s12 m3 error-field">
                                        <i class="material-icons prefix">keyboard_arrow_right</i>
                                        <input type="text" name="phone" disabled="disabled" class="editable" value="{{$user->phones['number']}}">
                                        <label for="phone">Telefono</label>
                                    </div>
                                    <div class="input-field col s12 m3">
                                        <select disabled="disabled" class="editable" name="type">
                                            <option value="Casa">Casa</option>
                                            <option value="Oficina">Oficina</option>
                                            <option value="Celular">Celular</option>
                                        </select>
                                        <label>Tipo</label>
                                    </div>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="input-field col s12 m6 error-field">
                                        <i class="material-icons prefix">keyboard_arrow_right</i>
                                        <input type="text" name="link" disabled="disabled" class="editable" value="{{$user->socialnetwork['linkedin']}}">
                                        <label for="link">Linkedin</label>
                                    </div>
                                    <div class="col s12 m6" id="div-edit">
                                        <br>
                                        <p>
                                            <button type="button" class="waves-effect waves-light btn blue"
                                                    id="edit">
                                                Editar
                                            </button>
                                        </p>
                                    </div>
                                    <div class="col s12 m6 none" id="div-update">
                                        <br>
                                        <p>
                                            <button type="button" class="waves-effect waves-light btn red"
                                                    id="cancel">
                                                Cancelar
                                            </button>
                                            <button type="submit" class="waves-effect waves-light btn blue b-mobile">
                                                Actualizar
                                            </button>
                                        </p>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop

@section('scripts')
    {!! HTML::script('js/jquery-validation/dist/jquery.validate.js') !!}
    <script>

        $("#commentForm").validate({
            rules: {
                email: {
                    required: true
                },
                facebook: {
                    required: true
                },
                twitter: {
                    required: true
                },
                google: {
                    required: true
                },
                phone: {
                    required: true
                },
                link: {
                    required: true
                }
            },
            //For custom messages
            messages: {
                email: {
                    required: "* Ingresa el correo valido",
                    email: "* Ingresa un direccion de email valida"
                },
                facebook: {
                    required: "* Ingresa una dirección de Facebook",
                    url: "Ingresa un direcciín de facebook valida"
                },
                twitter: {
                    required: "* Ingresa una dirección de Twitter",
                    url: "Ingresa un direcciín de twitter valida"
                },
                google: {
                    required: "* Ingresa una dirección de Google Plus ",
                    url: "Ingresa un direcciín de google plus valida"
                },
                phone: {
                    required: "* Ingresa un telefono"

                },
                link: {
                    required: "* Ingresa una dirección de Linkedin",
                    url: "Ingresa un direcciín de linkedin valida"

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

        $('select').material_select();

        $("#edit").click(function (event) {
            event.preventDefault();
            $('.editable').prop("disabled", false);
            $('select').material_select();
            document.getElementById('div-edit').setAttribute("class", 'col s12 m6 none');
            document.getElementById('div-update').setAttribute("class", 'col s12 m6');
        });

        $("#cancel").click(function (event) {
            event.preventDefault();
            document.getElementById("commentForm").reset();
            $('.editable').prop("disabled", "disabled");
            $('select').material_select();
            document.getElementById('div-edit').setAttribute("class", 'col s12 m6 ');
            document.getElementById('div-update').setAttribute("class", 'col s12 m6 none');
        });
    </script>
@stop
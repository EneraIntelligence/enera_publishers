@extends('layouts.main_materialize')
@section('title', ' Perfil')
@section('head_scripts')
    {!! HTML::style(asset('assets/css/profile.css')) !!}
@stop
@section('content')
    <form action="{!! route('edit.profile') !!}" method="post" id="commentForm" data-parsley-validate
          enctype="multipart/form-data"
          class="uk-form-stacked">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content blue h-mobile" >
                            <div class="row">
                                <div class="col s6 m2 l1">
                                    <img class="img" id="img"
                                         src="https://s3-us-west-1.amazonaws.com/enera-publishers/avatars/{!! isset($user->image) ? $user->image : 'user.png'!!}"
                                         alt="User avatar"/>
                                    <div class="file-field input-field file-button none" id="img-button">
                                        <div class="btn btn-floating ">
                                            <i class="material-icons">keyboard_arrow_up</i>
                                            <input type="file" name="user_edit_avatar_control" accept='image/*'
                                                   id="user_edit_avatar_control">
                                        </div>
                                    </div>
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
                                <div class="col s12 m7 l8" id="name-edit">
                                    <h4 class="truncate name-profile center-align">{!! $user->name['first'] . " " . $user->name['last'] !!}</h4>
                                </div>
                                <div class="col s12 m7 l8 none" id="name-update">
                                    <div class="input-field col s12 m6 error-field input-name">
                                        <i class="material-icons prefix">keyboard_arrow_right</i>
                                        <input type="text" name="name" disabled="disabled" class="editable"
                                               value="{{$user->name['first']}}">
                                        <label for="name">Nombre</label>
                                    </div>
                                    <div class="input-field col s12 m6 error-field input-name">
                                        <i class="material-icons prefix">keyboard_arrow_right</i>
                                        <input type="text" name="lastname" disabled="disabled" class="editable"
                                               value="{{$user->name['last']}}">
                                        <label for="lastname">Apellido</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-content white">
                            <div class="row">

                                <fieldset>
                                    <legend>Infomación Personal</legend>
                                    <div class="input-field col s12 m6 error-field">
                                        <i class="material-icons prefix">keyboard_arrow_right</i>
                                        <input type="text" name="email" value="{{$user->email}}" disabled="disabled">
                                        <label for="email">Correo</label>
                                    </div>
                                    <div class="input-field col s12 m6 error-field">
                                        <i class="material-icons prefix">keyboard_arrow_right</i>
                                        <input type="text" name="facebook" disabled="disabled" class="editable"
                                               value="{{$user->socialnetwork['facebook']}}">
                                        <label for="facebook">Facebook</label>
                                    </div>
                                    <div class="input-field col s12 m6 error-field">
                                        <i class="material-icons prefix">keyboard_arrow_right</i>
                                        <input type="text" name="twitter" disabled="disabled" class="editable"
                                               value="{{$user->socialnetwork['twitter']}}">
                                        <label for="twitter">Twitter</label>
                                    </div>
                                    <div class="input-field col s12 m6 error-field">
                                        <i class="material-icons prefix">keyboard_arrow_right</i>
                                        <input type="text" name="google" disabled="disabled" class="editable"
                                               value="{{$user->socialnetwork['googleplus']}}">
                                        <label for="google">Google+</label>
                                    </div>
                                    <div class="input-field col s8 m3 error-field">
                                        <i class="material-icons prefix">keyboard_arrow_right</i>
                                        <input type="text" name="phone" disabled="disabled" class="editable"
                                               value="{{$user->phones['number']}}">
                                        <label for="phone">Telefono</label>
                                    </div>
                                    <div class="input-field col s4 m3">
                                        <select disabled="disabled" class="editable" name="type" id="sel">
                                            <option value="Casa">Casa</option>
                                            <option value="Oficina">Oficina</option>
                                            <option value="Celular">Celular</option>
                                        </select>
                                        <label>Tipo</label>
                                    </div>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="input-field col s12 m6 error-field">
                                        <i class="material-icons prefix">keyboard_arrow_right</i>
                                        <input type="text" name="link" disabled="disabled" class="editable"
                                               value="{{$user->socialnetwork['linkedin']}}">
                                        <label for="link">Linkedin</label>
                                    </div>
                                    <div class="col s12 m6 see" id="div-edit">
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('scripts')
    {!! HTML::script('js/jquery-validation/dist/jquery.validate.js') !!}
    <script>
        document.getElementById('sel').value = '{!! $user->phones['type'] !!}';
        $("#commentForm").validate({
            rules: {
                name: {
                    required: true
                },
                lastname: {
                    required: true
                },
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
                name: {
                    required: "* Ingresa tu nombre"
                },
                lastname: {
                    required: "* Ingresa tus apellidos",
                },
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
            document.getElementById('name-edit').setAttribute("class", 'col s12 m6 none');
            document.getElementById('name-update').setAttribute("class", 'col s12 m6');
            document.getElementById('img-button').setAttribute("class", 'file-field input-field file-button');
        });

        $("#cancel").click(function (event) {
            event.preventDefault();
            document.getElementById("commentForm").reset();
            document.getElementById('sel').value = '{{$user->phones['type']}}';
            $('.editable').prop("disabled", "disabled");
            $('select').material_select();
            document.getElementById('div-edit').setAttribute("class", 'col s12 m6 ');
            document.getElementById('div-update').setAttribute("class", 'col s12 m6 none');
            document.getElementById('name-edit').setAttribute("class", 'col s12 m6 ');
            document.getElementById('name-update').setAttribute("class", 'col s12 m6 none');
            document.getElementById('img-button').setAttribute("class", 'file-field input-field file-button none');
        });



        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#user_edit_avatar_control").change(function () {
            readURL(this);
        });
    </script>
@stop
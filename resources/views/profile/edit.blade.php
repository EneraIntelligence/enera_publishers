@extends('layouts.main')
@section('title', ' - Editar Perfil')
@section('head_scripts')
    {!! HTML::style(asset('assets/css/profile.css')) !!}
@endsection

@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-1">
                    <form action="{!! route('edit.profile') !!}" method="post" id="form" data-parsley-validate
                          enctype="multipart/form-data"
                          class="uk-form-stacked">
                        <div class="md-card profile_mobile">
                            <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="user_heading_avatar">
                                        <div>
                                            <img id="img"
                                                 src="https://s3-us-west-1.amazonaws.com/enera-publishers/avatars/{!! $user->image !!}"
                                                 alt="User avatar"/>
                                        </div>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div class="user_avatar_controls">
                                        <span class="btn-file">
                                            <span class="fileinput-new"><i class="material-icons">&#xE2C6;</i></span>
                                            <span class="fileinput-exists"><i class="material-icons">&#xE86A;</i></span>
                                            <input type="file" name="user_edit_avatar_control" accept='image/*'
                                                   id="user_edit_avatar_control">
                                        </span>
                                        <a href="#" class="btn-file fileinput-exists" data-dismiss="fileinput"><i
                                                    class="material-icons">&#xE5CD;</i></a>
                                    </div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate"
                                                                id="user_edit_uname">{!! $user->name['first'] . " " . $user->name['last'] !!}</span><span
                                                class="sub-heading"
                                                id="user_edit_position">{!! $user->id !!}</span></h2>
                                </div>
                                {{--<button id="edit-info" type="submit" class="md-fab md-fab-small md-fab-success"--}}
                                {{--id="user_edit_submit">--}}
                                {{--<i class="material-icons">&#xE161;</i>--}}
                                {{--</button>--}}
                                <div
                                        id="canvasloader-container" class="wrapper"></div>
                            </div>
                            <div class="user_content">
                                <div id="page_content">
                                    <div id="page_content_inner ">
                                        <h3 class="heading_b uk-margin-bottom">Información de cuenta</h3>
                                        {{--<div class="md-card">--}}
                                        <div class="md-card-content small-padding">

                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-2 profile_mobile">
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon">
                                                            <i class="uk-icon-user uk-icon-medium"></i>
                                                        </span>

                                                        <div class="parsley-row">
                                                            <label for="fullname">Nombre<span
                                                                        class="req">*</span></label>
                                                            <input type="text" name="name" required
                                                                   class="md-input"
                                                                   value="{!! $user->name['first'] !!}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-2 profile_mobile">
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon">
                                                            <i class="uk-icon-user uk-icon-medium"></i>
                                                        </span>

                                                        <div class="parsley-row">
                                                            <label for="lastname">Apellido<span
                                                                        class="req">*</span></label>
                                                            <input type="text" name="lastname" required
                                                                   class="md-input"
                                                                   value="{!! $user->name['last'] !!}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-2 profile_mobile">
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon">
                                                            <i class="uk-icon-at uk-icon-medium"></i>
                                                        </span>

                                                        <div class="parsley-row">
                                                            <label for="email">Correo</label>
                                                            <input type="email" name="email" disabled
                                                                   data-parsley-trigger="change"
                                                                   required class="md-input"
                                                                   value="{!! $user->email !!}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-2 profile_mobile">
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon">
                                                            <i class="uk-icon-facebook-official uk-icon-medium"></i>
                                                        </span>

                                                        <div class="parsley-row">
                                                            <label for="facebook">Facebook<span
                                                                        class="req">*</span></label>
                                                            <input type="text" name="facebook" required
                                                                   class="md-input"
                                                                   value="{!! $user->socialnetwork['facebook'] !!}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-2 profile_mobile">
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon">
                                                            <i class="uk-icon-linkedin-square uk-icon-medium"></i>
                                                        </span>

                                                        <div class="parsley-row">
                                                            <label for="linkedin">LinkedIn<span
                                                                        class="req">*</span></label>
                                                            <input type="text" name="linkedin" required
                                                                   class="md-input"
                                                                   value="{!! $user->socialnetwork['linkedin'] !!}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-width-small-1-2 uk-width-medium-1-4 profile_mobile">
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon">
                                                            <i class="uk-icon-phone-square uk-icon-medium"></i>
                                                        </span>

                                                        <div class="parsley-row">
                                                            <label for="phone_number">Telefono<span
                                                                        class="req">*</span></label>
                                                            <input id="phone_number" type="text" name="phone" required
                                                                   class="md-input"
                                                                   value="{!! $user->phones['number'] !!}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-width-small-1-2 uk-width-medium-1-4 profile_mobile">
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon">
                                                            <i class="uk-icon-phone uk-icon-medium"></i>
                                                        </span>

                                                        <div class="parsley-row">
                                                            <select id="val_select" name="type" required
                                                                    data-md-selectize>
                                                                <option value="Celular">Celular</option>
                                                                <option value="Trabajo">Trabajo</option>
                                                                <option value="Casa">Casa</option>
                                                                <option value="Otro">Otro</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-2 profile_mobile">
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon">
                                                            <i class="uk-icon-twitter uk-icon-medium"></i>
                                                        </span>

                                                        <div class="parsley-row">
                                                            <label for="twitter">Twitter<span
                                                                        class="req">*</span></label>
                                                            <input type="text" name="twitter" required
                                                                   class="md-input"
                                                                   value="{!! $user->socialnetwork['twitter'] !!}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-2 profile_mobile">
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon">
                                                            <i class="uk-icon-google uk-icon-medium"></i>
                                                        </span>

                                                        <div class="parsley-row">
                                                            <label for="google">Google+<span
                                                                        class="req">*</span></label>
                                                            <input type="text" name="google" required
                                                                   class="md-input"
                                                                   value="{!! $user->socialnetwork['googleplus'] !!}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-grid uk-grid-small">
                                                    <div class="uk-width-1-2">
                                                        <button type="submit" class="md-btn md-btn-primary">Actualizar
                                                        </button>
                                                    </div>
                                                    <div class="uk-width-1-2">
                                                        <button type="button" class="md-btn md-btn-danger"
                                                                onclick="window.location='{{ route("profile::index")}}'">
                                                            Cancelar
                                                        </button>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                <input type="hidden" name="_id" value="{{$user->_id}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="uk-width-large-1">
                    <form action="{!! route('edit.pass') !!}" method="post" id="form_validation"
                          enctype="multipart/form-data" data-parsley-validate
                          class="uk-form-stacked">
                        <div class="md-card profile_mobile">
                            <div class="user_content">
                                <div id="page_content">
                                    <div id="page_content_inner ">
                                        <h3 class="heading_b uk-margin-bottom">Cámbiar contraseña</h3>
                                        {{--<div class="md-card">--}}
                                        <div class="md-card-content small-padding">

                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-2 profile_mobile">
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon">
                                                            <i class="uk-icon-user uk-icon-medium"></i>
                                                        </span>

                                                        <div class="parsley-row">
                                                            <label for="pass">Contraseña<span
                                                                        class="req">*</span></label>
                                                            <input type="password" name="pass"
                                                                   data-parsley-required="true"
                                                                   data-parsley-type="alphanum"
                                                                   data-parsley-length="[8, 16]"
                                                                   data-parsley-equalto="#pass_confir"
                                                                   class="md-input" id="pass"
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-2 profile_mobile">
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon">
                                                            <i class="uk-icon-user uk-icon-medium"></i>
                                                        </span>

                                                        <div class="parsley-row">
                                                            <label for="pass_confir">Confirmar contraseña<span
                                                                        class="req">*</span></label>
                                                            <input type="password" name="pass_confir"
                                                                   data-parsley-required="true"
                                                                   data-parsley-type="alphanum"
                                                                   data-parsley-equalto="#pass"
                                                                   class="md-input" id="pass_confir"
                                                            />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="uk-grid uk-grid-small">
                                                    <div class="uk-width-1-2">
                                                        <button type="submit" class="md-btn md-btn-primary">Actualizar
                                                        </button>
                                                    </div>
                                                    <div class="uk-width-1-2">
                                                        <button type="button" class="md-btn md-btn-danger"
                                                                onclick="window.location='{{ route("profile::index")}}'">
                                                            Cancelar
                                                        </button>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                <input type="hidden" name="_id" value="{{$user->_id}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@stop

@section('scripts')
    {!! HTML::script('js/ajax/logs.js') !!}
    {!! HTML::script('js/canvasloader.js') !!}
    {!! HTML::script('js/greensock/plugins/CSSPlugin.min.js') !!}
    {!! HTML::script('js/greensock/easing/EasePack.min.js') !!}
    {!! HTML::script('js/greensock/TweenLite.min.js') !!}
    {!! HTML::script('bower_components/parsleyjs/dist/parsley.min.js') !!}
    {!! HTML::script('bower_components/parsleyjs/src/i18n/es.js') !!}

    <script>


        $(document).ready(function () {
            $("#phone_number").kendoMaskedTextBox({
                mask: "(99) 0000-0000"
            });
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


        $('#form_validation').parsley();
        $('#form').parsley();


    </script>
@stop
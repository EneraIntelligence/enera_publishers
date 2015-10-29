@extends('layouts.main')
@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <form action="" class="uk-form-stacked" id="user_edit_form">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-1">
                        <div class="md-card">
                            <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <img src="assets/img/blank.png" alt="user avatar"/>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div class="user_avatar_controls">
                                        <span class="btn-file">
                                            <span class="fileinput-new"><i class="material-icons">&#xE2C6;</i></span>
                                            <span class="fileinput-exists"><i class="material-icons">&#xE86A;</i></span>
                                            <input type="file" name="user_edit_avatar_control"
                                                   id="user_edit_avatar_control">
                                        </span>
                                        <a href="#" class="btn-file fileinput-exists" data-dismiss="fileinput"><i
                                                    class="material-icons">&#xE5CD;</i></a>
                                    </div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate"
                                                                id="user_edit_uname">{!! $user->name !!}</span><span
                                                class="sub-heading"
                                                id="user_edit_position">{!! $user->id !!}</span></h2>
                                </div>
                                <button  id="edit-info" type="submit" class="md-fab md-fab-small md-fab-success" onclick="showLoader()" id="user_edit_submit">
                                    <i class="material-icons">&#xE161;</i>
                                </button>
                                <div style=" width: 70px; height: 70px; margin: -55px auto 0 auto;"
                                     id="canvasloader-container" class="wrapper"></div>
                            </div>
                            <div class="user_content">
                                <ul id="user_edit_tabs" class="uk-tab"
                                    data-uk-tab="{connect:'#user_edit_tabs_content'}">
                                    <li class="uk-active"><a href="#">Basic</a></li>
                                </ul>
                                <ul id="user_edit_tabs_content" class="uk-switcher uk-margin">
                                    <li>
                                        <div class="uk-margin-top">
                                            <h3 class="full_width_in_card heading_c">
                                                General info
                                            </h3>

                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-2">
                                                    <label for="user_edit_uname_control">Nombre</label>
                                                    <input class="md-input" type="text" id="user_edit_uname_control"
                                                           name="user_edit_uname_control" value="{!! $user->name !!}"/>
                                                </div>
                                                <div class="uk-width-medium-1-2">
                                                    <label for="user_edit_position_control">Posición</label>
                                                    <input class="md-input" type="text" id="user_edit_position_control"
                                                           name="user_edit_position_control"
                                                           value="{!! $user->rol_id !!}"/>
                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                {{--<div class="uk-width-1-1">--}}
                                                {{--<label for="user_edit_personal_info_control">About</label>--}}
                                                {{--<textarea class="md-input" name="user_edit_personal_info_control"--}}
                                                {{--id="user_edit_personal_info_control" cols="30" rows="4">Ullam est exercitationem dolor quod optio asperiores iusto numquam error velit sit animi est est repudiandae minus quam cumque ipsum quis id aperiam aut asperiores est ut voluptatem ab quibusdam dicta.</textarea>--}}
                                                {{--</div>--}}
                                            </div>

                                            <h3 class="full_width_in_card heading_c">
                                                Contact info
                                            </h3>

                                            <div class="uk-grid">
                                                <div class="uk-width-1-1">
                                                    <div class="uk-grid uk-grid-width-1-1 uk-grid-width-large-1-2"
                                                         data-uk-grid-margin>
                                                        <div>
                                                            <div class="uk-input-group">
                                                                <span class="uk-input-group-addon">
                                                                    <i class="md-list-addon-icon material-icons">
                                                                        &#xE158;</i>
                                                                </span>
                                                                <label>Correo</label>
                                                                <input type="text" class="md-input"
                                                                       name="user_edit_email"
                                                                       value="{!! $user->email !!}"/>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="uk-input-group">
                                                                <span class="uk-input-group-addon">
                                                                    <i class="md-list-addon-icon material-icons">
                                                                        &#xE0CD;</i>
                                                                </span>
                                                                <label>Telefono</label>
                                                                <input type="text" class="md-input"
                                                                       name="user_edit_phone"
                                                                       value="{!! $user->phone !!}"/>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="uk-input-group">
                                                                <span class="uk-input-group-addon">
                                                                    <i class="md-list-addon-icon uk-icon-facebook-official"></i>
                                                                </span>
                                                                <label>Facebook</label>
                                                                <input type="text" class="md-input"
                                                                       name="user_edit_facebook"
                                                                       value="{!! $user->facebook !!}"/>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="uk-input-group">
                                                                <span class="uk-input-group-addon">
                                                                    <i class="md-list-addon-icon uk-icon-twitter"></i>
                                                                </span>
                                                                <label>Twitter</label>
                                                                <input type="text" class="md-input"
                                                                       name="user_edit_twitter"
                                                                       value="{!! $user->twitter !!}"/>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="uk-input-group">
                                                                <span class="uk-input-group-addon">
                                                                    <i class="md-list-addon-icon uk-icon-linkedin"></i>
                                                                </span>
                                                                <label>Linkdin</label>
                                                                <input type="text" class="md-input"
                                                                       name="user_edit_linkdin"
                                                                       value="{!! $user->linkedin !!}"/>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="uk-input-group">
                                                                <span class="uk-input-group-addon">
                                                                    <i class="md-list-addon-icon uk-icon-google-plus"></i>
                                                                </span>
                                                                <label>Google+</label>
                                                                <input type="text" class="md-input"
                                                                       name="user_edit_google_plus"
                                                                       value="{!! $user->googleplus !!}"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('scripts')
    {!! HTML::script('js/ajax/logs.js') !!}
    {!! HTML::script('js/canvasloader.js') !!}
    {!! HTML::script('js/greensock/plugins/CSSPlugin.min.js') !!}
    {!! HTML::script('js/greensock/easing/EasePack.min.js') !!}
    {!! HTML::script('js/greensock/TweenLite.min.js') !!}
    <script>
        $(document).ready(function () {


            $("#edit-info").click(function (event) {
                event.preventDefault();
//                console.log('click en el boton');
                var _token = "{!! session('_token') !!}";
                var first = getUrlVars()["user_edit_uname_control"];
//                alert(first);
                $.ajax({
                            url: '{{Route('edit.profile')}}',
                            type: 'get',
                            dataType: 'json',
                            data: {status: status, name: first ,email: "{!! Input::get('user_edit_email') !!}", _token : _token}
                        })
                        .done(function(data) {
                            console.log(data);
                        })
                        .fail(function (jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR);
                            console.log(textStatus);
                            console.log(errorThrown);
                        })
                        .always(function() {
                            console.log('success');
                        });
            });

        });

        // code generated from http://heartcode.robertpataki.com/canvasloader/
        var cl = new CanvasLoader('canvasloader-container');
        cl.setColor('#ffffff');
        cl.setDiameter(66);
        cl.setDensity(140);
        cl.setRange(0.9);
        cl.setSpeed(3);
        cl.setFPS(30);



        //animate out fb login button

        //end of canvas loader configuration
        function showLoader() {
            cl.show(); // show loader
            TweenLite.to('#fb-img', 0.4,
                    {
                        scaleX: 0,
                        scaleY: 0,
                        alpha: 0,
                        ease: Back.easeIn
                    });

            //animate in canvas loader
            TweenLite.from('#canvasloader-container', 0.4,
                    {
                        delay: 0.4,
                        scaleX: 0,
                        scaleY: 0,
                        alpha: 0,
                        ease: Power2.easeOut
                    });
        }

        function getUrlVars() {
            var vars = {};
            var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
                vars[key] = value;
            });
            return vars;
        }
    </script>
@stop
<div id="data_cont">
    <h5>Contenido</h5>

    {!! Form::open(array('id' => 'data-form')) !!}

    <div class="row">

        <!-- banner link URL -->
        <div class="row data-field data-banner_link">
            <div class="input-field col s12">
                <label for="link-input">Enlace</label>
                <input placeholder="http://misitio.com" name="link" id="link-input" type="text" class="validate">
            </div>
        </div>

        <!-- like URL page -->
        <div class="row data-field data-like">
            <div class="input-field col s12">
                <label for="like-input">Página de facebook</label>
                <input placeholder="http://mipagina.com" name="like" id="like-input" type="text" class="validate">
            </div>
        </div>

        <!-- captcha -->
        <div class="row data-field data-captcha">
            <div class="input-field col s12">
                <label for="captcha">Captcha</label>
                <input placeholder="mi producto" name="captcha" id="captcha" type="text" class="validate">
            </div>
        </div>

        <!-- mailing list: name/email -->
        <div class="row data-field data-mailing_list">
            <div class="input-field col s12 m6">
                <label for="mail_name">Remitente</label>
                <input placeholder="Nombre" name="mail_name" id="mail_name" type="text">
            </div>

            <div class="input-field col s12 m6">
                <label for="mail_address">E-mail</label>
                <input placeholder="contacto@miempresa.com" name="mail_address" id="mail_address" type="email" required>
            </div>
        </div>

        <div class="row data-field data-mailing_list">
            <div class="input-field col s12">
                <label for="mail_subject">Asunto</label>
                <input placeholder="" name="mail_subject" id="mail_subject" type="text">
            </div>
        </div>

        <div class="row data-field data-mailing_list">
            <div class="input-field col s12">
                <textarea style="height:450px" id="mailing_content" name="mailing_content"> </textarea>
            </div>
        </div>

        <!-- video -->

        <div class="row data-field data-video">
            <div class="input-field file-field btn col s6 offset-s3 cyan waves-effect waves-light">

                <span>Subir Video <i class="material-icons left">file_upload</i></span>
                <input id="video-input" name="video" type="file" accept='video/mp4'>

            </div>
        </div>

        <!-- survey image -->
        <div class="row data-field data-survey">
            <div class="input-field file-field btn col s6 offset-s3 cyan waves-effect waves-light">

                <span> <i class="material-icons left">file_upload</i> <i class="material-icons left">collections</i> (684x400)</span>
                <input id="image-survey" name="image_survey" type="file" accept='image/*'>

            </div>

            <img id="image-survey-cropped" class="responsive-img col s6 offset-s3 mBottom-20"
                 src="http://placehold.it/684x400?text=684x400" alt="">

        </div>

        <!-- video image -->
        <div class="row data-field data-video">
            <div class="input-field file-field btn col s6 offset-s3 cyan waves-effect waves-light">

                <span> <i class="material-icons left">file_upload</i> <i class="material-icons left">collections</i> (640x360)</span>
                <input id="image-video" name="image_video" type="file" accept='image/*'>

            </div>

            <img id="image-video-cropped" class="responsive-img col s6 offset-s3 mBottom-20"
                 src="http://placehold.it/640x360?text=640x360" alt="">

        </div>


        <!-- survey questions -->
        <ul class="collapsible data-field data-survey" data-collapsible="accordion">

            <!-- 1era -->
            <li>
                <div class="collapsible-header active white-text teal lighten-2"><i class="material-icons">question_answer</i>Primera pregunta</div>

                <div class="collapsible-body">
                    <div class="container">
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="question_1">Pregunta</label>
                                <input placeholder="" name="question_1" id="question_1" type="text" class="validate">
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12 m6">
                                <label for="answer_1_1">Opción 1</label>
                                <input placeholder="" name="answer_1_1" id="answer_1_1" type="text" class="validate">
                            </div>

                            <div class="input-field col s12 m6">
                                <label for="answer_1_2">Opción 2</label>
                                <input placeholder="" name="answer_1_2" id="answer_1_2" type="text" class="validate">
                            </div>

                            <div class="input-field col s12 m6">
                                <label for="answer_1_3">Opción 3</label>
                                <input placeholder="" name="answer_1_3" id="answer_1_3" type="text" class="validate">
                            </div>

                            <div class="input-field col s12 m6">
                                <label for="answer_1_4">Opción 4</label>
                                <input placeholder="" name="answer_1_4" id="answer_1_4" type="text" class="validate">
                            </div>

                        </div>

                    </div>

                </div>
            </li>

            <!-- 2da -->
            <li>
                <div class="collapsible-header white-text teal lighten-2"><i class="material-icons">question_answer</i>Segunda pregunta</div>

                <div class="collapsible-body">

                    <div class="container">

                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="" name="question_2" id="question_2" type="text" class="validate">
                                <label for="question_2">Pregunta</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input placeholder="" name="answer_2_1" id="answer_2_1" type="text" class="validate">
                                <label for="answer_2_1">Opción 1</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <input placeholder="" name="answer_2_2" id="answer_2_2" type="text" class="validate">
                                <label for="answer_2_2">Opción 2</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <input placeholder="" name="answer_2_3" id="answer_2_3" type="text" class="validate">
                                <label for="answer_2_3">Opción 3</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <input placeholder="" name="answer_2_4" id="answer_2_4" type="text" class="validate">
                                <label for="answer_2_4">Opción 4</label>
                            </div>

                        </div>
                    </div>
                </div>
            </li>

            <!-- 3era -->
            <li>
                <div class="collapsible-header white-text teal lighten-2"><i class="material-icons">question_answer</i>Tercera pregunta</div>

                <div class="collapsible-body">

                    <div class="container">

                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="" name="question_3" id="question_3" type="text" class="validate">
                                <label for="question_3">Pregunta</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input placeholder="" name="answer_3_1" id="answer_3_1" type="text" class="validate">
                                <label for="answer_3_1">Opción 1</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <input placeholder="" name="answer_3_2" id="answer_3_2" type="text" class="validate">
                                <label for="answer_3_2">Opción 2</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <input placeholder="" name="answer_3_3" id="answer_3_3" type="text" class="validate">
                                <label for="answer_3_3">Opción 3</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <input placeholder="" name="answer_3_4" id="answer_3_4" type="text" class="validate">
                                <label for="answer_3_4">Opción 4</label>
                            </div>
                        </div>

                    </div>
                </div>
            </li>

            <!-- 4ta -->
            <li>
                <div class="collapsible-header white-text teal lighten-2"><i class="material-icons">question_answer</i>Cuarta pregunta</div>

                <div class="collapsible-body">

                    <div class="container">

                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="" name="question_4" id="question_4" type="text" class="validate">
                                <label for="question_4">Pregunta</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input placeholder="" name="answer_4_1" id="answer_4_1" type="text" class="validate">
                                <label for="answer_4_1">Opción 1</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <input placeholder="" name="answer_4_2" id="answer_4_2" type="text" class="validate">
                                <label for="answer_4_2">Opción 2</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <input placeholder="" name="answer_4_3" id="answer_4_3" type="text" class="validate">
                                <label for="answer_4_3">Opción 3</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <input placeholder="" name="answer_4_4" id="answer_4_4" type="text" class="validate">
                                <label for="answer_4_4">Opción 4</label>
                            </div>
                        </div>

                    </div>
                </div>
            </li>

            <!-- 5ta -->
            <li>
                <div class="collapsible-header white-text teal lighten-2"><i class="material-icons">question_answer</i>Quinta pregunta</div>

                <div class="collapsible-body">

                    <div class="container">

                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="" name="question_5" id="question_5" type="text" class="validate">
                                <label for="question_5">Pregunta</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input placeholder="" name="answer_5_1" id="answer_5_1" type="text" class="validate">
                                <label for="answer_5_1">Opción 1</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <input placeholder="" name="answer_5_2" id="answer_5_2" type="text" class="validate">
                                <label for="answer_5_2">Opción 2</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <input placeholder="" name="answer_5_3" id="answer_5_3" type="text" class="validate">
                                <label for="answer_5_3">Opción 3</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <input placeholder="" name="answer_5_4" id="answer_5_4" type="text" class="validate">
                                <label for="answer_5_4">Opción 4</label>
                            </div>
                        </div>

                    </div>
                </div>
            </li>

        </ul>


        <div class="row data-field data-banner_link data-captcha data-like">

            <div class="col s6 offset-s3 m4 offset-m1">

                <div class="input-field file-field btn cyan waves-effect waves-light"
                     style="margin:0 -0.75em; width: calc(100% + 1.5em); padding:0;">
                    <span>Banner (600x602)</span>
                    <input id="image-small" name="image_small" type="file" accept='image/*'>

                </div>
                <img id="image-small-cropped" class="responsive-img" src="http://placehold.it/600x602?text=600x602"
                     alt="">
            </div>


            <div class="col s6 offset-s3 m4 offset-m2">

                <div class="input-field file-field btn cyan waves-effect waves-light"
                     style="margin:0 -0.75em; width: calc(100% + 1.5em); padding:0;">

                    <span>Banner (684x864)</span>
                    <input id="image-large" name="image_large" type="file" accept='image/*'>


                </div>

                <img id="image-large-cropped" class="responsive-img" src="http://placehold.it/600x864?text=684x864"
                     alt="">

            </div>


        </div>


    </div>

    {!! Form::close() !!}


</div>

<!-- Modal image preview -->
<div id="modal-image" class="modal modal-fixed-footer">
    <div class="modal-content">
        <p>Recorta la imágen</p>
        <div id="image-cropper">
            <img src="" alt="">
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" id="crop-btn" class="modal-action waves-effect waves-green btn-flat ">Cortar</a>
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
    </div>
</div>

<!-- Modal uploading image -->
<div id="modal-loader" class="modal">
    <div class="modal-content">

        <p class="center-align">Espera un momento...</p>

        <div class="preloader-wrapper small active centered-loader">
            <div class="spinner-layer spinner-green-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>

    </div>
</div>
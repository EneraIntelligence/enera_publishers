<!-- first section -->
<h3>Elementos</h3>
<section>
    <h2 class="heading_a">
        Datos de interacción
    </h2>
    <hr class="md-hr"/>

    <div class="uk-width-medium-1-1 uk-small-width-1-1 step2-field video">

        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <div id="file_upload-drop" class="uk-file-upload parsley-row">
            <p class="uk-text">Video</p>
            <a class="uk-form-file md-btn">elige un archivo
                <input id="video" name="video" type="file" required accept='video/*'>
            </a>

        </div>
    </div>


    <div class="uk-grid step2-field banner-link">
        <div class="uk-width-medium-1-1 parsley-row">
            <label for="banner_link">Link<span class="req">*</span> - incluyendo http:// ó https://</label>
            <input type="text" name="banner_link" id="banner_link" data-parsley-url="true" required class="md-input" />
        </div>
    </div>

    <div class="uk-grid step2-field captcha">
        <div class="uk-width-medium-1-1 parsley-row">
            <label for="captcha">Captcha<span class="req">*</span></label>
            <input type="text" name="captcha" id="captcha" required class="md-input" />
        </div>
    </div>

    <!-- mailing list wysiwyg -->
    <div class="uk-grid step2-field mailing-list">



        <div class="uk-width-medium-1-3">
            <div class="uk-form-row">
                <div class="md-input-wrapper">
                    <label>Nombre del remitente</label>
                    <input type="text" name="from" required class="md-input">
                            <span class="md-input-bar">
                            </span>
                </div>

            </div>
        </div>

        <div class="uk-width-medium-1-3">
            <div class="uk-form-row">

                <div class="md-input-wrapper">
                    <label>E-mail del remitente</label>
                    <input type="email" name="from_mail" required class="md-input">
                            <span class="md-input-bar">

                            </span>
                </div>
            </div>
        </div>

        <div class="uk-width-medium-1-3">
            <div class="uk-form-row">

                <div class="md-input-wrapper">
                    <label>Asunto</label>
                    <input type="text" name="subject" required class="md-input">
                            <span class="md-input-bar">
                            </span>
                </div>
            </div>
        </div>



        <div class="uk-width-medium-1-1">

            <br>
            <br>
            <label>Correo de suscripción</label>
            <br>
            <br>

            <textarea name="mailing_content" id="wysiwyg_editor" cols="30" rows="20"
                      data-parsley-trigger="keyup" data-parsley-minlength="20"
                      data-parsley-minlength-message="Tu correo debe incluir al menos 20 caracteres"
                      data-parsley-validate-if-empty
                      required="required">

            </textarea>

        </div>


    </div>

    <div class="uk-block step2-field survey questionContainer">

        <!-- q1 -->
        <div class="uk-grid question">
            <div class="uk-grid uk-width-medium-1-1">
                <div class="uk-width-medium-1-1 parsley-row">
                    <label for="survey_q1">Pregunta 1<span class="req">*</span></label>
                    <input type="text" name="survey_q1" id="survey_q1" required class="md-input" />
                </div>
            </div>

            <div class="uk-grid uk-width-medium-1-1">

                <div class="uk-width-medium-1-4 parsley-row">
                    <label for="survey_q1_a1">Opción 1<span class="req">*</span></label>
                    <input type="text" name="survey_q1_a1" id="survey_q1_a1" required class="md-input" />
                </div>

                <div class="uk-width-medium-1-4 parsley-row">
                    <label for="survey_q1_a2">Opción 2<span class="req">*</span></label>
                    <input type="text" name="survey_q1_a2" id="survey_q1_a2" required class="md-input" />
                </div>

                <div class="uk-width-medium-1-4 parsley-row">
                    <label for="survey_q1_a3">Opción 3</label>
                    <input type="text" name="survey_q1_a3" id="survey_q1_a3" class="md-input" />
                </div>

                <div class="uk-width-medium-1-4 parsley-row">
                    <label for="survey_q1_a4">Opción 4</label>
                    <input type="text" name="survey_q1_a4" id="survey_q1_a4" class="md-input" />
                </div>

            </div>
        </div>

        <!-- q2 -->
        <div class="uk-grid question">
            <div class="uk-grid uk-width-medium-1-1">
                <div class="uk-width-medium-1-1 parsley-row">
                    <label for="survey_q2">Pregunta 2<span class="req">*</span></label>
                    <input type="text" name="survey_q2" id="survey_q2" required class="md-input" />
                </div>
            </div>

            <div class="uk-grid uk-width-medium-1-1">

                <div class="uk-width-medium-1-4 parsley-row">
                    <label for="survey_q2_a1">Opción 1<span class="req">*</span></label>
                    <input type="text" name="survey_q2_a1" id="survey_q2_a1" required class="md-input" />
                </div>

                <div class="uk-width-medium-1-4 parsley-row">
                    <label for="survey_q2_a2">Opción 2<span class="req">*</span></label>
                    <input type="text" name="survey_q2_a2" id="survey_q2_a2" required class="md-input" />
                </div>

                <div class="uk-width-medium-1-4 parsley-row">
                    <label for="survey_q2_a3">Opción 3</label>
                    <input type="text" name="survey_q2_a3" id="survey_q2_a3" class="md-input" />
                </div>

                <div class="uk-width-medium-1-4 parsley-row">
                    <label for="survey_q2_a4">Opción 4</label>
                    <input type="text" name="survey_q2_a4" id="survey_q2_a4" class="md-input" />
                </div>

            </div>
        </div>

        <!-- q3 -->
        <div class="uk-grid question">
            <div class="uk-grid uk-width-medium-1-1">
                <div class="uk-width-medium-1-1 parsley-row">
                    <label for="survey_q3">Pregunta 3<span class="req">*</span></label>
                    <input type="text" name="survey_q3" id="survey_q3" required class="md-input" />
                </div>
            </div>

            <div class="uk-grid uk-width-medium-1-1">

                <div class="uk-width-medium-1-4 parsley-row">
                    <label for="survey_q3_a1">Opción 1<span class="req">*</span></label>
                    <input type="text" name="survey_q3_a1" id="survey_q3_a1" required class="md-input" />
                </div>

                <div class="uk-width-medium-1-4 parsley-row">
                    <label for="survey_q3_a2">Opción 2<span class="req">*</span></label>
                    <input type="text" name="survey_q3_a2" id="survey_q3_a2" required class="md-input" />
                </div>

                <div class="uk-width-medium-1-4 parsley-row">
                    <label for="survey_q3_a3">Opción 3</label>
                    <input type="text" name="survey_q3_a3" id="survey_q3_a3" class="md-input" />
                </div>

                <div class="uk-width-medium-1-4 parsley-row">
                    <label for="survey_q3_a4">Opción 4</label>
                    <input type="text" name="survey_q3_a4" id="survey_q3_a4" class="md-input" />
                </div>

            </div>
        </div>

        <!-- q4 -->
        <div class="uk-grid question">
            <div class="uk-grid uk-width-medium-1-1">
                <div class="uk-width-medium-1-1 parsley-row">
                    <label for="survey_q4">Pregunta 4<span class="req">*</span></label>
                    <input type="text" name="survey_q4" id="survey_q4" required class="md-input" />
                </div>
            </div>

            <div class="uk-grid uk-width-medium-1-1">

                <div class="uk-width-medium-1-4 parsley-row">
                    <label for="survey_q4_a1">Opción 1<span class="req">*</span></label>
                    <input type="text" name="survey_q4_a1" id="survey_q4_a1" required class="md-input" />
                </div>

                <div class="uk-width-medium-1-4 parsley-row">
                    <label for="survey_q4_a2">Opción 2<span class="req">*</span></label>
                    <input type="text" name="survey_q4_a2" id="survey_q4_a2" required class="md-input" />
                </div>

                <div class="uk-width-medium-1-4 parsley-row">
                    <label for="survey_q4_a3">Opción 3</label>
                    <input type="text" name="survey_q4_a3" id="survey_q4_a3" class="md-input" />
                </div>

                <div class="uk-width-medium-1-4 parsley-row">
                    <label for="survey_q4_a4">Opción 4</label>
                    <input type="text" name="survey_q4_a4" id="survey_q4_a4" class="md-input" />
                </div>

            </div>
        </div>

        <!-- q5 -->
        <div class="uk-grid question">
            <div class="uk-grid uk-width-medium-1-1">
                <div class="uk-width-medium-1-1 parsley-row">
                    <label for="survey_q5">Pregunta 5<span class="req">*</span></label>
                    <input type="text" name="survey_q5" id="survey_q5" required class="md-input" />
                </div>
            </div>

            <div class="uk-grid uk-width-medium-1-1">

                <div class="uk-width-medium-1-4 parsley-row">
                    <label for="survey_q5_a1">Opción 1<span class="req">*</span></label>
                    <input type="text" name="survey_q5_a1" id="survey_q5_a1" required class="md-input" />
                </div>

                <div class="uk-width-medium-1-4 parsley-row">
                    <label for="survey_q5_a2">Opción 2<span class="req">*</span></label>
                    <input type="text" name="survey_q5_a2" id="survey_q5_a2" required class="md-input" />
                </div>

                <div class="uk-width-medium-1-4 parsley-row">
                    <label for="survey_q5_a3">Opción 3</label>
                    <input type="text" name="survey_q5_a3" id="survey_q5_a3" class="md-input" />
                </div>

                <div class="uk-width-medium-1-4 parsley-row">
                    <label for="survey_q5_a4">Opción 4</label>
                    <input type="text" name="survey_q5_a4" id="survey_q5_a4" class="md-input" />
                </div>

            </div>
        </div>

    </div>

    <div class="uk-block step2-field survey">

        <div class="md-btn md-btn-danger uk-float-left disabled" id="remove_question">Quitar pregunta</div>
        <div class="md-btn md-btn-success uk-float-right" id="add_question">Añadir pregunta</div>

    </div>

    <hr class="md-hr"/>

    <h2 class="heading_a">
        Imágenes
    </h2>

    <div class="uk-grid">

        <div class="uk-width-medium-1-1 uk-small-width-1-1 step2-field survey">
            <img style="max-height:200px" class="uk-align-center banner-survey" src="http://placehold.it/684x400?text=684x400" alt="">
            <div class="parsley-errors-list filled banner-survey-errors"></div>

            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <div id="file_upload-drop" class="uk-file-upload parsley-row">
                <p class="uk-text">Banner encuesta</p>
                <a class="uk-form-file md-btn">elige un archivo
                    <input id="banner-survey" name="image_survey" type="file" required accept='image/*'>
                </a>

            </div>
        </div>


        <div class="uk-width-medium-1-2 uk-small-width-1-1 step2-field banner banner-link captcha mailing-list video">
            <img style="max-height:200px" id="image-crop" class="uk-align-center banner-1" src="http://placehold.it/600x602?text=600x602" alt="">

            <div class="parsley-errors-list filled banner-1-errors"></div>

            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <div id="file_upload-drop" class="uk-file-upload parsley-row">
                <p class="uk-text">Banner dispositivos pequeños</p>
                <a class="uk-form-file md-btn">elige un archivo
                    <input id="banner-1" name="image_small" type="file" required accept='image/*'>
                </a>

            </div>
        </div>



        <div class="uk-width-medium-1-2 uk-small-width-1-1 step2-field  banner banner-link captcha mailing-list video">

            <img style="max-height:200px" class="uk-align-center banner-2" src="http://placehold.it/684x864?text=684x864" alt="">
            <div class="parsley-errors-list filled banner-2-errors"></div>

            <div id="file_upload-drop2" class="uk-file-upload parsley-row">
                <p class="uk-text">Banner dispositivos altos</p>
                <a class="uk-form-file md-btn">elige un archivo
                    <input id="banner-2" name="image_large" type="file" required accept='image/*'>
                </a>
            </div>


            {{--<p class="uk-text-center md-input-danger">El tamaño de la imagen no coincide</p>--}}

        </div>


    </div>


</section>
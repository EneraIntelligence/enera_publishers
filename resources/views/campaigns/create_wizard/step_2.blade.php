<!-- first section -->
<h3>Detalles de la interacción</h3>
<section>
    <h2 class="heading_a">
        Datos de interacción
    </h2>
    <hr class="md-hr"/>

    <div class="uk-grid step2-field banner-link">
        <div class="uk-width-medium-1-1 parsley-row">
            <label for="wizard_fullname">Link<span class="req">*</span></label>
            <input type="text" name="wizard_link" id="wizard_link" required class="md-input" />
        </div>
    </div>

    <div class="uk-grid step2-field captcha">
        <div class="uk-width-medium-1-1 parsley-row">
            <label for="wizard_fullname">Captcha<span class="req">*</span></label>
            <input type="text" name="wizard_captcha" id="wizard_captcha" required class="md-input" />
        </div>
    </div>

    <div class="uk-grid step2-field survey">
        <div class="uk-width-medium-1-1 parsley-row">
            <label for="wizard_fullname">Pregunta 1<span class="req">*</span></label>
            <input type="text" name="wizard_q1" id="wizard_q1" required class="md-input" />
        </div>
    </div>

    <div class="uk-grid step2-field survey">

        <div class="uk-width-medium-1-4 parsley-row">
            <label for="wizard_fullname">Respuesta 1<span class="req">*</span></label>
            <input type="text" name="wizard_q1_a1" id="wizard_q2_a1" required class="md-input" />
        </div>

        <div class="uk-width-medium-1-4 parsley-row">
            <label for="wizard_fullname">Respuesta 2<span class="req">*</span></label>
            <input type="text" name="wizard_q1_a2" id="wizard_q2_a2" required class="md-input" />
        </div>

        <div class="uk-width-medium-1-4 parsley-row">
            <label for="wizard_fullname">Respuesta 3</label>
            <input type="text" name="wizard_q1_a3" id="wizard_q2_a3" class="md-input" />
        </div>

        <div class="uk-width-medium-1-4 parsley-row">
            <label for="wizard_fullname">Respuesta 4</label>
            <input type="text" name="wizard_q1_a4" id="wizard_q2_a4" class="md-input" />
        </div>

    </div>

    <div class="uk-grid">

        <div class="uk-width-1-2">
            <img style="max-height:200px" class="uk-align-center banner-1" src="http://placehold.it/600x602?text=600x602" alt="">

            <div id="file_upload-drop" class="uk-file-upload parsley-row">
                <p class="uk-text">Banner dispositivos pequeños</p>
                <a class="uk-form-file md-btn">elige un archivo
                    <input id="file_upload-select" type="file" required accept='image/*'>
                </a>
                <div class="parsley-errors-list filled banner-1-errors">

                </div>
            </div>
        </div>


        <div class="uk-width-1-2">

            <img style="max-height:200px" class="uk-align-center banner-2" src="http://placehold.it/684x864?text=684x864" alt="">

            <div id="file_upload-drop2" class="uk-file-upload parsley-row">
                <p class="uk-text">Banner dispositivos altos</p>
                <a class="uk-form-file md-btn">elige un archivo
                    <input class="" id="file_upload-select_2" type="file" required accept='image/*'>
                </a>
                <div class="parsley-errors-list filled banner-2-errors">

                </div>
            </div>


            {{--<p class="uk-text-center md-input-danger">El tamaño de la imagen no coincide</p>--}}

        </div>


    </div>

</section>
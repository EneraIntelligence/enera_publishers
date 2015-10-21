<!-- second section -->
<h3>Alcance de la campaña</h3>
<section>

    <h2 class="heading_a">
        Duración
    </h2>


    <div class="uk-grid">
        <div class="uk-width-medium-1-2">
            <div class="uk-input-group">
                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                <label for="uk_dp_1">Fecha de inicio</label>
                <input class="md-input" type="text" id="uk_dp_1" data-uk-datepicker="{format:'DD.MM.YYYY'}">
            </div>
        </div>

        <div class="uk-width-medium-1-2">
            <div class="uk-input-group">
                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                <label for="uk_dp_1">Fecha final</label>
                <input class="md-input" type="text" id="uk_dp_1" data-uk-datepicker="{format:'DD.MM.YYYY'}">
            </div>
        </div>
    </div>
    <hr class="md-hr"/>

    <h2 class="heading_a">
        Segmentación
    </h2>

    <div class="uk-grid">

        <div class="uk-width-medium-1-10">
        </div>

        <div class="uk-width-medium-3-10">
            <input type="text" id="age_slider" name="age_slider"
                   data-ion-slider
                   data-min="0" data-max="100"
                   data-from="13" data-to="60"
                   data-from-min="13"
                   data-type="int" data-grid="true" data-postfix=" años"/>
        </div>

        <div class="uk-width-medium-2-10">
        </div>


        <div class="uk-width-medium-3-10">
            <input type="text" id="gender_slider" name="gender_slider"
                   data-ion-slider
                   data-min="0" data-max="2"
                   data-values="mujeres, -, hombres"
                   data-type="int" data-grid="true"
                   data-from-max="1" data-to-min="1"
                   data-step='1' data-force_edges="true"/>
        </div>

        <div class="uk-width-medium-1-10">
        </div>

    </div>

    <div class="uk-grid">

        <div class="uk-width-1-1">
            <div style="margin: 0 auto; width:677px;">
                <span class="icheck-inline">
                    <input class="wizard-icheck" type="checkbox" name="checkbox_demo_inline" id="checkbox_demo_inline_1"/>
                    <label for="checkbox_demo_inline_1" class="inline-label">Lunes</label>
                </span>
                <span class="icheck-inline">
                    <input class="wizard-icheck" type="checkbox" name="checkbox_demo_inline" id="checkbox_demo_inline_2"/>
                    <label for="checkbox_demo_inline_2" class="inline-label">Martes</label>
                </span>
                <span class="icheck-inline">
                    <input class="wizard-icheck" type="checkbox" name="checkbox_demo_inline" id="checkbox_demo_inline_3"/>
                    <label for="checkbox_demo_inline_3" class="inline-label">Miercoles</label>
                </span>
                <span class="icheck-inline">
                    <input class="wizard-icheck" type="checkbox" name="checkbox_demo_inline" id="checkbox_demo_inline_4"/>
                    <label for="checkbox_demo_inline_4" class="inline-label">Jueves</label>
                </span>
                <span class="icheck-inline">
                    <input class="wizard-icheck" type="checkbox" name="checkbox_demo_inline" id="checkbox_demo_inline_5"/>
                    <label for="checkbox_demo_inline_5" class="inline-label">Viernes</label>
                </span>
                <span class="icheck-inline">
                    <input class="wizard-icheck" type="checkbox" name="checkbox_demo_inline" id="checkbox_demo_inline_6"/>
                    <label for="checkbox_demo_inline_6" class="inline-label">Sábado</label>
                </span>
                <span class="icheck-inline">
                    <input class="wizard-icheck" type="checkbox" name="checkbox_demo_inline" id="checkbox_demo_inline_7"/>
                    <label for="checkbox_demo_inline_7" class="inline-label">Domingo</label>
                </span>
            </div>


        </div>


    </div>

    <div class="uk-grid">
        <div class="uk-width-1-1">
            horas del dia
            <div class="uk-width-1-4">
                <div class="uk-width-1-6"></div>
                <div class="uk-width-1-6"></div>
                <div class="uk-width-1-6"></div>
                <div class="uk-width-1-6"></div>
                <div class="uk-width-1-6"></div>
                <div class="uk-width-1-6"></div>
            </div>
            <div class="uk-width-1-4">
                <div class="uk-width-1-6"></div>
                <div class="uk-width-1-6"></div>
                <div class="uk-width-1-6"></div>
                <div class="uk-width-1-6"></div>
                <div class="uk-width-1-6"></div>
                <div class="uk-width-1-6"></div>
            </div>
            <div class="uk-width-1-4">
                <div class="uk-width-1-6"></div>
                <div class="uk-width-1-6"></div>
                <div class="uk-width-1-6"></div>
                <div class="uk-width-1-6"></div>
                <div class="uk-width-1-6"></div>
                <div class="uk-width-1-6"></div>
            </div>
            <div class="uk-width-1-4">
                <div class="uk-width-1-6"></div>
                <div class="uk-width-1-6"></div>
                <div class="uk-width-1-6"></div>
                <div class="uk-width-1-6"></div>
                <div class="uk-width-1-6"></div>
                <div class="uk-width-1-6"></div>
            </div>
        </div>
    </div>


    <div class="uk-grid">
        <div class="uk-width-1-3">
            <label class="uk-form-label">Restricciones por persona</label>
            <span class="icheck">
                <input type="radio" name="wizard_status" id="wizard_status_repeat" checked class="wizard-icheck" value="repeat" />
                <label for="wizard_status_repeat" class="inline-label">Mostrar sin restricciones</label>
            </span>
            <div class="clearfix"></div>
            <span class="icheck">
                <input type="radio" name="wizard_status" id="wizard_status_unique_day" class="wizard-icheck" value="unique_day" />
                <label for="wizard_status_unique_day" class="inline-label">Mostrar sólo una vez al día</label>
            </span>
            <div class="clearfix"></div>
            <span class="icheck">
                <input type="radio" name="wizard_status" id="wizard_status_unique" class="wizard-icheck" value="unique" />
                <label for="wizard_status_unique" class="inline-label">Mostrar sólo una vez por persona</label>
            </span>
        </div>

        <div class="uk-width-2-3">
            google maps
        </div>
    </div>

</section>
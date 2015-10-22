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

        <div class="uk-width-medium-3-10  uk-width-small-1-1">

            <label class="uk-form-label">Género</label>
            <span class="icheck">
                <input type="radio" name="wizard_gender" id="wizard_gender_men" class="wizard-icheck" value="men" />
                <label for="wizard_gender_men" class="inline-label">Hombres </label>
            </span>
            <div class="clearfix"></div>
            <span class="icheck">
                <input type="radio" name="wizard_gender" id="wizard_gender_women" class="wizard-icheck" value="women" />
                <label for="wizard_gender_women" class="inline-label">Mujeres</label>
            </span>
            <div class="clearfix"></div>
            <span class="icheck">
                <input type="radio" name="wizard_gender" id="wizard_gender_both" checked class="wizard-icheck" value="both" />
                <label for="wizard_gender_both" class="inline-label">Ambos</label>
            </span>

        </div>

        <div class="uk-width-medium-3-10 uk-width-small-1-1">
            <label class="uk-form-label">Restricciones por persona</label>
            <span class="icheck">
                <input type="radio" name="wizard_status" id="wizard_status_repeat" checked class="wizard-icheck" value="repeat" />
                <label for="wizard_status_repeat" class="inline-label">Mostrar sin restricciones</label>
            </span>
            <div class="clearfix"></div>
            <span class="icheck">
                <input type="radio" name="wizard_status" id="wizard_status_unique_day" class="wizard-icheck" value="unique_day" />
                <label for="wizard_status_unique_day" class="inline-label">Mostrar una vez al día</label>
            </span>
            <div class="clearfix"></div>
            <span class="icheck">
                <input type="radio" name="wizard_status" id="wizard_status_unique" class="wizard-icheck" value="unique" />
                <label for="wizard_status_unique" class="inline-label">Mostrar sólo una vez por persona</label>
            </span>
        </div>

        <div class="uk-width-medium-3-10 uk-width-small-1-1">
            <input type="text" id="age_slider" name="age_slider"
                   data-ion-slider
                   data-min="0" data-max="100"
                   data-from="13" data-to="60"
                   data-from-min="13"
                   data-type="int" data-grid="true" data-postfix=" años"/>
        </div>

    </div>

    <h2 class="heading_a">
        Horarios
    </h2>

    <div class="uk-grid">
        <div class="uk-width-1-1">
            <div class="uk-grid">

                <div class="uk-width-medium-1-1">
                    <input type="text" id="time_1_slider" name="time_1_slider"/>
                </div>

                <div class="uk-width-medium-1-1">
                    <input type="text" id="time_2_slider" name="time_2_slider"
                           data-ion-slider
                           data-min="0" data-max="24"
                           data-type="int" data-grid="true"
                           data-from-min="24" data-to-max="24"
                           data-from="24" data-to="24"
                           data-postfix=":00"
                           data-step='1' data-force_edges="true"/>
                </div>
            </div>

            <div class="uk-grid uk-grid-collapse" id="input-hours">

                {{--<div class="uk-width-1-4">--}}
                    {{--<div class="uk-grid">--}}
                        {{--<div class="uk-width-1-6">0am</div>--}}
                        {{--<div class="uk-width-1-6">1am</div>--}}
                        {{--<div class="uk-width-1-6">2am</div>--}}
                        {{--<div class="uk-width-1-6">3am</div>--}}
                        {{--<div class="uk-width-1-6">4am</div>--}}
                        {{--<div class="uk-width-1-6">5am</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="uk-width-1-4">--}}
                    {{--<div class="uk-grid">--}}
                        {{--<div class="uk-width-1-6">6am</div>--}}
                        {{--<div class="uk-width-1-6">7am</div>--}}
                        {{--<div class="uk-width-1-6">8am</div>--}}
                        {{--<div class="uk-width-1-6">9am</div>--}}
                        {{--<div class="uk-width-1-6">10am</div>--}}
                        {{--<div class="uk-width-1-6">11am</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="uk-width-1-4">--}}
                    {{--<div class="uk-grid">--}}
                        {{--<div class="uk-width-1-6">12pm</div>--}}
                        {{--<div class="uk-width-1-6">1pm</div>--}}
                        {{--<div class="uk-width-1-6">2pm</div>--}}
                        {{--<div class="uk-width-1-6">3pm</div>--}}
                        {{--<div class="uk-width-1-6">4pm</div>--}}
                        {{--<div class="uk-width-1-6">5pm</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="uk-width-1-4">--}}
                    {{--<div class="uk-grid">--}}
                        {{--<div class="uk-width-1-6">6pm</div>--}}
                        {{--<div class="uk-width-1-6">7pm</div>--}}
                        {{--<div class="uk-width-1-6">8pm</div>--}}
                        {{--<div class="uk-width-1-6">9pm</div>--}}
                        {{--<div class="uk-width-1-6">10pm</div>--}}
                        {{--<div class="uk-width-1-6">11pm</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

            </div>
        </div>
    </div>

    <div class="uk-grid uk-grid-collapse">

        <div class="uk-width-1-1">

            <div class="uk-grid uk-grid-collapse">

                <div class="uk-width-1-1">

                    <div class="uk-grid uk-grid-collapse">

                        <div class="uk-width-medium-1-5 uk-width-small-1-2">
                            <span class="icheck-inline">
                                <input class="wizard-icheck" type="checkbox" name="checkbox_demo_inline" checked id="checkbox_demo_inline_1"/>
                                <label for="checkbox_demo_inline_1" class="inline-label">Lunes</label>
                            </span>
                        </div>

                        <div class="uk-width-medium-1-5 uk-width-small-1-2">
                            <span class="icheck-inline">
                                <input class="wizard-icheck" type="checkbox" name="checkbox_demo_inline" checked id="checkbox_demo_inline_2"/>
                                <label for="checkbox_demo_inline_2" class="inline-label">Martes</label>
                            </span>
                        </div>

                        <div class="uk-width-medium-1-5 uk-width-small-1-2">
                            <span class="icheck-inline">
                                <input class="wizard-icheck" type="checkbox" name="checkbox_demo_inline" checked id="checkbox_demo_inline_3"/>
                                <label for="checkbox_demo_inline_3" class="inline-label">Miercoles</label>
                            </span>
                        </div>

                        <div class="uk-width-medium-1-5 uk-width-small-1-2">
                            <span class="icheck-inline">
                                <input class="wizard-icheck" type="checkbox" name="checkbox_demo_inline" checked id="checkbox_demo_inline_4"/>
                                <label for="checkbox_demo_inline_4" class="inline-label">Jueves</label>
                            </span>
                        </div>

                        <div class="uk-width-medium-1-5 uk-width-small-1-2">
                            <span class="icheck-inline">
                                <input class="wizard-icheck" type="checkbox" name="checkbox_demo_inline" checked id="checkbox_demo_inline_5"/>
                                <label for="checkbox_demo_inline_5" class="inline-label">Viernes</label>
                            </span>
                        </div>

                    </div>

                </div>

                <div class="uk-width-1-1">

                    <div class="uk-grid uk-grid-collapse">

                        <div class="uk-width-medium-1-5 uk-width-small-1-2">
                            <span class="icheck-inline">
                                <input class="wizard-icheck" type="checkbox" name="checkbox_demo_inline" checked id="checkbox_demo_inline_6"/>
                                <label for="checkbox_demo_inline_6" class="inline-label">Sábado</label>
                            </span>
                        </div>

                        <div class="uk-width-medium-1-5 uk-width-small-1-2">
                            <span class="icheck-inline">
                                <input class="wizard-icheck" type="checkbox" name="checkbox_demo_inline" checked id="checkbox_demo_inline_7"/>
                                <label for="checkbox_demo_inline_7" class="inline-label">Domingo</label>
                            </span>
                        </div>

                    </div>


                </div>


            </div>

        </div>


    </div>

    <div class="uk-grid">


        <div class="uk-width-2-3">
            google maps
        </div>
    </div>

</section>
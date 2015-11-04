<!-- second section -->
<h3>Segmentación</h3>
<section>

    <h2 class="heading_a">
        Duración
    </h2>

    <?php
        $minDate = date("d.m.Y",mktime(0, 0, 0, date("m")  , date("d")+3, date("Y")));
        $lang = "{ months: ['Enero','Febrero', 'Marzo', 'Abril', 'Mayo',
                'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                weekdays:['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'] }";

    ?>

    <div class="uk-grid">
        <div class="uk-width-medium-1-2">
            <div class="uk-input-group">
                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                <label for="start_date">Fecha de inicio</label>
                <input class="md-input" type="text" name="start_date" id="start_date" required data-uk-datepicker="{format:'DD.MM.YYYY', i18n:{!! $lang !!}, weekstart:0,  minDate: '{!! $minDate !!}' }">
            </div>
        </div>

        <div class="uk-width-medium-1-2">
            <div class="uk-input-group">
                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                <label for="end_date">Fecha final</label>
                <input class="md-input" type="text" name="end_date" id="end_date" required data-uk-datepicker="{format:'DD.MM.YYYY', i18n:{!! $lang !!}, weekstart:0, minDate: '{!! $minDate !!}' }">
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
                <input type="radio" name="gender" id="wizard_gender_men" class="wizard-icheck" value="men" />
                <label for="wizard_gender_men" class="inline-label">Hombres </label>
            </span>
            <div class="clearfix"></div>
            <span class="icheck">
                <input type="radio" name="gender" id="wizard_gender_women" class="wizard-icheck" value="women" />
                <label for="wizard_gender_women" class="inline-label">Mujeres</label>
            </span>
            <div class="clearfix"></div>
            <span class="icheck">
                <input type="radio" name="gender" id="wizard_gender_both" checked class="wizard-icheck" value="both" />
                <label for="wizard_gender_both" class="inline-label">Ambos</label>
            </span>

        </div>

        <div class="uk-width-medium-3-10 uk-width-small-1-1">
            <label class="uk-form-label">Restricciones por persona</label>
            <span class="icheck">
                <input type="radio" name="unique" id="wizard_status_repeat" checked class="wizard-icheck" value="repeat" />
                <label for="wizard_status_repeat" class="inline-label">Mostrar sin restricciones</label>
            </span>
            <div class="clearfix"></div>
            <span class="icheck">
                <input type="radio" name="unique" id="wizard_status_unique_day" class="wizard-icheck" value="unique_day" />
                <label for="wizard_status_unique_day" class="inline-label">Mostrar una vez al día</label>
            </span>
            <div class="clearfix"></div>
            <span class="icheck">
                <input type="radio" name="unique" id="wizard_status_unique" class="wizard-icheck" value="unique" />
                <label for="wizard_status_unique" class="inline-label">Mostrar sólo una vez por persona</label>
            </span>
        </div>

        <div class="uk-width-medium-3-10 uk-width-small-1-1">
            <input type="text" id="age_slider" name="age"
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
                    <input type="text" id="time_1_slider" name="time_1"/>
                </div>

                <div class="uk-width-medium-1-1">
                    <input type="text" id="time_2_slider" name="time_2"
                           data-ion-slider
                           data-min="0" data-max="24"
                           data-type="int" data-grid="true"
                           data-from-min="24" data-to-max="24"
                           data-from="24" data-to="24"
                           data-postfix=":00"
                           data-step='1' data-force_edges="true"/>
                </div>
            </div>


        </div>
    </div>

    <div class="uk-grid uk-grid-collapse">

        <div class="uk-width-1-1">

            <div class="uk-grid uk-grid-collapse parsley-row">

                <div class="uk-width-1-1">

                    <div class="uk-grid uk-grid-collapse">

                        <div class="uk-width-medium-1-5 uk-width-small-1-2">
                            <span class="icheck-inline">
                                <input data-parsley-mincheck="1" required="" class="wizard-icheck" type="checkbox" name="days" value="monday" checked id="checkbox_demo_inline_1"/>
                                <label for="checkbox_demo_inline_1" class="inline-label">Lunes</label>
                            </span>
                        </div>

                        <div class="uk-width-medium-1-5 uk-width-small-1-2">
                            <span class="icheck-inline">
                                <input class="wizard-icheck" type="checkbox" name="days" value="tuesday" checked id="checkbox_demo_inline_2"/>
                                <label for="checkbox_demo_inline_2" class="inline-label">Martes</label>
                            </span>
                        </div>

                        <div class="uk-width-medium-1-5 uk-width-small-1-2">
                            <span class="icheck-inline">
                                <input class="wizard-icheck" type="checkbox" name="days" value="wednesday" checked id="checkbox_demo_inline_3"/>
                                <label for="checkbox_demo_inline_3" class="inline-label">Miercoles</label>
                            </span>
                        </div>

                        <div class="uk-width-medium-1-5 uk-width-small-1-2">
                            <span class="icheck-inline">
                                <input class="wizard-icheck" type="checkbox" name="days" value="thursday" checked id="checkbox_demo_inline_4"/>
                                <label for="checkbox_demo_inline_4" class="inline-label">Jueves</label>
                            </span>
                        </div>

                        <div class="uk-width-medium-1-5 uk-width-small-1-2">
                            <span class="icheck-inline">
                                <input class="wizard-icheck" type="checkbox" name="days" value="friday" checked id="checkbox_demo_inline_5"/>
                                <label for="checkbox_demo_inline_5" class="inline-label">Viernes</label>
                            </span>
                        </div>

                    </div>

                </div>

                <div class="uk-width-1-1">

                    <div class="uk-grid uk-grid-collapse">

                        <div class="uk-width-medium-1-5 uk-width-small-1-2">
                            <span class="icheck-inline">
                                <input class="wizard-icheck" type="checkbox" name="days" value="saturday" checked id="checkbox_demo_inline_6"/>
                                <label for="checkbox_demo_inline_6" class="inline-label">Sábado</label>
                            </span>
                        </div>

                        <div class="uk-width-medium-1-5 uk-width-small-1-2">
                            <span class="icheck-inline">
                                <input class="wizard-icheck" type="checkbox" name="days" value="sunday" checked id="checkbox_demo_inline_7"/>
                                <label for="checkbox_demo_inline_7" class="inline-label">Domingo</label>
                            </span>
                        </div>

                    </div>


                </div>


            </div>

        </div>


    </div>

    <h2 class="heading_a">
        Ubicaciones
    </h2>



    <div class="uk-grid">
        <div class="uk-width-1-2 uk-text-center">
            {{--<label class="uk-form-label">Ubicación</label>--}}

            <span class="icheck">
                <input onchange="branchMap.closeMap()" checked type="radio" name="ubication" id="wizard_location_all" class="wizard-icheck" value="all" />
                <label for="wizard_location_all" class="inline-label">Global</label>
            </span>

        </div>
        <div class="uk-width-1-2 uk-text-center">

            <span class="icheck">
                <input type="radio" name="ubication" id="wizard_location_select" class="wizard-icheck" value="select" />
                <label for="wizard_location_select" class="inline-label">Seleccionar ubicaciones</label>
            </span>

        </div>
    </div>

    <div class="uk-grid branchMap">
        <div class="uk-width-medium-1-3 uk-width-small-1-1">
            <div class="uk-grid uk-grid-collapse">

                <div class="uk-width-1-1 uk-text-truncate">

                    <img style="width:10%;" src="{!! URL::asset('images/enera_map_marker_on.png') !!}" alt="">
                    <label>Mostrar en esta ubicación</label>


                </div>
                <hr class="uk-grid-divider">

                <div class="uk-width-1-1 uk-text-truncate">
                    <img style="width:10%;" src="{!! URL::asset('images/enera_map_marker_off.png') !!}" alt="">
                    <label>No mostrar en esta ubicación</label>
                </div>

                <hr class="uk-grid-divider">

                <hr class="uk-grid-divider">

                <div class="uk-width-1-1">
                    <div style="width:100%;" class="md-btn md-btn-success" id="select_markers">Seleccionar todo</div>
                </div>

                <hr class="uk-grid-divider">

                <div class="uk-width-1-1">
                    <div style="width:100%;" class="md-btn md-btn-primary" id="deselect_markers">Quitar todo</div>
                </div>

                <hr class="uk-grid-divider">



            </div>
        </div>


        <div class="uk-width-medium-2-3 uk-width-small-1-1">

            <div id="googleMap" style="width:100%;height:380px;"></div>
            <div class="parsley-errors-list filled map-errors"></div>

        </div>
    </div>

</section>
<div id="filter_cont">

    <h5>Segmentación</h5>
    <br>
    <div class="divider"></div>
    <br>
    <div class="container">
        <div class="row">
            <form class="col s12" id="data-filters">
                <div class="row">
                    <div class="col s12">
                        <p>Edad:</p>

                        <br>

                        <p class="range-field">
                        <div id="slider" name="slider"></div>
                        </p>

                    </div>

                </div>
                <p id="age_text" name="age">Personas de 13 a 80 años</p>
                <br>

                <div class="divider"></div>
                <br>
                <div class="row">
                    <div class="col s12">
                        <p>Genero:</p>
                        <br>

                        <!--
                        <div class="row">
                            <div class="col s6 m4">
                                <input class="with-gap" name="sex" type="radio" id="val1" value="caballeros"/>
                                <label for="val1">Hombres</label>
                            </div>

                            <div class="col s6 m4">
                                <input class="with-gap" name="sex" type="radio" id="val2" value="damas"/>
                                <label for="val2">Mujeres</label>
                            </div>

                            <div class="col s6 m4">
                                <input class="with-gap" name="sex" type="radio" id="val3" value="ambos" checked/>
                                <label for="val3">Ambos</label>
                            </div>

                        </div>
                        -->

                        <div class="row">
                            <div class="genre-container">
                                <div class="female-btn btn">
                                    <img src="{{asset('images/campaign_wizard/female.png')}}" alt="mujeres">
                                </div>
                                <div class="male-btn btn">
                                    <img src="{{asset('images/campaign_wizard/male.png')}}" alt="hombres">
                                </div>

                                <p id="genres-text" class="center-align">Mujeres y Hombres</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="divider"></div>
                <br>

                <div class="row" id="place">
                    <div class="col s12">
                        <p>Fechas:</p>
                        <br>
                        <p>
                            <label for="start">Inicio de campaña</label>
                            <input type="date" placeholder="seleccionar fecha" class="datepicker" id="start"
                                   name="start">
                        </p>
                        <p>
                            <label for="end">Fin de campaña</label>
                            <input type="date" placeholder="seleccionar fecha" class="datepicker" id="end" name="end"
                                   disabled>
                        </p>

                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
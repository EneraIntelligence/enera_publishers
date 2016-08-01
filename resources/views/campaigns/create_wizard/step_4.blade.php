<h5>Presupuesto de la campaña</h5>
<div class="divider"></div>

<div class="row">
    <h5>Balance Actual:</h5>
    <p id="currentBalance"> ${{ number_format( (float) auth()->user()->wallet->current, 2, '.', '') }}   </p>
    <br>
</div>

<div class="row">

    <div class="col s6">

        <label for="budget">Presupuesto</label>
        <input class="masked_input" required value="0" name="budget" id="budget_input" type="text"
               data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'"
               data-inputmask-showmaskonhover="false"/>
    </div>

    <div class="col s6">
        <label for="budget">Balance final</label>
        <p id="balance" style="text-align: right; font: 400 15px/18px Roboto,sans-serif; padding: 5px 4px 12px 4px;">
            ${{ number_format( (float) auth()->user()["balance"]["current"], 2, '.', '') }}   </p>
    </div>

</div>

<div class="row">
    <p><span id="num_interactions">0</span> interacciones aprox. </p>
    <p>El costo por interacción es de
        <span id="price-banner_link" class="data-field data-banner_link">${{ number_format($price['banner_link'], 2, '.', ',') }}</span>
        <span id="price-captcha" class="data-field data-captcha">${{ number_format($price['captcha'], 2, '.', ',') }}</span>
        <span id="price-like" class="data-field data-like">${{ number_format($price['like'], 2, '.', ',') }}</span>
        <span id="price-video" class="data-field data-video">${{ number_format($price['video'], 2, '.', ',') }}</span>
        <span id="price-mailing_list" class="data-field data-mailing_list">${{ number_format($price['mailing_list'], 2, '.', ',') }}</span>
        <span id="price-survey" class="data-field data-survey">${{ number_format($price['survey'], 2, '.', ',') }}</span>
    </p>
    <br>
</div>

<!-- fourth section -
<h3>Presupuesto</h3>
<section>
    <h2 class="heading_a">
        Asigna presupuesto a tu campaña
    </h2>
    <hr class="md-hr"/>

    <div class="uk-grid" id="budget-block">

        <div class="uk-width-medium-1-1 parsley-row">
            <h3>Balance Actual:</h3>
            <p>  ${{ number_format( (float) auth()->user()->wallet->current, 2, '.', '') }}   </p>
            <br>
        </div>

        <div class="uk-width-medium-1-2 parsley-row">
            <label for="budget">Presupuesto</label>
            <p style="text-align: right; font: 400 15px/18px Roboto,sans-serif; margin: 0 4px 0 0; ">  ${{ number_format( (float) auth()->user()->wallet->current, 2, '.', '') }}   </p>
            <input class="md-input masked_input" required name="budget" id="budget_input" type="text" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'" data-inputmask-showmaskonhover="false" />
            <p id="balance" style="text-align: right; font: 400 15px/18px Roboto,sans-serif; padding: 5px 4px 12px 4px;">  ${{ number_format( (float) auth()->user()["balance"]["current"], 2, '.', '') }}   </p>
        </div>

        <div class="uk-width-medium-1-1 parsley-row">
            <p> <span id="num_interactions">0</span> interacciones aprox. </p>
            <p>El costo por interacción es de
                <span class="step2-field banner-link_inline ">${{ number_format($price['banner_link'], 2, '.', ',') }}</span>
                <span class="step2-field captcha _inline ">${{ number_format($price['captcha'], 2, '.', ',') }}</span>
                <span class="step2-field like_inline ">${{ number_format($price['like'], 2, '.', ',') }}</span>
                <span class="step2-field video_inline ">${{ number_format($price['video'], 2, '.', ',') }}</span>
                <span class="step2-field mailing-list_inline ">${{ number_format($price['mailing_list'], 2, '.', ',') }}</span>
                <span class="step2-field survey_inline ">${{ number_format($price['survey'], 2, '.', ',') }}</span>
            </p>
            <br>
        </div>


        {{--<div class="uk-width-medium-1-1 parsley-row">--}}
{{--<h3>Saldo</h3>--}}
{{--<p id="balance">  ${{ number_format( (float) auth()->user()["balance"]["current"], 2, '.', '') }}   </p>--}}
{{--<br>--}}
{{--</div>--}}

        </div>

    </section>

            -->
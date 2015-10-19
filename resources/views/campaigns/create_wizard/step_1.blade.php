<!-- first section -->
<h3>Tipo de campaña</h3>
<section>
    <h2 class="heading_a">
        Escoje un tipo de campaña
        <span class="sub-heading">escoje un tipo de interaccion</span>
    </h2>
    <hr class="md-hr"/>
    <div>
        {{--<link rel="icon" type="image/png" href="" sizes="32x32">--}}
        {{--<img src="{!! URL::asset('images/64x64.png') !!}" alt="">--}}
        <img src="{!! URL::asset('images/icono_captcha.png') !!}" alt="">
    </div>
    <div class="uk-grid">
        <div class="uk-width-medium-1-1 parsley-row">
            <label for="wizard_fullname">Full Name<span class="req">*</span></label>
            <input type="text" name="wizard_fullname" id="wizard_fullname" required class="md-input" />
        </div>
    </div>
    <div class="uk-grid">
        <div class="uk-width-medium-1-1 parsley-row">
            <label for="wizard_address">Address<span class="req">*</span></label>
            <input type="text" name="wizard_address" id="wizard_address" required class="md-input" />
        </div>
    </div>
</section>
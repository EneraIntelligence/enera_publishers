{!! HTML::style('assets/css/captcha.css') !!}

<!-- preview -->
<div id="fb-root"></div>


<!-- Banner card -->
<div class="banner card-panel z-depth-2 center-align">
    <img class="responsive-img image-small" style="margin-bottom: -6px;"
         src="https://s3-us-west-1.amazonaws.com/enera-publishers/items/{!! $cam->content['images']['small'] !!}">

</div>
<!-- Banner card -->

<!-- botón de navegar -->
<div class="card-panel center-align actions-card" style="padding: 0;">
    <div id="captcha" style="margin: 0 15px 0 15px;">

        <form action="#">
            <div class="input-field col s12">
                <input id="captcha-value" type="text" name="captcha" style="margin: 0;">
                <label for="captcha-value" data-error="wrong" data-success="right">Captcha</label>
            </div>
        </form>
        <div id="error">Respuesta invalida</div>
        <button id="navegar" class="btn waves-effect waves-light subscribe-btn indigo z-depth-2"
                success_url="{{Input::get('base_grant_url') }}">
            Navegar en internet
        </button>
        <div>
            <p> * Para navegar por internet ingresa la palabra en la imagen </p>
        </div>
    </div>

</div>


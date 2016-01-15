<!-- preview -->
<div class="preview-container">

    <img class="uk-align-center uk-responsive-width phone" src="{!! URL::asset('images/android_placeholder.png') !!}" alt="">

    <!-- captcha preview -->
    <div class="interaction uk-align-center uk-position-relative">

        <img class="interaction-image" src="{!! "https://s3-us-west-1.amazonaws.com/enera-publishers/items/". $cam->content['images']['survey'] !!}"alt=""/>

        <h3 class="uk-text-center center-text uk-margin-small">¿Pregunta 1?</h3>
        <div style="width:100%;" class="md-btn md-btn-primary uk-margin-small">A</div>
        <div class="uk-clearfix"></div>
        <div style="width:100%;" class="md-btn md-btn-primary uk-margin-small">B</div>
        <div class="uk-clearfix"></div>
        <div style="width:100%;" class="md-btn md-btn-primary uk-margin-small">C</div>

    </div>

</div>

<!-- end preview -->
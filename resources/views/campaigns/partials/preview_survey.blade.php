<!-- preview -->
{!! HTML::style('assets/css/survey.css') !!}
<div id="fb-root"></div>

<!-- Banner card -->
<div class="banner card-panel z-depth-2 center-align">
    <img class="responsive-img image-small" style="margin-bottom: -6px;"
         src="https://s3-us-west-1.amazonaws.com/enera-publishers/items/{!! $cam->content['images']['survey'] !!}">
</div>
<!-- Banner card -->

<!-- botones -->
<div class="card-panel center-align actions-card">
    <div class="question black-text" id="step_0" style="display:block">
        <p style="margin-top: 0;">¿Tienes coche propio?</p>
        <div>
            <a class="answer btn waves-effect waves-light indigo z-depth-2" href="#!">
                        <span class="white-text left">
                            Si
                        </span>
                <i class="right material-icons">navigate_next</i>
            </a>
            <p style="margin: 5px 0; "></p>
            <a class="answer btn waves-effect waves-light indigo z-depth-2" href="#!">
                        <span class="white-text left">
                            No
                        </span>
                <i class="right material-icons">navigate_next</i>
            </a>
            <p></p>
        </div>
    </div>

</div>
<!-- botones -->

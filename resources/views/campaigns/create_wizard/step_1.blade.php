<div class="step1">

    <h5>Elige una interacción</h5>

    <ul class="collection side-margin-20px clickable">

        <li class="collection-item avatar animate-all hover-blue" id="banner_link" data-interaction="banner_link">
            <img class="animate-all interaction-icon" style="margin-left: -55px;"
                 src="{{ asset("images/interaction_icon/banner_link_black.svg") }}" alt="banner icon">
            <span class="title"><strong>Banner + link</strong></span>
            <p>Publica un banner y recibe usuarios en tu sitio. </p>
            <div class="price">
                <span>$ {{number_format($price['banner_link'], 2, '.', ',')}} por interacción</span>
            </div>
        </li>

        <li class="collection-item avatar animate-all hover-blue" id="like" data-interaction="like">
            <img class="animate-all interaction-icon"
                 src="{{ asset("images/interaction_icon/like_black.svg") }}" alt="like icon">
            <span class="title"><strong>Like</strong></span>
            <p>Invita a los usuarios de la red a dar like a una página. </p>
            <div class="price">
                <span>$ {{number_format($price['like'], 2, '.', ',')}} por interacción</span>
            </div>
        </li>

        <li class="collection-item avatar animate-all hover-blue" id="mailing_list" data-interaction="mailing_list">
            <img class="animate-all interaction-icon"
                 src="{{ asset("images/interaction_icon/mailing_list_black.svg") }}" alt="like icon">
            <span class="title"><strong>Mailing list</strong></span>
            <p>Invita a los usuarios a unirse a una lista de correos.</p>
            <div class="price">
                <span>$ {{number_format($price['mailing_list'], 2, '.', ',')}} por interacción</span>
            </div>
        </li>

        <li class="collection-item avatar animate-all hover-blue" data-interaction="captcha">
            <img class="animate-all interaction-icon" style="margin-top: 10px;"
                 src="{{ asset("images/interaction_icon/captcha_black.svg") }}" alt="like icon">
            <span class="title"><strong>Captcha</strong></span>
            <p>Haz que los usuarios escriban algo relacionado a tu producto.</p>
            <div class="price">
                <span>$ {{number_format($price['captcha'], 2, '.', ',')}} por interacción</span>
            </div>
        </li>

        <li class="collection-item avatar animate-all hover-blue" id="survey" data-interaction="survey">
            <img class="animate-all interaction-icon"
                 src="{{ asset("images/interaction_icon/survey_black.svg") }}" alt="like icon">
            <span class="title"><strong>Encuesta</strong></span>
            <p>Crea una encuesta que contestarán los usuarios.</p>
            <div class="price">
                <span>$ {{number_format($price['survey'], 2, '.', ',')}} por interacción</span>
            </div>
        </li>

        <li class="collection-item avatar animate-all hover-blue" id="video" data-interaction="video">
            <img class="animate-all interaction-icon"
                 src="{{ asset("images/interaction_icon/video_black.svg") }}" alt="like icon">
            <span class="title"><strong>Video</strong></span>
            <p>Muestra un video que verán los usuarios para acceder a la red.</p>
            <div class="price">
                <span>$ {{number_format($price['video'], 2, '.', ',')}} por interacción</span>
            </div>
        </li>

    </ul>


</div>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="">
</head>
<body>

</body>
<div style="text-align: center;">
    <img src="http://enera.mx/images/logo-dark.png" alt="">
</div>
<div>
    <p>La camapaña {{$camp->name}} ha sido creada </p>
    <p>Los datos de la campaña son los siguientes</p>
    <div class="uk-width-large-1 uk-width-medium-1-2">
        <ul class="md-list">
            <li>
                <div class="md-list-content">
                    <span class="md-list-heading">Id</span>
                    <span class="md-list-heading"> - {{$camp->_id}}</span>
                </div>
            </li>
            <li>
                <div class="md-list-content">
                    <span class="md-list-heading">Tipo de interacción</span>
                    <span class="md-list-heading"> - {{$camp->interaction['name']}}</span>
                </div>
            </li>
            <li>
                <div class="md-list-content">
                    <span class="md-list-heading">Fecha de creacion</span>
                    <span class="md-list-heading"> - {{$camp->created_at}}</span>
                </div>
            </li>
            @if(isset($camp->content['items']))
                <li>
                    <div class="md-list-content">
                        <span class="md-list-heading">Items: </span>
                        <br>

                        @foreach($camp->content['items'] as $content)
                            <span class="md-list-heading">  - {{$content}}</span>
                            <br>
                        @endforeach

                    </div>
                </li>
            @endif
            @if(isset($camp->content['images']))
                <li>
                    <div class="md-list-content">
                        <span class="md-list-heading">Images: </span>
                        <br>
                        @foreach($camp->content['images'] as $key => $content)
                            <span class="md-list-heading">  - {{$key .' : ' . $content}}</span>
                            <br>
                        @endforeach

                    </div>
                </li>
            @endif
            @if(isset($camp->content['survey']))
                <li>
                    <div class="md-list-content">
                        <span class="md-list-heading">Encuesta: </span>
                        <br>
                        @foreach($camp->content['survey'] as $content)
                            <span class="md-list-heading">  - {{ $content}}</span>
                            <br>
                            @foreach($content['answers'] as $a )
                                <span class="md-list-heading">  - {{ $a}}</span>
                                <br>
                            @endforeach
                        @endforeach
                    </div>
                </li>
            @endif
            @if(isset($camp->content['mail']))
                <li>
                    <div class="md-list-content">
                        <span class="md-list-heading">Correo: </span>
                        <br>
                        @foreach($camp->content['mail'] as $content)
                            <span class="md-list-heading">  - {{$content}}</span>
                            <br>
                        @endforeach
                    </div>
                </li>
            @endif
            @if(isset($camp->content['captcha']))
                <li>
                    <div class="md-list-content">
                        <span class="md-list-heading">Captcha: </span>
                        <br>

                        @foreach($camp->content['captcha'] as $content)
                            <span class="md-list-heading">  - {{$content}}</span>
                            <br>
                        @endforeach

                    </div>
            @endif
            @if(isset($camp->content['video']))
                <li>
                    <div class="md-list-content">
                        <span class="md-list-heading">Video: </span>
                        <br>

                        @foreach($camp->content['video'] as $content)
                            <span class="md-list-heading">  - {{$content}}</span>
                            <br>
                        @endforeach

                    </div>
                </li>
            @endif
        </ul>
    </div>
</div>
</html>

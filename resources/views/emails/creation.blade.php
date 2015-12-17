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
                    <span class="md-list-heading">Items: </span>
                    <br>
                    @foreach($camp->content['items'] as $content)
                        <span class="md-list-heading">  - {{$content}}</span>
                        <br>
                    @endforeach
                </div>
            </li>
            <li>
                <div class="md-list-content">
                    <span class="md-list-heading">Images: </span>
                    <br>
                    @foreach($camp->content['images'] as $content)
                        <span class="md-list-heading">  - {{$content}}</span>
                        <br>
                    @endforeach
                </div>
            </li>
            <li>
                <div class="md-list-content">
                    <span class="md-list-heading">Images: </span>
                    <br>
                    @foreach($camp->content['survey'] as $content)
                        <span class="md-list-heading">  - {{$content}}</span>
                        <br>
                    @endforeach
                </div>
            </li>
        </ul>
    </div>
</div>
</html>

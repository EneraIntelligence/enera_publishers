<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        body
        {
            font-family: "Roboto", serif, sans-serif;
            color: #000000;
        }
    </style>
</head>
<body>
<div style="text-align: center;">
    <img src="http://publishers.enera-intelligence.mx/images/publisher.png" alt="">
</div>
<div style="width: 75%; margin: auto;">
    <h2>Confirma tu Email </h2>
    <div>
        <p>Estimado: {{$data['nombre'] . ' ' . $data['apellido']}}  gracias por registrarse en Enera-Publisher.<br>
        Para poder acceder a la plataforma de Publisher solo necesitas confirmar tu cuenta haciendo click en el siguiente link:<br>
            <a href="http://publishers.enera-intelligence.mx/register/verify/{{$data['id_usuario'].'/'. $data['confirmation_code'] )}}"> confirmar registro</a>
            {{--<br>o copia pega la siguiente url:
            {{ URL::to('register/verify/' . $data['confirmation_code'] )}}--}}
            {{--<a href="">aqui</a>--}}
        </p>
        <p>Atentamente:</p>
        <p>Enera Intelligence</p>

        <p>Este correo se genero de forma automatica, no contestar. Si usted tiene alguna duda mandar un correo a la siguente dirección: "soporte&#64;enera.mx"</p>
    </div>
</div>
<div style="text-align: center;">
    <img src="http://enera.mx/images/logo-dark.png" alt="">
</div>
</body>
</html>

{{--{{dd($data)}}--}}
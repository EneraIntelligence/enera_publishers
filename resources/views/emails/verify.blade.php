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
    <h2>Confirma tu correo </h2>
    <div>
        <p>Estimado/a: {{$data['nombre'] . ' ' . $data['apellido']}}
            gracias por registrarse en Enera Publishers.<br>
        Para acceder a la plataforma de Publishers necesitas confirmar tu cuenta haciendo clic en el siguiente enlace:<br>
            <a href="http://publishers.enera-intelligence.mx/register/verify/{{$data['id_usuario'].'/'. $data['confirmation_code']}} "> confirmar registro aqui</a>
            <br>o copia y pega la siguiente url en tu navegador:
            http://publishers.enera-intelligence.mx/register/verify/{{$data['id_usuario'].'/'.$data['confirmation_code']}}
        </p>
        <p>Atentamente:</p>
        <p>Enera Intelligence</p>

        <p>Este correo se genero de forma automatica, no contestar. Si usted tiene alguna duda envie un correo a la siguente dirección: soporte&#64;enera.mx </p>
    </div>
</div>
<div style="text-align: center;">
    <img src="http://enera.mx/images/logo-dark.png" alt="">
</div>
</body>
</html>

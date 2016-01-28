<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script>
        WebFontConfig = {
            google: {
                families: [
                    'Source+Code+Pro:400,700:latin',
                    'Roboto:400,300,500,700,400italic:latin'
                ]
            }
        };
        (function () {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                    '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>
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
            <a href="http://publishers.enera-intelligence.mx/register/verify/{{$data['id_usuario'].'/'. $data['confirmation_code'}} "> confirmar registro</a>
            <br>o copia pega la siguiente url:
            http://publishers.enera-intelligence.mx/register/verify/{{$data['id_usuario'].'/'.$data['confirmation_code']}}
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
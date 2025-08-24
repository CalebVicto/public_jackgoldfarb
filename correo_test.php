<?php

$para = "calebizqui@gmail.com";
$titulo = "colegiojackgoldfarb.com";
$Mensaje = "Intento de envio";

$header = 'From: <colegiojackgoldfarb.com>' . "\r\n" .
        'Reply-To:<reply@reply.re>' . "\r\n" .
        'Content-Type: text/plain; charset=utf-8' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        
$envio = mail($para, $titulo, $Mensaje, $header);

if($envio){
    echo 'Enviado';
}else{
    echo 'No se envio';
}
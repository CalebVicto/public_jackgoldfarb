<?php

header('Content-Type: application/json');

header('Access-Control-Allow-Origin: *');

header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");

header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "OPTIONS") {

  die();

}





$nombres = $_POST['nombres'];

$telefono = $_POST['telefono'];

$email = $_POST['email'];

$grado = $_POST['grado'];

if (isset($_POST['comentario'])) {

  $comentario = $_POST['comentario'];

} else {

  $comentario = '-';

}



$para = "secretaria.goldfarb@yahoo.com";

$titulo = "COLEGIOJACKGOLDFARB.COM";

$Mensaje =

  "--- SOLICITUD DE INFORMACIÓN ---\r\n" .

  "Nombres: $nombres" . "\r\n" .

  "Telefono: $telefono" . "\r\n" .

  "Email: $email" . "\r\n" .

  "Grado de interes: $grado" . "\r\n" .

  "Comentario: $comentario" . "\r\n";



$headers = 'From: <reply@reply.re>' . "\r\n" .

  'Reply-To: <reply@reply.re>' . "\r\n" .

  'Content-Type: text/plain; charset=utf-8' . "\r\n" .

  'X-Mailer: PHP/' . phpversion();



$envio = mail($para, $titulo, $Mensaje, $headers);



if ($envio) {

  $res = array('status' => true, 'res' => 'Dentro de poco nos comunicaremos');

  echo json_encode($res);

  //   echo "<script>

  //      alert('Se envio correctamente');

  //     location.href = './';

  // </script>";

} else {

  $res = array('status' => false, 'res' => 'Ocurrio un error! Intentelo nuevamente');

  echo json_encode($res);

  //   echo "<script>

  //     alert('no se pudo enviar- revisa el correo, si ya lo tenemos no te preocupes te escribiremos pronto');

  //     location.href = './index.html';

  // </script>";

}


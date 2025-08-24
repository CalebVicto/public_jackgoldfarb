<?php
iconv_set_encoding("internal_encoding", "UTF-8");

header('Content-Type: application/json; charset=utf-8');

header('Access-Control-Allow-Origin: *');

header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");

header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "OPTIONS") {

  die();

}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'libs/PHPMailer/Exception.php';
require 'libs/PHPMailer/PHPMailer.php';
require 'libs/PHPMailer/SMTP.php';

$mail = new PHPMailer(true);
$mail->CharSet = "UTF-8";

$para = "secretaria.goldfarb@yahoo.com";

try {
  $mail->isSMTP();
  $mail->Host = 'mail.colegiojackgoldfarb.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'colegi31';
  $mail->Password = '%clgJckGlfrb@1';
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mail->Port = 465;
  $mail->setFrom('colegi31@colegiojackgoldfarb.com', 'Colegio JackGoldFarb');
  $mail->addAddress($para);
  $mail->isHTML(true);
  $titulo = "INSCRIPCIÓN 3º CONCURSO CUBO DE RUBIK";
  $mail->Subject = $titulo;
  $colegio = $_POST['colegio'];

  $direccion = $_POST['direccion'];

  $distrito = $_POST['distrito'];

  $telefonos = $_POST['telefonos'];

  $director = $_POST['director'];

  $asesor = $_POST['asesor'];


  $body =


    "<h4>FICHA DE INSCRIPCIÓN</h4><br>" .

    "<strong>COLEGIO</strong>: $colegio <br>" .

    "<strong>DIRECCIÓN</strong>: $direccion <br>" .

    "<strong>DISTRITO</strong>: $distrito <br>" .

    "<strong>TELÉFONOS</strong>: $telefonos <br>" .

    "<strong>DIRECTOR(A)</strong>: $director <br>" .

    "<strong>ASESOR(A)</strong>: $asesor <br>";

  $body .= "<strong>NIVEL PRIMARIA</strong><br>";
  for ($i = 0; $i < 7; $i++) {
    $indice = $i + 1;
    $alumno_nombre = $_POST["primaria-nombre-$indice"];
    $alumno_grado = $_POST["primaria-grado-$indice"];
    if ($alumno_nombre && $alumno_grado && strlen($alumno_nombre) > 0 && strlen($alumno_grado) > 0) {
      $body .= "<strong>{$indice}.</strong> Nombre: $alumno_nombre - Grado: $alumno_grado <br>";
    }

  }
  $body .= "<strong>NIVEL SECUNDARIA</strong><br>";
  for ($i = 0; $i < 7; $i++) {
    $indice = $i + 1;
    $alumno_nombre = $_POST["secundaria-nombre-$indice"];
    $alumno_grado = $_POST["secundaria-grado-$indice"];
    if ($alumno_nombre && $alumno_grado && strlen($alumno_nombre) > 0 && strlen($alumno_grado) > 0) {
      $body .= "<strong>{$indice}.</strong> Nombre: $alumno_nombre - Grado: $alumno_grado <br>";
    }
  }
  $mail->Body = $body;
  $mail->Send();
  $res = array('status' => true, 'res' => 'Dentro de poco nos comunicaremos');
  echo json_encode($res);
} catch (Exception $e) {
  $res = array('status' => false, 'res' => 'Ocurrio un error! Intentelo nuevamente');
  echo json_encode($e);
}


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
use PHPMailer\PHPMailer\SMTP;

require 'libs/PHPMailer/Exception.php';
require 'libs/PHPMailer/PHPMailer.php';
require 'libs/PHPMailer/SMTP.php';

$mail = new PHPMailer(true);
$mail->CharSet = "UTF-8";

$target_dir = "uploads/";

$para = "postulantes.jackgoldfarb@gmail.com";
try {
  $mail->isSMTP();
  $mail->Host       = 'mail.colegiojackgoldfarb.com';
  $mail->SMTPAuth   = true;
  $mail->Username   = 'colegi31';
  $mail->Password   = 'Cpanel@colegioJg';
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mail->Port       = 465;
  $mail->setFrom('_mainaccount@colegiojackgoldfarb.com', 'Colegio JackGoldFarb');
  $mail->addAddress($para);
  $mail->isHTML(true);


  $apellido_paterno = $_POST['middlename'];

  $apellido_materno = $_POST['lastname'];

  $nombres = $_POST['name'];

  $dni = $_POST['dni'];

  $edad = $_POST['age'];

  $celular = $_POST['cellphone'];

  $email = $_POST['email'];

  $direccion = $_POST['address'];

  $grado = $_POST['grado'];

  $profesion = $_POST['profesion'];

  $puesto = $_POST['puesto'];

  $otro_puesto = $_POST['other'];

  if (isset($_POST['other'])) {

    $otro_puesto = $_POST['other'];

  } else {
      $otro_puesto = '-';
  }

  $titulo = "POSTULANTE DE TRABAJO";

  $mail->Subject = $titulo;
  $body =

  "<h4>DATOS DEL POSTULANTE</h4><br>" .

  "<strong>Nombres</strong>: $nombres <br>".

  "<strong>Apellido Paterno</strong>: $apellido_paterno <br>".

  "<strong>Apellido Materno</strong>: $apellido_materno <br>".

  "<strong>DNI</strong>: $dni <br>".

  "<strong>Edad</strong>: $edad <br>".

  "<strong>Celular</strong>: $celular <br>".

  "<strong>Email</strong>: $email <br>".

  "<strong>Direccion</strong>: $direccion <br>".

  "<strong>Grado Academico</strong>: $grado <br>".

  "<strong>Profesión</strong>: $profesion <br>".

  "<strong>Puesto al que postula</strong>: $puesto <br>".

  "<strong>Otro puesto</strong>: $otro_puesto";

  $mail->Body = $body;

  if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
    $fileName = $_FILES['uploadedFile']['name'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    $allowedfileExtensions = array('txt', 'pdf', 'doc', 'docx');
    if (in_array($fileExtension, $allowedfileExtensions)) {
        $dest_path = $target_dir . $fileName;
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $message = 'El archivo se subio correctamente';
            $mail->AddAttachment($dest_path);
        } else {
            $message = 'Error al subir el archivo';
        }
    } else {
            $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
    }
  } else {
      $message .= 'Error:' . $_FILES['uploadedFile']['error'];
  }

  $mail->Send();
  $res = array('status' => true, 'res' => 'Dentro de poco nos comunicaremos');
  unlink($dest_path);
  echo json_encode($res);
} catch (Exception $e) {
  $res = array('status' => false, 'res' => 'Ocurrio un error! Intentelo nuevamente:', 'motivo' => $mail->ErrorInfo);
  echo json_encode($res);
}

?>
<?php
include_once 'core/app/mail/Exception.php';
include_once 'core/app/mail/OAuth.php';
include_once 'core/app/mail/PHPMailer.php';
include_once 'core/app/mail/SMTP.php';
$r = new TicketData();
$r->title = $_POST["title"];
$r->description = $_POST["description"];
$r->category_id = $_POST["category_id"];
$r->person_id = $_POST["person_id"];
$r->project_id = $_POST["project_id"];
$r->priority_id = $_POST["priority_id"];
$r->user_id = $_SESSION["user_id"];
$r->user_id = $_SESSION["user_id"];
//comento el estado, para que todos los tickets esten en estado de pendiente
//$r->status_id = $_POST["status_id"];
$r->kind_id = $_POST["kind_id"];

//SUBIMOS LA EVIDENCIA
$nom_evidencia = $_FILES['evidencia']['name'];
$tip_evidencia = $_FILES['evidencia']['type'];
$tam_evidencia = $_FILES['evidencia']['size'];

$carpeta_existe = $_SERVER['DOCUMENT_ROOT'] . '/Soporte/evidencias/'.sha1(md5($r->description)).'/';
if(!is_dir($carpeta_existe))
{ 
$carpeta_crear = mkdir($_SERVER['DOCUMENT_ROOT'] . '/Soporte/evidencias/'.sha1(md5($r->description)).'/');
$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/Soporte/evidencias/'.sha1(md5($r->description)).'/';
$carpeta_remoto = 'evidencias/'.sha1(md5($r->description)).'/';
move_uploaded_file($_FILES['evidencia']['tmp_name'],$carpeta_destino.$nom_evidencia);
//SI NO VIENE EVIDENCIA MANDAMOS UN VALOR NULO
if (!empty($nom_evidencia)) {
   $r->evidencia = $carpeta_remoto.$nom_evidencia; 
} else {
    $r->evidencia = "evidencias/sinfoto.jpeg";
}
}
else
{
$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/Soporte/evidencias/'.sha1(md5($r->description)).'/';
$carpeta_remoto = 'evidencias/'.sha1(md5($r->description)).'/';
move_uploaded_file($_FILES['evidencia']['tmp_name'],$carpeta_destino.$nom_evidencia);
//SI NO VIENE EVIDENCIA MANDAMOS UN VALOR NULO
if (!empty($nom_evidencia)) {
   $r->evidencia = $carpeta_remoto.$nom_evidencia; 
} else {
    $r->evidencia = "evidencias/sinfoto.jpeg";
}
}
$r->add();


//------------------------------------------------------------------------------
$sql = "SELECT
t.id                    AS  IDE_TIC,    
t.title                 AS  TIT_TIC,
t.created_at		AS  FEC_TIC,
t.description           AS  DES_TIC,
h.description           AS  DES_HIS,
h.created_at            AS  FEC_HIS,
h.user_id               AS  IDE_TEC,
u.name                  AS  NOM_TEC,
u.lastname              AS  APE_TEC,
u.email                 AS  MAI_TEC,
p.name			AS  NOM_PER,
p.lastname		AS  APE_PER,
p.email			AS  MAI_PER,
s.name                  AS  EST_TIC
FROM tickethistory      h
RIGHT OUTER JOIN ticket t ON t.id = h.ticket_id
RIGHT OUTER JOIN user   u ON u.id = t.user_id
RIGHT OUTER JOIN person	p ON p.id = t.person_id
RIGHT OUTER JOIN status	s ON s.id = t.status_id
WHERE t.title = '$r->title'
ORDER BY FEC_HIS DESC    ";
$conexion = mysqli_connect("localhost", "root", "", "soporte");
    $resultado  = mysqli_query($conexion, $sql);
    $mostrar    = $resultado->fetch_assoc();
    
    $ide_tic = $mostrar['IDE_TIC'];                          //Id del ticket
    $tit_tic = $mostrar['TIT_TIC'];                          //titulo del
    $fec_tic = $mostrar['FEC_TIC'];                          //fecha del ticket
    $des_tic = $mostrar['DES_TIC'];                          //descripcion del ticket
    $des_his = $mostrar['DES_HIS'];                          //descripcion de los historicos
    $fec_his = $mostrar['FEC_HIS'];                          //fecha de historicos
    $ide_tec = $mostrar['IDE_TEC'];                          //Id del tecnico
    $nom_tec = $mostrar['NOM_TEC']." ".$mostrar['APE_TEC'];  //nombre completo del tecnico
    $mai_tec = $mostrar['MAI_TEC'];                          //correo del tecnico
    $nom_per = $mostrar['NOM_PER']." ".$mostrar['APE_PER'];  //nombre completo del solicitante
    $mai_per = $mostrar['MAI_PER'];                          //correo del solicitante
    $est_tic = $mostrar['EST_TIC'];                          //estado del ticket

    //Configuraciones para enviar correo con PHPMailer
    //Fuente:   https://github.com/PHPMailer/PHPMailer/blob/master/src/SMTP.php
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 0;//para ver los mensajes de log
    $mail->Host = 'smtp.readyhosting.com';
    $mail->Port = '587';
    $mail->SMTPSecure = false;
    $mail->SMTPAuth = true;
    $mail->Username = 'ticket@transpheric.com';
    $mail->Password = 'SLms5847';
    $mail->setFrom('ticket@transpheric.com', 'Ticket transpheric');     //direccion del remitente
    $mail->addAddress($mai_per, $nom_per);                              //direccion y nombre del correo receptor
    $mail->addAddress($mai_tec, $nom_tec);                              //direccion y nombre del correo receptor
    $mail->addReplyTo($mai_tec, $nom_tec);                              //responder a
    $mail->isHTML(true);                                                //definir el formato comoHTML
    $mail->Subject = "ALTA DE SOLICITUD: ". $tit_tic." - "."FOLIO:"." ".$ide_tic;                             //asunto
    //---------------------------------------Cuerpo del correo------------------------------//
    $mail->Body = $nom_per."
        <br>
        "."Se reporta alta para la solicitud: ".$tit_tic.
        "
        <br>
        "."Descripcion: ".$des_tic.
        "
        Estado del ticket: ".$est_tic."
        <br>
        Folio: ".$ide_tic."
        <br>
        Creado el:"." ".$fec_tic."
        <br>
        Cualquier duda o comentario, puede responder este correo.
        <br>
        Sistemas Transpheric";
    $mail->IsHTML(true);

        if (!$mail->send()) {
            echo 'correo no enviado regresar al <a href="./" >inicio</a>';    //De no poderse enviar imprimimos que no se pudo enviar
} else {
//ALERTA DE QUE SE AGREGO EL TICKET
Core::alert("¡Agregado exitosamente!");
//REDIRECCIONAMOS AL HISTORIAL DE TICKETS
Core::redir("./index?view=ticketspendings");
}
mysqli_close($conexion);                                        //cerramos conexion
?>
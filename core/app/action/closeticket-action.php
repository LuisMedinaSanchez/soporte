<?php
//Archivos para mandar el correo
include_once 'core/app/mail/Exception.php';
include_once 'core/app/mail/OAuth.php';
include_once 'core/app/mail/PHPMailer.php';
include_once 'core/app/mail/SMTP.php';
$conexion = mysqli_connect("localhost", "root", "", "soporte");

if (count($_POST) > 0) {
        $r = TicketData::getById($_POST["id"]);
        $r->title = $_POST["title"];
        $r->category_id = $_POST["category_id"];
        $r->project_id = $_POST["project_id"];
        $r->person_id = $_POST["person_id"];
        $r->priority_id = $_POST["priority_id"];
        $r->description = $_POST["description"];
        $r->status_id = "75";
        $r->kind_id = $_POST["kind_id"];

        $r->close();
    }

    //------------------------------------------------------------------------------
$sql = "SELECT 
t.title                 AS  TIT_TIC,
t.created_at		AS  FEC_TIC,
t.description           AS  DES_TIC,
h.description           AS  DES_HIS,
h.created_at            AS  FEC_HIS,
h.user_id               AS  ID_TEC,
u.name                  AS  NOM_TEC,
u.lastname              AS  APE_TEC,
u.email                 AS  MAI_TEC,
p.name			AS  NOM_PER,
p.lastname		AS  APE_PER,
p.email			AS  MAI_PER,
s.name                  AS  EST_TIC
FROM tickethistory      h
RIGHT OUTER JOIN user   u ON u.id = h.user_id
RIGHT OUTER JOIN ticket t ON t.id = h.ticket_id
RIGHT OUTER JOIN person	p ON p.id = t.person_id
RIGHT OUTER JOIN status	s ON s.id = t.status_id
WHERE t.id = $r->id ";
$conexion = mysqli_connect("localhost", "root", "", "soporte");
    $resultado  = mysqli_query($conexion, $sql);
    $mostrar    = $resultado->fetch_assoc();

    $tit_tic = $mostrar['TIT_TIC'];                          //titulo del
    $des_tic = $mostrar['DES_TIC'];                          //descripcion del ticket
    $fec_tic = $mostrar['FEC_TIC'];                          //fecha del ticket
    $des_his = $mostrar['DES_HIS'];                          //descripcion de los historicos
    $fec_his = $mostrar['FEC_HIS'];                          //fecha de historicos
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
    $mail->Subject = "SOLICITUD DE CIERRE: ". $tit_tic." - "."FOLIO:"." ".$r->id;                             //asunto
    //---------------------------------------Cuerpo del correo------------------------------//
    $mail->Body = $nom_per."
        <br>
        "."Solicitud de cierre para el ticket: ".$tit_tic.
        "
        <br>
        Estado del ticket: ".$est_tic."
        <br>
        Folio: ".$r->id."
        <br>
        Creado el:"." ".$fec_tic."
        <br>
        <br>
        Avances:
        <br>"
        .$des_his.
        "<br>"
        ."Registrado el:"." ".$fec_his."
         <br>
         <br>
         Para cerrar el ticket has click <a href='http://transpheric.sytes.net:81/soporte/index?view=closeticketuser&id=".$r->id."'>aqui</a>
         <br>
         <br>
        <br>
        Cualquier duda o comentario, puede responder este correo.
        <br>
        Sistemas Transpheric";
    $mail->IsHTML(true);

        if (!$mail->send()) {
            echo 'correo no enviado';                           //De no poderse enviar imprimimos que no se pudo enviar
} else {
//ALERTA DE QUE SE AGREGO EL TICKET
Core::alert("¡Agregado exitosamente!");
////REDIRECCIONAMOS AL HISTORIAL DE TICKETS
Core::redir("./index?view=ticketspendings");
}
mysqli_close($conexion);                                        //cerramos conexion
    
    
?>
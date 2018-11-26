<?php

$r = new TicketData();

$r->ticket_id = $_POST["id"];
$r->description = $_POST["description"];
$r->user_id = $_SESSION["user_id"];
$r->user_id = $_SESSION["user_id"];
$r->status_id = $_POST["status_id"];

//SUBIMOS LA EVIDENCIA DEL HISTORICO
$nom_evidenciahistory_id = $_FILES['evidenciahistory_id']['name'];
$tip_evidenciahistory_id = $_FILES['evidenciahistory_id']['type'];
$tam_evidenciahistory_id = $_FILES['evidenciahistory_id']['size'];
$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/Soporte/evidencias/';
$carpeta_remoto = 'evidencias/';
move_uploaded_file($_FILES['evidenciahistory_id']['tmp_name'], $carpeta_destino . $nom_evidenciahistory_id);
//SI NO VIENE EVIDENCIA MANDAMOS UN VALOR NULO
if (!empty($nom_evidenciahistory_id)) {
    $r->evidenciahistory_id = $carpeta_remoto . $nom_evidenciahistory_id;
} else {
    $r->evidenciahistory_id = "evidencias/sinfoto.jpeg";
}
$r->addHistory();


if ($_POST["status_id"] != "") {
    $r->status_id = $_POST["status_id"];
    $r->update_status_id();
}

//ALERTA DE QUE SE AGREGO EL TICKET
Core::alert("¡Agregado exitosamente!");
//REDIRECCIONAMOS AL HISTORIAL DE TICKETS
Core::redir("./index?view=historyticket&id=$r->ticket_id");
?>
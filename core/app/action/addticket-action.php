<?php
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
$carpeta_destino= $_SERVER['DOCUMENT_ROOT']. '/Soporte/evidencias/';
$carpeta_remoto= 'evidencias/';
move_uploaded_file($_FILES['evidencia']['tmp_name'],$carpeta_destino.$nom_evidencia);
//SI NO VIENE EVIDENCIA MANDAMOS UN VALOR NULO
if (!empty($nom_evidencia)) {
   $r->evidencia = $carpeta_remoto.$nom_evidencia; 
} else {
    $r->evidencia = NULL;
}

$r->add();
//ALERTA DE QUE SE AGREGO EL TICKET
Core::alert("¡Agregado exitosamente!");
//REDIRECCIONAMOS AL HISTORIAL DE TICKETS
Core::redir("./index?view=ticketspendings");
?>
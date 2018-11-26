<?php
// Se divide en dos la accion de actualizacion de tickets, para que se
//pueda actualizar solo categorias, el codigo solo actualiza 5 campos
if (count($_POST) > 0) {
//    if ($_POST["title"] != "") {
//        $user = TicketData::getById($_POST["id"]);
//        $user->title = $_POST["title"];
//        $user->category_id = $_POST["category_id"];
//        $user->project_id = $_POST["project_id"];
//        $user->priority_id = $_POST["priority_id"];
//        $user->description = $_POST["description"];
//        $user->status_id = $_POST["status_id"];
//        $user->kind_id = $_POST["kind_id"];
//        //SUBIMOS LA EVIDENCIA
//        $nom_evidencia = $_FILES['evidencia']['name'];
//        $tip_evidencia = $_FILES['evidencia']['type'];
//        $tam_evidencia = $_FILES['evidencia']['size'];
//        $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/soporte/evidencias/';
//        $carpeta_remoto = 'evidencias/';
//        move_uploaded_file($_FILES['evidencia']['tmp_name'], $carpeta_destino . $nom_evidencia);
//SI NO VIENE EVIDENCIA MANDAMOS UN VALOR NULO
        //if (!empty($nom_evidencia)) {
//            $r->evidencia = $carpeta_remoto . $nom_evidencia;
        //} else {
            //$r->evidencia = NULL;
        //}
//
//        $user->update();
//    } else {
        $user = TicketData::getById($_POST["id"]);
        $user->category_id = $_POST["category_id"];
        $user->project_id = $_POST["project_id"];
        $user->priority_id = $_POST["priority_id"];
        $user->status_id = $_POST["status_id"];
        $user->kind_id = $_POST["kind_id"];
        $user->updateCategory();
    }
    Core::alert("Actualizado exitosamente!");
    Core::redir("./index?view=home");
//}
?>
<?php
$user = TicketData::getById($_GET["id"]);
$user->del();
Core::redir("./index?view=home");
?>
<?php

$client = ProjectData::getById($_GET["id"]);
$client->del();
Core::redir("./index?view=projects");

?>
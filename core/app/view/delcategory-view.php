<?php

$category = CategoryData::getById($_GET["id"]);

$category->del();
Core::redir("./index?view=categories");


?>
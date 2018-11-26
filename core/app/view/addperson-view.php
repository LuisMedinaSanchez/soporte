<?php

if(count($_POST)>0){
	$user = new PersonData();
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];
	$user->email = $_POST["email"];
	$user->kind = $_POST["kind"];
	$user->add();

print "<script>window.location='index.php?view=person';</script>";
}
?>
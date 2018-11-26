<?php
// View.php
// @brief Una vista corresponde a cada componente visual dentro de un modulo.

class View {
	/**
	* @function load
	* @brief la funcion load carga una vista correspondiente a un modulo
	**/	
	public static function load($view){
		// Module::$module;
		if(!isset($_GET['view'])){
			if(Core::$root==""){
				include "core/app/view/".$view."-view.php";
			}else if(Core::$root=="admin/"){
				include "core/app/".Core::$theme."/view/".$view."-view.php";				
			}
		}else{


			if(View::isValid()){
				$url ="";
			if(Core::$root==""){
			$url = "core/app/view/".$_GET['view']."-view.php";
			}else if(Core::$root=="admin/"){
			$url = "core/app/".Core::$theme."/view/".$_GET['view']."-view.php";				
			}
				include $url;				
			}else{
				View::Error("404 PAGINA NO ENCONTRADA AL INTENTAR MOSTRAR <b>".$_GET['view']."</b> - <a href='mailto:soporte@transpheric.com' target='_blank'>Enviar correo a sistemas</a>");
			}



		}
	}

	/**
	* @function isValid
	* @brief valida la existencia de una vista
	**/	
	public static function isValid(){
		$valid=false;
		if(isset($_GET["view"])){
			$url ="";
			if(Core::$root==""){
			$url = "core/app/view/".$_GET['view']."-view.php";
			}else if(Core::$root=="admin/"){
			$url = "core/app/".Core::$theme."/view/".$_GET['view']."-view.php";				
			}
			if(file_exists($file = $url)){
				$valid = true;
			}
		}
		return $valid;
	}

	public static function Error($message){
		print $message;
	}

}



?>
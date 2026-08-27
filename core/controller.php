<?php 

/**
 * 
 */
class controller
{
	
	public function loadView($viewName, $viewData = array()){
		extract($viewData);
		require 'views/'.$viewName.'.php';
	}

	public function loadTemplate($viewName, $viewData = array()){
		$URL_ATUAL= "$_SERVER[REQUEST_URI]";
		
	
		require 'views/template.php';
	}

	public function loadViewTemplate($viewName, $viewData = array()){
		extract($viewData);
		require 'views/'.$viewName.'.php';
	}
	
}




?>
<?php

/**
 *
 */
class Application {
	
	/**
	 *
	 */
	private $_controller;
	/**
	 *
	 */
	private $_messages;
	/**
	 *
	 */
	private $_errors;
	/**
	 *
	 */
	private $_extraJS;
	/**
	 *
	 */
	private $_extraCSS;

	/**
	 *
	 */
	private static $messageView = VIEW.'error_messages.php';
	/**
	 *
	 */
	private static $menuView    = VIEW.'menu.php';

	/**
	 *
	 */
	public function __construct() {
		// Route URL

		// Init attribus

	}

	/**
	 *
	 */
	public function redirect(Controller $controller) {
		// Redirection
	}

	/**
	 *
	 */
	public function getPageTitle() {
		return $this->_controller->getPageTitle();
	}

	/**
	 *
	 */
	public function displayContent() {
		// Appel cont affiche page

	}

	/**
	 *
	 */
	public function displayMessages() {
		// On vérifie que le controller est instancié
		if($this->_controller !== null){
			//On vérifie qu'il existe des erreurs à afficher
			if(count($this->_errors > 0){
				echo "\t<div id='system-error'><div class='close-button'>x</div>\n";
				//Affichage des erreurs
				foreach ($this->_errors as $error) {
					echo "\t\t<div>$error</div>\n";
				}
				echo "\t</div>\n";
			}

			// Messages
			if(count($this->_messages) > 0){
				echo "\t<div id='system-message'><div class='close-button'>x</div>\n";
				//Affichage des messages
				foreach ($this->_messages as $message) {
					echo "\t\t<div>$message</div>\n";
				}
				echo "\t</div>\n";
			}
			return $this;
		}
		return false;
	}

	/**
	 *
	 */
	public function includeJS(){

	}

	/**
	 *
	 */
	public function includeCSS(){

	}

	/**
	 *
	 */
	public function addErrors(){

	}

	/**
	 *
	 */
	public function addMessages(){

	}


	protected final function addExtraCSS() {

	}

	protected final function addExtraJS() {
		
	}
}

?>
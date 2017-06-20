<?php

class Router {
	
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
	private static $messageView = VIEW.'error_messages.php';
	/**
	 *
	 */
	private static $menuView    = VIEW.'menu.php';

	/**
	 *
	 */
	public function __construct() {
		// Connect DB

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
		// Appel vue pour messages + inclusions meesage / erreur
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

	private function checkUserAccess(){

	}
}

?>
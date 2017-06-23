<?php


/**
 *
 */
abstract class Controller {

	/**
	 *
	 */
	private $_view;
	/**
	 *
	 */
	private $_pageTitle;
	/**
	 *
	 */
	private $_page;
	/**
	 *
	 */
	private $_parameters;
	/**
	 *
	 */
	private $_dataView;
	/**
	 *
	 */
	protected $_app;

	/**
	 *
	 */
	protected $subMenuView = VIEW.'sub_menu.php'; 


	/**
	 *
	 */
	public function __construct(Application $app, $page, array $parameters) {
		$this->_app = $app;
		$this->_page = $page;
		$this->_parameters = $parameters;
	}

	/**
	 *
	 */
	public abstract function default();

	/**
	 *
	 */
	public final function displayContent() {
		// Inclusion du sous menu

		// Inclusion du contenu
		extract($this->_dataView);
		require_once VIEW.$this->_view;
	}

	/**
	 *
	 */
	public final function getPageTitle() {
		return $this->_pageTitle;
	}

	/**
	 *
	 */
	protected final function setPageTitle($title) {
		$this->_pageTitle = $title;
	}

	/**
	 *
	 */
	protected final function setView($view, array $dataView) {
		$this->_view = $view;
		$this->_dataView = $dataView;
	}

}

?>
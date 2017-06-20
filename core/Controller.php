<?php


/**
 *
 */
class Controller {

	/**
	 *
	 */
	private $_router;
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
	private $_subPage;
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
	private $_extraJS;
	/**
	 *
	 */
	private $_extraCSS;

	/**
	 *
	 */
	protected $subMenuView = VIEW.'sub_menu.php'; 


	/**
	 *
	 */
	public function __construct(Router $router, $subPage, array $parameters) {
		$this->_router = $router;
		$this->_subPage = $subPage;
		$this->_parameters = $parameters;
	}

	/**
	 *
	 */
	public abstract function execute();

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

	protected final function addExtraCSS() {

	}

	protected final function addExtraJS() {
		
	}

}

?>
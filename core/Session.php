<?php

class Session {

	private $_id;
	private $_user;
	private $_access;
	private $_accessLevels;

	private static $instance = null;

	/**
	 * Démarre une nouvelle session de naviguation
	 * http://fr.wikihow.com/cr%C3%A9er-un-script-de-connexion-s%C3%A9curis%C3%A9e-avec-PHP-et-MySQL
	 */
	private function __construct(array $accessLevel){

		if(session_status() == PHP_SESSION_NONE){
			session_start();
			session_name('sess_id_'.uniqid());
			$this->_access = -1;
			$this->_user = null;
		}
		else {
			$this->_access = (isset($_SESSION['access'])? $_SESSION['access'] : -1);
			$this->_user = (isset($_SESSION['user'])? $_SESSION['user'] : null);
		}
		$this->_id = session_name();
		$this->_accessLevels = $accessLevel;

		// Force la session à n’utiliser que les cookies
		if (ini_set('session.use_only_cookies', 1) === FALSE) {
		    die("Erreur de session");
		}

		// Récupère les paramètres actuels de cookies
		$cookieParams = session_get_cookie_params();
		session_set_cookie_params($cookieParams["lifetime"],
			$cookieParams["path"], 
			$cookieParams["domain"], 
			true,  // Envoie els cookies sessions qui si connexion secured
			true); // Empêche JavaScript d’accéder à l’id de session
	}

	/**
	 * Enregistre l'utilisateur comme connecté pour cette session.
	 */
	public function connect($user, $accessLevel){
		if(!strlen($user) || !strlen($password) || !in_array($accessLevel, $this->_accessLevels))
			return false;

		$lvl = array_search($accessLevel, $this->_accessLevels);
		$this->_access = $lvl;
		$_SESSION['login_string'] = hash('sha512', $user.$this->_id.$_SERVER['HTTP_USER_AGENT']);
		$_SESSION['user'] = $user;
		$_SESSION['acces_level'] = $lvl;
	}

	/**
	 * Efface toutes les données de session : à utiliser pour se déconnecter.
	 */
	public function destroy(){
		foreach($_SESSION as $champs)
			unset($champs);
		
		session_destroy();
		$this->_id = null;
		$this->_access = -1;
		$this->_user = null;
	}

	/**
	 * Retourne le niveau d'accès de l'utilisateur ou vérifie si l'utilisateur a le niveau
	 * d'accès requis pour accéder au niveau passé en paramètre.
	 */
	public function checkUserAccess($accessLevel=null){
		// Retourne le niveau d'accès de l'utilisateur
		if($accessLevel === null){
			if(isset($this->_accessLevels[$this->_access]))
				return $this->_accessLevels[$this->_access];
			return $this->_access;
		}

		// Retourne true ou false selon si l'utilisateur à le niveau d'accès necessaire
		if(($lvl = array_search($accessLevel, $this->_accessLevels)) !== false);
		else if(is_int($accessLevel) && $accessLevel >= 0 && $accessLevel < count($this->_accessLevels)){
			$lvl = $accessLevel;
		}
		// Erreur de paramètre
		else return null;

		return ($lvl <= $this->_access);
	}

	public function getInfos(){
		return ['id' => $this->_id, 'user' => $this->_user, 'access' => $this->_access];
	}

	public static function instantiate(array $accessLevel){
		if(self::$instance == null)
			self::$instance = new self($accessLevel);

		return self::$instance;
	}

	public static function getInstance(){
		return self::$instance;
	}

	/**
	* Vérifie l'état de connexion de l'utilisateur du site comme expliqué ici :
	* 	 -> http://fr.wikihow.com/cr%C3%A9er-un-script-de-connexion-s%C3%A9curis%C3%A9e-avec-PHP-et-MySQL
	* @return l'id de l'utilisateurs'il est connecté, faux sinon
	*/
	public static function estConnecte() {
	    // Vérifie que toutes les variables de session sont mises en place
	    if (isset($_SESSION['username'],
	              $_SESSION['login_string'])) {
	 
	        $login_string = $_SESSION['login_string'];
	        $username = $_SESSION['username'];
	 
	        // Récupère la chaîne user-agent de l’utilisateur
	        $user_browser = $_SERVER['HTTP_USER_AGENT'];

	 		//Récupéraiton du ot de passe de 'lutilisateur'
	        if ($stmt = Database::$instance->prepare("SELECT id, mdp 
	                                      FROM etudiant 
	                                      WHERE mail = :mail ;")) {
	            $stmt->execute(array(':mail' => $username));   // Exécute la déclaration.
	            $user = $stmt->fetch();
	            //S'il existe un utilisateur...
	            if ($user) {
	                $login_check = hash('sha512', $user['mdp'].$user_browser);
	                //Check du hash
	                if ($login_check == $login_string) {
	                    // Connecté!!!! 
	                    return intval($user['id']);
	                }
	            }
	        }
	    }
	    return false;
	}


	/**
	* Enregistre les données de l'utilisateur dans la session instanciée
	*/
	public static function enregistrerSesssion($mail, $mdp){
		$_SESSION['login_string'] = hash('sha512', $mdp.$_SERVER['HTTP_USER_AGENT']);
		$_SESSION['username'] = $mail;
		$_SESSION['user_id'] = EtudiantMod::getIDFromMail($mail);
	}
}

?>
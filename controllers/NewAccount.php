<?php

class NewAccount extends PageModel {
	protected static $view = "NewAccountView";
	protected static $link = "NewAccount";
	protected static $label = "Créer un compte";
	protected static $maxRole = 0;
	protected static $authRequired = 1;
	protected static $cssFiles = array("NewAccount");

	public static function execute($data) {
		if (static::isAllowed()) {
			$view = new static::$view();
			if(isset($data['form'])) {
				$missing = UserDBO::validateForm($data);
				if(empty($missing)) {
					if(is_null(UserDBO::getByColName("username", $data["username"]))) {
						$data['password'] = md5($data['password']);
						$data['role'] = isset($data['role']) ? 0 : 1;
						$userdb = new UserDBO($data);
						$userdb->insert();
						$view->setMessage("User créé", "positive");
					} else {
						$view->setMessage("Nom d'utilisateur déjà existant", "negative");
					}
				} else {
					$view->setMessage("Un ou plusieurs champs sont manquants", "negative");
					$view->setMissing($missing);
				}
			}
			
			return $view;
		} else {
			return NotAllowed::execute($data);
		}
	}

}
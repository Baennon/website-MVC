<?php
class Header extends PageModel{
	protected static $view = "HeaderView";
	public static function execute($data) {
		$view = new static::$view();
		if(isset($data["action"])) {
			if ($data["action"]=="connect") {
				if(!UserModel::connect($data["username"], $data["password"])) {
					$view->setMessage("Identifiants invalides");
				}
			} else if ($data["action"]=="disconnect") {
				UserModel::disconnect();
			}
		}
		return $view;
	}

}
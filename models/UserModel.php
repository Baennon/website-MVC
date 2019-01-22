<?php
class UserModel {
	public static function getConnectedUser() {
		return $_SESSION['user'];
	}

	public static function isConnected() {
		if(isset($_SESSION['user'])) {
			if($_SESSION["user"] instanceof UserDBO) {
				return true;
			}
		}
		return false;
	}

	public static function crypt($password) {
		return hash('sha256', $password);
	} 

	public static function connect($username, $password) {
		$password = static::crypt($password);
		$user = UserDBO::getByColName("username", $username);
		if ($user == null) return false;
		if ($user[0]->getValues()["password"]==$password) {
			$_SESSION['user'] = $user[0];
			if($user[0]->getValues()['role'] == 0) {
			setcookie('user', $user[0]->getValues()['username'], 0, "/");
			}
			return true;
		}
		return false;
	}

	public static function disconnect() {
		unset($_SESSION['user']);
		setcookie("user", "", time()-3600);
	}
}
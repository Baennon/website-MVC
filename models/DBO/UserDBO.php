<?php
class UserDBO extends DBO {

	protected static $table = "User";
	protected static $id_col = "id";

	protected static $id = "id";
	protected static $username = "username";
	protected static $password = "password";
	protected static $role = "role";
	protected static $mail = "mail";
	protected static $isenUsr = "isen_usr";
	protected static $isenPwd = "isen_pwd";
	protected static $date = "date";

	function __construct($data) {
		parent::__construct($data);
	}

	public static function propertyKeyList() {
		return array(new PropertyKey(static::$id,PropertyKey::$OPTIONNAL),
					 new PropertyKey(static::$username,PropertyKey::$MANDATORY),
					 new PropertyKey(static::$password,PropertyKey::$MANDATORY),
					 new PropertyKey(static::$role,PropertyKey::$OPTIONNAL),
					 new PropertyKey(static::$mail,PropertyKey::$OPTIONNAL),
					 new PropertyKey(static::$isenUsr,PropertyKey::$OPTIONNAL),
					 new PropertyKey(static::$isenPwd,PropertyKey::$OPTIONNAL),
					 new PropertyKey(static::$date, PropertyKey::$OPTIONNAL));
	}
}
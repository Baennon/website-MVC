<?php
class DBO {
	protected static $table;
	protected static $id_col;
	protected $values;

	function __construct($data) {
		foreach ($data as $key => $value) {
			if (in_array($key, static::propertyNameList())) {
				$this->values[$key] = $value;
			}
		}
	}

	public static function propertyNameList() {
		$properties = static::propertyKeyList();
		$names = array();
		foreach ($properties as $value) {
			$names[] = $value->getKey();
		}
		return $names;
	}

	public static function propertyKeyList() {
		return array();
	}

	public function getValues() {
		return $this->values;
	}

	public function setValue($key, $value) {
		$this->values[$key] = $value;
	}

	public static function getById($id) {
		$res = DB::getDB()->query("SELECT * FROM " . static::$table . " WHERE " . static::$id_col . " = " . $id);
		$res->setFetchMode(PDO::FETCH_OBJ);
		$class = static::class;
		return new $class($res->fetch());
	}

	public static function getByColName($colName, $value, $order=null, $asc=null) {
		$orderBy = "";
		if (!is_null($order)) {
			$orderBy = " ORDER BY " . $order . " " . $asc;
		}
		$res = DB::getDB()->query("SELECT * FROM " . static::$table . " WHERE " . $colName . " = '" . $value . "'" . $orderBy);
		$res->setFetchMode(PDO::FETCH_OBJ);
		$class = static::class;
		$nbOfRes = $res->rowCount();
		if ($nbOfRes=="0") {
			return null;
		} else {
			$resArray = array();
			foreach ($res->fetchAll() as $value) {
				array_push($resArray, new $class($value));
			}
			return $resArray;
		}
	}

	public function insert() {
		$colStr = "(";
		$colArray = array();
		$valuesStr = "(";
		$valuesArray = array();
		foreach ($this->values as $key => $value) {
			if($value != "") {
				array_push($colArray, $key);
				array_push($valuesArray, DB::getDB()->quote($value));
			}
		}
		$colStr.= join(",",$colArray) . ")";
		$valuesStr.= join(", ",$valuesArray) . ")";
		$res = DB::getDB()->exec("INSERT INTO " . static::$table . $colStr . " VALUES " . $valuesStr);				
		return DB::getDB()->lastInsertId();
	}

	public function patch() {
		$valuesArray = array();
		$valuesStr = "";
		foreach ($this->values as $key => $value) {
			if($key!="id") {
				$valuesArray[] = $key . "=" .  DB::getDB()->quote($value);
			}
		}
		$valuesStr.= join(", ",$valuesArray);
		var_dump($valuesStr);
		$res = DB::getDB()->exec("UPDATE " . static::$table . " SET " . $valuesStr . " WHERE id='".$this->values['id']."'");
	}

	public function remove() {
		$res = DB::getDB()->exec("DELETE FROM " . static::$table . " WHERE id='".$this->values['id']."'");
	}

	public static function validateForm($data) {
		$properties = static::propertyKeyList();
		$missing = array();
		foreach ($properties as $value) {
			if ($value->getOption() == PropertyKey::$MANDATORY) {
				if($data[$value->getKey()]==null) {
					array_push($missing, $value);
				}
			}
		}
		return $missing;
	}

}
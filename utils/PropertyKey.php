<?php
class PropertyKey {
	public static $OPTIONNAL = "OPTIONNAL";
	public static $MANDATORY = "MANDATORY";
	protected $key;
	protected $option;

	function __construct($key, $option) {
		$this->key = $key;
		$this->option = $option;
	}

	public function getKey() {
		return $this->key;
	}

	public function getOption() {
		return $this->option;
	}
}
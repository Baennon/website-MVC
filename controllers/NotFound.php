<?php
class NotFound extends PageModel{
	protected static $view = "NotFoundView";
	protected static $cssFiles = array("NotFoundView");

	public static function execute($data) {
		$view = new static::$view($data['page']);
		return $view;
	}
}
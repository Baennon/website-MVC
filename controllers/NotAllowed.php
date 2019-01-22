<?php
class NotAllowed extends PageModel{
	protected static $view = "NotAllowedView";
	public static function execute($data) {
		$view = new static::$view($data['page']);
		return $view;
	}
}
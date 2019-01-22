<?php
class PageModel {
	protected static $view = null;
	protected static $link = null;
	protected static $label = null;
	protected static $maxRole = 1;
	protected static $jsFiles = array();
    protected static $cssFiles = array();
    protected static $authRequired = 0;

	public static function getView() {
		return static::$view;
	}

	public static function getLink() {
		return static::$link;
	}

    public static function getCssFiles()
    {
        return static::$cssFiles;
    }

    public static function getJsFiles()
    {
        return static::$jsFiles;
    }

	public static function getLabel() {
		return static::$label;
	}

	public static function getMaxRole() {
		return static::$maxRole;
	}

	public static function execute($data) {
		if (static::isAllowed()) {
			$view = new static::$view();
			return $view;
		} else {
			return NotAllowed::execute($data);
		}
	}

	public static function isAllowed() {
		if (static::$authRequired) {
			if (UserModel::isConnected()) {
				if(intval(UserModel::getConnectedUser()->getValues()["role"]) <= static::$maxRole) {
					return true;
				}
			}
			return false;
		} else {
			return true;
		}
	}
}
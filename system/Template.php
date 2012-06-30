<?php namespace pangolin;

require_once("lib/smarty/Smarty.class.php");
require_once("smartyPlugins.php");

class Template
{
	private static $smarty = null;

	private $vars = array();

	public function __construct()
	{
		if (self::$smarty == null) self::$smarty = new \Smarty();
		self::$smarty->addTemplateDir(array(ROOT . "/templates/"));

		self::$smarty->registerPlugin("modifier","pluralize", "smarty_modifier_pluralize");

		// Pangolin variables.
		global $projectname;
		$pangolinVars = array(
			"url" => $_SERVER['REQUEST_URI'],
			"projectname" => $projectname
		);

		$this->assign("pangolin", $pangolinVars);

		self::$smarty->debugging = TRUE;
	}

	public function assign($key, $var)
	{
		$this->vars[$key] = $var;
	}
	
	public function render($name)
	{
		foreach ($this->vars as $key => $value)
		{
			self::$smarty->assign($key, $value);
		}

		$html = self::$smarty->fetch($name.".tpl");
		echo($html);
	}

	public function renderForceApp($name)
	{
		foreach ($this->vars as $key => $value)
		{
			self::$smarty->assign($key, $value);
		}

		$html = self::$smarty->fetch("file:[app]".$name.".tpl");
		echo($html);	
	}

	public static function addTemplateDir($string)
	{
		if (self::$smarty == null) self::$smarty = new \Smarty();
		self::$smarty->addTemplateDir($string, "app");
	}
}
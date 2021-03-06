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
		self::$smarty->registerPlugin("modifier", "shrink", "smarty_modifier_shrink");

		// Pangolin variables.
		global $projectname;
		$pangolinVars = array(
			"url" => $_SERVER['REQUEST_URI'],
			"projectname" => $projectname
		);

		$this->assign("pangolin", $pangolinVars);

		self::$smarty->debugging = TRUE;
		self::$smarty->debug_tpl = "system/debugger/template.tpl";
		self::$smarty->registerPlugin("function", "getqueries", "smarty_function_getqueries");
		//self::$smarty->force_compile = TRUE;
	}

	public function assign($key, $var)
	{
		$this->vars[$key] = $var;
	}

	public static function assignGlobal($key, $var)
	{
		if (self::$smarty == null) self::$smarty = new \Smarty();
		self::$smarty->assign($key, $var);
	}
	
	public function render($name)
	{
		foreach ($this->vars as $key => $value)
		{
			self::$smarty->assign($key, $value);
		}

		//$html = self::$smarty->fetch($name.".tpl");
		//echo($html);
		self::$smarty->display($name.".tpl");
	}

	public function renderForceApp($name)
	{
		foreach ($this->vars as $key => $value)
		{
			self::$smarty->assign($key, $value);
		}

		self::$smarty->display("file:[app]".$name.".tpl");
	}

	public static function addTemplateDir($string)
	{
		if (self::$smarty == null) self::$smarty = new \Smarty();
		self::$smarty->addTemplateDir($string, "app");
	}
}
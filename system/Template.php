<?php namespace pangolin;

require_once("lib/smarty/Smarty.class.php");

class Template
{
	private static $smarty = null;

	private $vars = array();

	public function __construct()
	{
		if (self::$smarty == null) self::$smarty = new \Smarty();
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

		self::$smarty->display(ROOT."/templates/".$name.".tpl");
	}
}
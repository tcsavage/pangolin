<?php namespace pangolin;

class TemplateTag
{
	private $raw;
	private $name;
	private $param = null;
	private $content = array();
	private $startpos;
	
	public static $tagtypes = array("test"=> array("selfclosing" => false), "block" => array("selfclosing" => False), "extends" => array("selfclosing" => True));
	
	public function __construct($match, $startpos)
	{
		$this->raw = $match[0];
		$this->name = $match[2];
		$this->param = ($match[4]) ? $match[4] : null;
		$this->content = $match[5];
		$this->startpos = $startpos;
		print_r($this);
	}
	
	private static function isValidTag($name)
	{
		if (isset(self::$tagtypes[$name]) || self::isEndTag($name))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	private static function isEndTag($name)
	{
		return preg_match("~^end.+$~", $name) != 0 && isset(self::$tagtypes[substr($name,3)]);
	}
	
	private static function isSelfClosingTag($name)
	{
		return self::$tagtypes[$name]["selfclosing"];
	}
	
	public static function getTagType($tag)
	{
		if (!self::isValidTag($tag)) return null;
		elseif (self::isEndTag($tag)) return "end";
		elseif (self::isSelfClosingTag($tag)) return "selfclosing";
		else return "normal";
	}
}
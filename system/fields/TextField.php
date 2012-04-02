<?php namespace pangolin;

class TextField extends Field
{
	private $maxlength = 200;
	
	public function __construct($options, $value)
	{
		parent::__construct($options, $value);
		if (isset($options["maxlength"])) $this->maxlength = $options["maxlength"];
	}
	
	public function setValue($value)
	{
		if (strlen($value) > $this->maxlength)
		{
			return;
		}
		parent::setValue($value);
	}

	public function SQLType()
	{
		return "VARCHAR";
	}

	public function renderSQLDef()
	{
		$elems = array();
		$elems[] = $this->name;
		$elems[] = SQLType() . '(' . $this->maxlength . ')';
		if (!$this->nullable) $elems[] = 'NOT NULL';
		if ($this->autoincrement) $elems[] = 'AUTO_INCREMENT';
		if ($this->primarykey) $elems[] = ', PRIMARY KEY(' . $this->name . ')';
		return implode(' ', $elems);
	}
}

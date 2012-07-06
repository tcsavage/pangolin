<?php namespace pangolin;

/*
Field that represents an instance of another model.
Represented in the database as a foreign key.
*/
class ForeignField extends Field
{
	private $model = "";
	
	public function __construct($options, $value = null)
	{
		parent::__construct($options, $value);
		if (isset($options["model"])) $this->model = $options["model"];
	}

	public function setValue($value)
	{
		// TODO: protect datatype?
		parent::setValue($value);
	}

	public function renderInput($attributes = null)
	{
		$model = $this->model;
		$fks = $model::getAll();

		$out = '<select id="'.$this->name.'" name="'.$this->name.'"';
		if ($attributes)
		{
			$attrstrings = array();
			foreach ($attributes as $key => $value)
			{
				$attrstrings[] = "$key=\"$value\"";
			}
			$out .= implode(" ", $attrstrings);
		}
		$out .= '>';
		foreach ($fks as $fk)
		{
			$out .= '<option value="'.$fk->id.'">'.$fk.'</option>';
		}
		$out .= '</select>';
		return $out;
	}

	// Returns type for SQL representation.
	public function SQLType()
	{
		return "INT";
	}

	// Generates full SQL definition for defining a column.
	public function renderSQLDef()
	{
		$elems = array();
		$elems[] = $this->name;
		$elems[] = $this->SQLType();
		$elems[] = ($this->nullable) ? 'DEFAULT NULL' : 'NOT NULL';
		return implode(' ', $elems);
	}

	// Return the foreign model class name.
	public function getModel()
	{
		return $this->model;
	}
}
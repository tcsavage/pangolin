<?php namespace pangolin;

/**
 * A file upload field.
 * Specify the subdirectory to upload to, valid file types and optionally a processing function.
 * 
 * When file is originally uploaded, we will pass the entire $_FILE['name'] in here. The class will then take care of moving the file into the correct directory.
 * @package pangolin
 */
class FileField extends Field
{
	/** Mime types accepted by the field. Accepts everything by default. */
	private $types = null;

	/** Maximum size (bytes) of file accepted by the field. */
	private $maxsize = 20000;

	public static $allImageTypes = array("image/png", "image/jpeg", "image/pjpeg", "image/gif");

	/** Default constructor. */
	public function __construct($options, $value)
	{
		// Set base attributes.
		parent::__construct($options, $value);

		if (isset($options["types"])) $this->types = $options["types"];
		if (isset($options["maxsize"])) $this->maxsize = $options["maxsize"];
	}

	/** Takes an array ($_FILE) for data input, or the name of a file in the system. */
	public function setValue($value)
	{
		if ($this->validate($value))
		{
			if (is_array($value))
			{
				$ext = array_pop(explode(".", $value['name']));
				$newname = uniqid('', true) . "." . $ext;
				$newpath = ROOT . "/upload/" . $newname;
				move_uploaded_file($value["tmp_name"], $newpath);
				parent::setValue($newname);
			}
			else
			{
				parent::setValue($value);
			}
		}
		else
		{
			throw new \Exception("File validation filed", 1);
			
		}
	}

	/**
	 * Validate the file.
	 * @param mixed $value Value to check.
	 * @return bool
	 */
	public function validate($value)
	{
		if ($value === "") return true;

		if (is_array($value))
		{
			if (!in_array($value['type'], $this->types))
			{
				return false;
			}
			elseif ($value['size'] > $this->maxsize)
			{
				return false;
			}
			else
			{
				return true;
			}
		}
		else // Is a file ref
		{
			return file_exists(ROOT . "/upload/" . $value);
		}
	}

	// Renders HTML form control.
	public function renderInput($attributes = null)
	{
		$out = '<input type="file" id="'.$this->name.'" name="'.$this->name.'"';

		if ($attributes)
		{
			$attrstrings = array();
			foreach ($attributes as $key => $value)
			{
				$attrstrings[] = "$key=\"$value\"";
			}
			$out .= implode(" ", $attrstrings);
		}
		$out .= '/>';

		return $out;
	}

	// Returns type for SQL representation.
	public function SQLType()
	{
		return "VARCHAR";
	}

	// Generates full SQL definition for defining a column.
	public function renderSQLDef()
	{
		$elems = array();
		$elems[] = $this->name;
		$elems[] = $this->SQLType() . '(256)';
		$elems[] = ($this->nullable) ? 'DEFAULT NULL' : 'NOT NULL';
		return implode(' ', $elems);
	}
}
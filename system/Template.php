<?php namespace pangolin;

class Template
{
	private $path;
	private $source;
	
	private $tags = array();
	
	public function __construct($path)
	{
		// Save the template source and path.
		$this->source = self::load($path);
		$this->path = $path;
		
		// Find all things that look like tags.
		preg_match_all("~\{\%(([a-zA-Z0-9]+)(\(([a-zA-Z0-9]+)\))?)\%\}~", $this->source, $matches, PREG_SET_ORDER);
		
		// Search for the starting points for all tag-like things.
		$searchoffset = 0;
		$tagoffsets = array();
		foreach ($matches as $match)
		{
			$offset = strpos($this->source, $match[0], $searchoffset);
			$searchoffset = $offset + strlen($match[0]);
			$tagoffsets[] = $offset;
		}
		
		// Build an array of tags with their vital info for parsing.
		$tags = array();
		for ($i = 0; $i < count($matches); $i=$i+1)
		{
			$tag = array("name" => $matches[$i][2], "param" => (isset($matches[$i][4])) ? $matches[$i][4] : null, "offset" => $tagoffsets[$i], "size" => strlen($matches[$i][0]));
			$tags[] = $tag;
		}
		
		// For each tag...
		foreach ($tags as $index => $tag)
		{
			echo("Tag: ".$tag['name']."\n");
			// Find out what kind of tag it is...
			switch (TemplateTag::getTagType($tag["name"]))
			{
				case null:
					die("Invalid tag '".$tag["name"]."' found in ".$this->path.".");
					break;
				case "end":
					continue 2;
					break;
				case "selfclosing":
					// Do thing.
					break;
				default:
					// Find tag's closing counterpart.
					$neststack = array();
					for ($i = $index+1; $i < count($tags); $i++)
					{
						if ($tags[$i]["name"] == "end".$tag["name"] && count($neststack) == 0)
						{
							$tags[$index]["endtag"] = $i;
							break;
						}
						elseif ($tags[$i]["name"] == "end".end($neststack) && count($neststack) > 0)
						{
							array_pop($neststack);
						}
						else
						{
							$neststack[] = $tags[$i]["name"];
						}
					}
			}
		}
		
		print_r($tags);
	}
	
	public static function load($path)
	{
		$content = file_get_contents($path);
		return $content;
	}
}
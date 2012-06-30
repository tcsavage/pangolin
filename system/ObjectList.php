<?php namespace pangolin;

// Class for containing model objects. Acts like an array but does some extra stuff in the background.
class ObjectList implements \arrayaccess, \Iterator
{
	public $objects = array();

	public function size()
	{
		return count($this->objects);
	}
	
	public function offsetExists($i)
	{
		return isset($this->objects[$i]);
	}
	
	public function offsetGet($i)
	{
		return isset($this->objects[$i]) ? $this->objects[$i] : null;
	}
	
	public function offsetSet($i, $v)
	{
		if (is_null($i))
		{
			$this->objects[] = $v;
		}
		else
		{
			$this->objects[$i] = $v;
		}
	}
	
	public function offsetUnset($i)
	{
		unset($this->objects[$i]);
	}
	
	public function rewind()
	{
		reset($this->objects);
	}
	
	public function current()
	{
		$var = current($this->objects);
		return $var;
	}
	
	public function key() 
	{
		$var = key($this->objects);
		return $var;
	}
	
	public function next() 
	{
		$var = next($this->objects);
		return $var;
	}
	
	public function valid()
	{
		$key = key($this->objects);
		$var = ($key !== NULL && $key !== FALSE);
		return $var;
	}
}
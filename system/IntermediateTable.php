<?php namespace pangolin;

class IntermediateTable
{
	private $name;

	private $fields = array();

	/**
	 * Factory method to create a linking table for an array field.
	 * @param Class $baseModel 
	 * @param Class $fieldType
	 * @param String $fieldName 
	 * @return IntermediateTable
	 */
	public static function createArray($baseModel, $fieldType, $fieldName)
	{
		$tbl = new IntermediateTable;
		$tbl->name = $baseModel::tableName()."_".$fieldName;
	}
}

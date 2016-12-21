<?php

class DocumentModel extends Model
{

	function selectFromDocument()
	{
		$context = Context::getInstance();
		$tableName = $context->getTable('document');
		$category = $context->getParameter('category');

		$where = new QueryWhere();
		$where->set('category',$category,'=');

		$query = new Query();
		$query->setField('*');
		$query->setTable($tableName);
		$query->setWhere($where);

		$result = parent::select($query);
		return $result;
	}
}
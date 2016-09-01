<?php

class QuestionModel extends BaseModel {

	var $class_name = 'question_model';

	function init() {
		
	}

	function selectFieldFromQuestionc($field) {

		$context = Context::getInstance();

		$query = new Query();
		$query->setField($field);
		$query->setTable($context->get('db_questionc'));

		$result = parent::select($query);
		return $result;
	}
}
?>
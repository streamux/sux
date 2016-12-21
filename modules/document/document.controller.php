<?php

class DocumentController extends Controller
{

	var $class_name = 'document_controller';

	function __construct($m=NULL) {
		
		$this->model = $m;
	}
}
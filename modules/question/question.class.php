<?php
class Question
{
	/**
	 * @var  categories, action
	 * They're value is used as a route uri of get method and a name of class's method
	 */
	public static function getRoute($key) {

		$file = _SUX_PATH_ . 'caches/question.cache.php';
		$tempList = preg_split('/\//', $file);
		$fileName = $tempList[count($tempList)-1];
		if (file_exists($file)) {
			include($file);
			$result = ${$key};
			unset(${$key});
		} else {
			printf("[ %s ] Cache File don't exist<br>", $fileName);
		}
		
		return $result;
	}
}
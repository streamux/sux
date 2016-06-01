<?

function trim($string, $num){

	$cut_string = $string; 
	$cut = $num;
	if (strlen($string) > $cut AND $cut != "0"){ 
		for($i=0; $i<$cut-1; $i++){ 
			if (ord(substr($cut_string, $i, 1))>127) {
				$i++; 
			}
		}
		$cut_string = sprintf("%s", substr($cut_string, 0, $i)."..."); 
	}else{
		$cut_string = $string;
	}
	return $cut_string;
}

?>
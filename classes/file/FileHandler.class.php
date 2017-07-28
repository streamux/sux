<?php
class FileHandler
{
	function getRealPath($source)
	{
		if(strlen($source) >= 2 && substr_compare($source, './', 0, 2) === 0) {
			return _SUX_PATH_ . substr($source, 2);
		}

		return $source;
	}

	function readFile($filename) {

		if(file_exists($filename) == false || filesize($filename) < 1) {
			return;
		}
		return @file_get_contents($filename);
	}

	function writeFile($path, $buff, $mode="w", $is_safe=true) {

		$filename = self::getRealPath($path);
		$pathinfo = pathinfo($filename);
		self::makeDir($pathinfo['dirname'], $is_safe);

		$fiags = 0;
		if (strtolower($mode) == 'a') {
			$flags = FILE_APPEND;
		}

		$result = @file_put_contents($filename, $buff, $flags|LOCK_EX);
		@chmod($filename, 0644);

		return $result;
	}

	function deleteFile($path) {

		$dirPath = self::getRealPath($path);
		if (!is_file( $dirPath )) {
			return false;
		}

		$result = @unLink($path);

		return $result;
	}

	function hasContent($path) {

		$filename = self::getRealPath($path);
		return (is_readable($filename) && (filesize($filename) > 0));
	}

	function exists($path) {

		$filename = self::getRealPath($path);
		return file_exists($filename) ? $filename : false;
	}

	function readDir( $path ) {

		$dirPath = self::getRealPath($path);
		if (!is_dir($dirPath)) {
			return false;
		}

		$temArr = array();
		if ($handle = opendir($dirPath)) { 
			while (false !== ($file = readdir($handle))) { 
				if ($file != "." && $file != "..") {
					array_push($temArr, array("file_name"=>$file));				
				} 
			} 
			closedir($handle); 
			return $temArr;
		}	
			
		return false;
	}

	function makeDir($path, $is_safe=true)
	{
		$dirPath = self::getRealPath($path);

		if (file_exists($dirPath) != false) {
			return true;
		}

		if (!$is_safe) {
			@mkdir($dirPath, 0755, true);
			@chmod($dirPath, 0755);
		} else {
			$ftp_server = '127.0.0.1';
			$ftp_port = 21;
			$ftp_user = 'root';
			$ftp_pass = 'root';
			$conn_id = ftp_connect($ftp_server, $ftp_port) or die("Couldn't connect to $ftp_server"); 

			if (@ftp_login($conn_id, $ftp_user, $ftp_pass)) {
				$msg .= "Connected as $ftp_user@$ftp_server\n";
			} else {
				$msg .= "Couldn't connect as $ftp_user\n";
			}

			if (ftp_chmod($conn_id, 0777, _SUX_PATH_ . $dirPath) !== false) {
				$msg .= "$dirPath chmoded successfully to 644\n";
			} else {
				$msg .= $dirPath . " could not chmod $dirPath\n";
			}
			ftp_close($conn_id); 
		}

		return $dirPath;
	}

	function deleteAll($directory, $empty = false) { 

		if (substr($directory,-1) == "/") { 
			$directory = substr($directory,0,-1); 
		} 

		$directory = self::getRealPath($directory);

		if (!file_exists($directory) || !is_dir($directory)) { 
			return false; 
		} elseif (!is_readable($directory)) { 
			return false; 
		} else { 
			$directoryHandle = opendir($directory); 
			
			while ($contents = readdir($directoryHandle)) { 
				if($contents != '.' && $contents != '..') { 
					$path = $directory . "/" . $contents; 
					
					if(is_dir($path)) { 
						deleteAll($path); 
					} else { 
						unlink($path); 
					} 
				} 
			} 
			
			closedir($directoryHandle); 

			if ($empty == false) { 
				if (!rmdir($directory)) { 
					return false; 
				} 
			} 
			
			return true; 
		} 
	} 
}
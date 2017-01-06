<?php
class FileHandler
{
	function getRealPath($source)
	{
		if(strlen($source) >= 2 && substr_compare($source, './', 0, 2) === 0)
		{
			return _SUX_PATH_ . substr($source, 2);
		}

		return $source;
	}

	function makeDir($path)
	{
		$dirPath = self::getRealPath($path);
		if (!is_dir($dirPath)) {

			$isSafe = false;
			if (!$isSafe)
			{
				@mkdir($dirPath, 0755, TRUE);
				@chmod($dirPath, 0755);
			}
			else
			{
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
					$msg .= _SUX_PATH_ . $dirPath . " could not chmod $dirPath\n";
				}
				ftp_close($conn_id); 
			}			
		}

		return $dirPath;
	}
}
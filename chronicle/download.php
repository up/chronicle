<?php

include("chronicle.class.php");

if ($_GET["filename"]) {
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://api.hostip.info/get_html.php?ip=" . $_SERVER['REMOTE_ADDR']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$geoString = curl_exec($ch);
		$geoStringParts = preg_split('/[:]+/', $geoString);
		$country = trim(substr($geoStringParts[1], 0, -4));    
		curl_close($ch); 
	
		$filename = $_GET["filename"];	
		$file = fopen(LOG_FOLDER_NAME . '/' . COUNTER_FILE_NAME, "r+") or die('Could not open counter log file!');
		$num = fgets($file, 10);
		$num++;
		rewind($file);
		fwrite($file,$num);
		fclose($file);
		
		$file = fopen(LOG_FOLDER_NAME . '/' . INFO_FILE_NAME, "a+") or die('Could not open info log file!');
		fwrite($file, date("Y-m-d", time()) . " - " . $filename . " - " . $country . " - " . $_SERVER['REMOTE_ADDR'] . PHP_EOL);
		fclose($file);

		echo $country;    

		ob_start();
		header("location: ../" . DOWNLOAD_FOLDER_NAME ."/". $filename);
		//header( "refresh:5;url=../' . DOWNLOAD_FOLDER_NAME . '/' . $filename .'" );
  		//echo 'You will be redirected in about 5 secs. If not, click <a href="../"' . DOWNLOAD_FOLDER_NAME . '/' . $filename .'">here</a>.';

		//header("location: 2.html"); //replaces 1.html
		ob_end_flush(); //now the headers are sent
		
	}

?>
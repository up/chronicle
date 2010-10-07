<?php

/** 
  * DownloadLogger (PHP5)
  * copyright (c) 2010, Uli Preuss 
  * contact: me at ulipreuss dot eu
*/

/*
error_reporting(E_ALL ^ E_STRICT);
ini_set('display_errors', 1);
*/

define('BASE_PATH',realpath('.'));
define('BASE_URL', dirname($_SERVER["SCRIPT_NAME"]));
define('SCRIPT_FOLDER_NAME', basename(dirname(__FILE__)));

define('LOG_FOLDER_NAME', 'logs');
define('DOWNLOAD_FOLDER_NAME', 'downloads');
define('COUNTER_FILE_NAME', 'download-counter.txt');
define('INFO_FILE_NAME', 'download-infos.txt');
define('DOWNLOADER_PATH', SCRIPT_FOLDER_NAME . '/download.php');

date_default_timezone_set('Europe/Berlin');
define('TIME_FORMAT', 'd.m.Y H:i');


class DownloadLogger {
    
	function __construct() { 
		
		global $numberOfDownloads, $fileList, $latest;
		
		$numberOfDownloads = $this->getNumberOfDownloads();
		$fileList = $this->createFileListArray(DOWNLOAD_FOLDER_NAME);
		$this->sortArrayByDate($fileList);
		$latest = $fileList[0][0];

    }

	private static function createFileListArray() {
	
		$dir = DOWNLOAD_FOLDER_NAME . '/';
	    $fileArray = array();

	    $fh = opendir($dir);
	    if (!$fh) $fh = opendir("../".$dir);
	    if (!$fh) die('Cannot list files for ' . $dir);

	    while ($file = readdir($fh)) {
	        if ($file == '.' || $file == '..' || $file == '.DS_Store') continue;
	        $lastMod = filemtime($dir . $file);
	        $fileArray[] = array($file, $lastMod);
	    }

	    return $fileArray;
	
	}

	public function createVersionHistory() {
		
		$fileList = $this->createFileListArray(DOWNLOAD_FOLDER_NAME);
		rsort($fileList);
		
		echo '<table class="dl-file">';
		
		
		for ($i=0; $i < count($fileList); $i++) {
			
			$linetype = ($i & 1) ? 'odd' : 'even';
			
			echo '   <tr class="dl-file-' . $linetype . '">';
			echo '      <td class="dl-file-version">';
			echo '         <a href="' . DOWNLOADER_PATH . '?filename=' . $fileList[$i][0] . '">' . $fileList[$i][0] . '</a>';
			echo '      </td>';
			echo '      <td class="dl-file-date">';
			echo '         ' . date(TIME_FORMAT, $fileList[$i][1]);
			echo '      </td>';
			echo '   </tr>';
		}
	    echo '</table>';
			
	}
	
	private static function dateComparison($a, $b) {
		
	    return ($a[1] < $b[1]) ? -1:0;
	
	}
	
	private static function sortArrayByDate(&$fileArray) {
	
	    usort($fileArray, array('DownloadLogger', 'dateComparison'));
		
	}

	private static function getNumberOfDownloads() {
	
		$datei = fopen(SCRIPT_FOLDER_NAME . '/' . LOG_FOLDER_NAME . '/' . COUNTER_FILE_NAME, "r+");
		$numberOfDownloads = fgets($datei);
		fclose($datei);	
		return $numberOfDownloads;				
	
	}
	
}

?>
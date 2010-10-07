<?php

$lines = 0;
$filename = 'chronicle/logs/download-infos.txt';
$defaultContent = <<< eof
DATE - FILE - COUNTY  - IP
____________________________________
2010-09-18 - mashi-0.9.3.zip - UNITED STATES (US) - 12.215.42.19
2010-09-18 - mashi-0.9.3.zip - GERMANY (DE) - 87.122.152.143

eof;


if ($fh = fopen($filename, 'r')) {
  while (!feof($fh)) {
    if (fgets($fh)) {
      $lines++;
    }
  }
}
fclose($fh);

if($lines >= 5) {
	if (is_writable($filename)) {

	    if (!$fh = fopen($filename, "w")) {
	         echo "Kann die Datei $filename nicht öffnen";
	         exit;
	    }

	    if (!fwrite($fh, $defaultContent)) {
	        echo "Kann in die Datei $filename nicht schreiben";
	        exit;
	    }

	    print "Fertig!";

	    fclose($fh);

	} 
	else {
	    print "Die Datei $filename ist nicht schreibbar";
	}
}


?>

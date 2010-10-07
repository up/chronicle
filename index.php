<?php 
	include('chronicle/chronicle.class.php'); 
	$DL = new DownloadLogger();
?>
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

  <title>Chronicle - php download logger</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />

	<script type="text/javascript" src="assets/javascripts/highlight.js"></script>
	<script type="text/javascript" src="assets/javascripts/highlight.pack.js"></script>
	<script type="text/javascript">
	hljs.tabReplace = '    ';
	hljs.initHighlightingOnLoad();	
	</script>

	<link type="text/css" rel="stylesheet" href="assets/stylesheets/page.css" />
	<link type="text/css" rel="stylesheet" href="assets/stylesheets/highlight.css" />

</head>
<body>
<div id="wrapper">
<h1>
	chronicle
	<span>PHP download logger</span>
</h1>

<h6>
	You want to know, how many people download your software?
	Chronicle provides a simple download logging mechanisms. 
</h6>

<div id="navigation">
	<a href="#Usage">Usage</a>
	<a href="#Examples">Examples</a>
	<a href="#Configuration">Configuration</a>
	<a href="#Logfile">Log file</a>
	<a href="<?php echo DOWNLOADER_PATH; ?>?filename=<?php echo $latest; ?>">Download</a>
</div>

<h3 class="noborder">At a glance</h3>

<ul>
	<li>Easy integration and configuration.</li>
	<li>Supports multiple downloads on multiple pages.</li>
	<li>Usage with form buttons and links.</li>
	<li>Logging of IP and country of the user, the timestamp and the name of the downloaded file.</li>
	<li>Flat database (text file): No SQL database required. </li>
	<li>PHP Version: PHP 5.0.0 or newer.</li>
</ul>

<h3>
	<a name="Usage"></a>
	Usage: Including and instantiation
</h3>

<h5>Code:</h5>
<pre><code>&lt;?php
  include('chronicle/chronicle.class.php'); 
  $DL = new DownloadLogger();
?&gt;
</code></pre>

<h3>
	<a name="Examples"></a>
	Example: display number of downloads
</h3>

<h5>Code:</h5>
<pre><code>&lt;h4&gt;Downloads: &lt;?php echo $numberOfDownloads; ?&gt;&lt;/h4&gt;
</code></pre>

<h5>Result:</h5>
<h4>Downloads: <?php echo $numberOfDownloads; ?></h4>

<h3>Example: display all Downloads</h3>

<h5>Code:</h5>
<pre><code>&lt;?php $DL->createVersionHistory(); ?&gt;
</code></pre>

<h5>CSS:</h5>
<pre><code>table.dl-file {
  background-color: #1d1f21;
  border: 5px solid #333738;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  padding: 12px;
}
tr.dl-file-odd {
  background-color: transparent;
}
tr.dl-file-even {
  background-color: #000;
}
td.dl-file-version {
  padding-right: 10px;
}
</code></pre>

<h5>Result:</h5>
<?php $DL->createVersionHistory(); ?>

<h3>Example: download button for the latest version</h3>

<h5>Code:</h5>
<pre><code>&lt;form action="&lt;?php echo DOWNLOADER_PATH; ?&gt;" method="get"&gt;
  &lt;input type="submit" value="Download Latest Version" /&gt;
  &lt;input name="filename" type="hidden" value="&lt;?php echo $latest; ?&gt;" /&gt;
&lt;/form&gt;
</code></pre>

<h5>Result:</h5>
<form action="<?php echo DOWNLOADER_PATH; ?>" method="get">
	<fieldset>
		<input type="submit" value="Download Latest Version" />
		<input name="filename" type="hidden" value="<?php echo $latest; ?>" />
	</fieldset>
</form>

<h3>Example: download button for a specific version</h3>

<h5>Code:</h5>
<pre><code>&lt;form action="&lt;?php echo DOWNLOADER_PATH; ?&gt;" method="get"&gt;
  &lt;input type="submit" value="Download Version 0.8.2" /&gt;
  &lt;input name="filename" type="hidden" value="cronicle-0.8.2.zip" /&gt;
&lt;/form&gt;
</code></pre>

<h5>Result:</h5>
<form action="<?php echo DOWNLOADER_PATH; ?>" method="get">
	<fieldset>
		<input type="submit" value="Download Version 0.8.2" />
		<input name="filename" type="hidden" value="cronicle-0.8.2.zip" />
	</fieldset>
</form>

<h3>Example: download link for the latest version</h3>

<h5>Code:</h5>
<pre><code>&lt;a href="&lt;?php echo DOWNLOADER_PATH; ?&gt;?filename=&lt;?php echo $latest; ?&gt;"&gt;
  Download Latest Version
&lt;/a&gt;
</code></pre>

<h5>Result:</h5>
<a href="<?php echo DOWNLOADER_PATH; ?>?filename=<?php echo $latest; ?>">Download Latest Version</a>

<h3>Example: download link for a specific version</h3>

<h5>Code:</h5>
<pre><code>&lt;a href="&lt;?php echo DOWNLOADER_PATH; ?&gt;?filename=cronicle-0.8.4.zip"&gt;
  Download Version 0.8.4
&lt;/a&gt;
</code></pre>

<h5>Result:</h5>
<a href="<?php echo DOWNLOADER_PATH; ?>?filename=cronicle-0.8.4.zip">Download Version 0.8.4</a>


<h3>
	<a name="Configuration"></a>
	Configuration (chronicle/chronicle.class.php)
</h3>

<h5>Code:</h5>
<pre><code>&lt;?php
  date_default_timezone_set('Europe/Berlin');
  define('TIME_FORMAT', 'd.m.Y H:i');

  define('LOG_FOLDER_NAME', 'logs');
  define('DOWNLOAD_FOLDER_NAME', 'downloads');
  define('COUNTER_FILE_NAME', 'download-counter.txt');
  define('INFO_FILE_NAME', 'download-infos.txt');
?&gt;
</code></pre>

<h3>
	<a name="Logfile"></a>
	Log file: <a href="chronicle/logs/download-infos.txt">download-infos.txt</a>
</h3>

<pre><code><?php readfile('chronicle/logs/download-infos.txt') ?>
</code></pre>


<div id="footer">
	<a href="http://ulipreuss.eu">2010 &copy; Uli Preuss</a>
</div>
</div>

</body>
</html>
<?php
define('TOPFILE', $_SERVER['VIRTUALHOST_DOCUMENT_ROOT'] . "/siteautoload.php");
if(file_exists(TOPFILE)) {
  include(TOPFILE);
} else throw new Exception(TOPFILE . "not found");

new Blp; // count page
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="License" />
   <meta name="Author"
      content="Barton L. Phillips, mailto:barton@bartonphillips.org"/>
   <meta name="description"
      content="Name: Barton Phillips, Page: License"/>
		<title>License - rssfeed.pl<title>
</head>
<body>
<h1>rssfeed.pl is released under the MIT and GPL Licenses</h1>
   <p><a href="GPL-LICENSE.txt">GPL-LICENSE.txt</a></p>
   <p><a href="MIT-LICENSE.txt">MIT-LICENSE.txt</a></p>
</body>
</html>


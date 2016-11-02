<?php

if($arg['title'] == "Web Statistics") {
  $specialStyle = <<<EOF
  <style>
html {
  font-size: 25px;
}
body {
  padding: 1rem;
}
  </style>
EOF;
}

return <<<EOF
<head>
  <title>{$arg['title']}</title>
  <!-- METAs -->
  <meta name=viewport content="width=device-width, initial-scale=1">
  <meta charset='utf-8'>
  <meta name="copyright" content="$this->copyright">
  <meta name="Author"
    content="$this->author">
  <meta name="description"
    content="{$arg['desc']}">
  <!-- ICONS, RSS -->
  <link rel="shortcut icon" href="favicon.ico">
  <!-- Custom CSS -->
{$arg['link']}
  <!-- jQuery -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script>
var lastId = $this->LAST_ID;
var LocalPath = '/weewx';
  </script>
  <script async src="/blp/js/tracker.js"></script>
  </style>
{$arg['extra']}
{$arg['script']}
$specialStyle
{$arg['css']}
</head>
EOF;

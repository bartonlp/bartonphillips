<?php
  
return <<<EOF
<header>
<img id="logo" src="http://bartonphillips.net/images/blank.png">
<img id="dummyimg" src="/weewx/tracker.php?page=normal&id=$this->LAST_ID">
<noscript>
<p style='color: red; background-color: #FFE4E1; padding: 10px'>
<img src="/weewx/tracker.php?page=noscript&id=$this->LAST_ID">
Your browser either does not support <b>JavaScripts</b> or you have JavaScripts disabled, in either case your browsing
experience will be significantly impaired. If your browser supports JavaScripts but you have it disabled consider enabaling
JavaScripts conditionally if your browser supports that. Sorry for the inconvienence.</p>
</noscript>
$mainTitle
</header>
EOF;

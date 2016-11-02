<?php
return <<<EOF
<style>
footer {
  text-align: center;
  margin-bottom: 1rem;
}
</style>

<footer>
<h2><a target="_blank" href='aboutwebsite.php'>About This Site</a></h2>
<address>
  Copyright &copy; $this->copyright<br>
Barton Phillips, 828 Cayo Grande Ct. Newbury Park CA 91320<br>
<a
 href='mailto:bartonphillips@gmail.com'>bartonphillips@gmail.com
</a>
</address>
<h3><a href="/weewx/webstats-new.php">Webstats</a></h3>
{$arg['msg']}
{$arg['msg1']}
$counterWigget
{$arg['msg2']}
</footer>
</body>
</html>
EOF;

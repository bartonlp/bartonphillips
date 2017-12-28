<?php
// Example of 'import' in JavaScript
$_site = require_once(getenv("SITELOADNAME"));
$S = new $_site->className($_site);

$h->title = "Demo of import";
$h->script =<<<EOF
  <script>
function DoIt(e, link) {
  console.log("e:", e);
}

jQuery(document).ready(function($) {
  function supportsImports() {
    return 'import' in document.createElement('link');
  }

  if(supportsImports()) {
    var link = document.createElement('link');
    link.rel = 'import';
    link.href = 'import-file2.html';
    //link.setAttribute('async', ''); // make it async!
    link.onload = function(e) {DoIt(e, link)};
    link.onerror = function(e) {
      console.log("ERROR: ", e);
    }

    document.head.appendChild(link);
  } else {
    alert("No Support for 'imports'");
    return;
  }
});
  </script>
EOF;

list($top, $footer) = $S->getPageTopBottom($h);

echo <<<EOF
$top
<h1>Stuff</h1>
  <div id="container"></div>
  <my-timer></my-timer>
$footer
EOF;

            

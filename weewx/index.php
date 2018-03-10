<?php
$_site = require_once(getenv("SITELOADNAME"));
$S = new SiteClass($_site);
$h->link = <<<EOF
  <link rel="stylesheet" href="weewx.css">
EOF;
$h->css =<<<EOF
  <style>
header {
  margin-left: 1%;
}
.green {
  color: green;
}
.red {
  color: red;
}
  </style>
EOF;

$h->script = <<<EOF
  <script src='https://bartonphillips.net/js/phpdate.js'></script>
  <script src='https://bartonphillips.net/js/sprintf.js'></script>
  <script>
jQuery(document).ready(function($) {
  var next = 345 - (parseInt(date("i") % 5) * 60 + parseInt(date('s')));
  var timer;
  var loadit = true;

  function timerStart() {
    timer = setInterval(function() {
      var t = date("H:i:s"); // from phpdate.js
      //console.log(t);

      --next;

      if(loadit && next == 0) {
        document.location.href = 'https://www.bartonphillips.com/weewx/';
      }
      $("#time").html("The Time is: <span class='green'>" + 
                       t + "</span>" +
                       "<br>Next Reading in <span class='red'>" +
                       sprintf("%02d:%02d", next/60, next % 60) + "</span>");
    }, 1000);
  };

  window.stopLoad = function() {
    loadit = false;
  };

  window.stopTimer = function() {
    clearInterval(timer);
  };
  window.startTimer = timerStart;

  timerStart();
});

function openURL(urlname) {
  window.location=urlname;
}
function openNoaaFile(date) {
  var url = "NOAA/NOAA-";
  url = url + date;
  url = url + ".html";
  window.location=url;
}
  </script>
EOF;


list($top, $footer) = $S->getPageTopBottom($h);

echo <<<EOF
$top
<div id="container">
  <div id="masthead">
    <h1>2701 Amhurst Blvd. New Bern, North Carolina</h1>
    <h2>Current Weather Conditions</h2>
    <h2>Current: Saturday March 10, 2018 17:35<br>
      <span id='time'></span></h2>
  </div>

  <div id="stats_group">
    <div class="stats">
      <div class="stats_header">Current Conditions</div>
      <table>
        <tbody>
          <tr>
            <td class="stats_label">Outside Temperature</td>
            <td class="stats_data">60.2&#176;F</td>
          </tr>
          <tr>
            <td class="stats_label">Wind Chill</td>
            <td class="stats_data">60.3&#176;F</td>
          </tr>
          <tr>
            <td class="stats_label">Heat Index</td>
            <td class="stats_data">60.3&#176;F</td>
          </tr>
          <tr>
            <td class="stats_label">Dewpoint</td>
            <td class="stats_data">39.7&#176;F</td>
          </tr>
          <tr>
            <td class="stats_label">Humidity</td>
            <td class="stats_data">47%</td>
          </tr>
          <tr>
            <td class="stats_label">Barometer</td>
            <td class="stats_data">29.965 inHg</td>
          </tr>
          <tr>
            <td class="stats_label">Barometer Trend (3 hours)</td>
            <td class="stats_data">0.023 inHg</td>
          </tr>
          <tr>
            <td class="stats_label">Wind</td>
            <td class="stats_data">0 mph from 96&#176; (E)</td>
          </tr>
          <tr>
            <td class="stats_label">Rain Rate</td>
            <td class="stats_data">0.00 in/hr</td>
          </tr>
          <tr>
            <td class="stats_label">Inside Temperature</td>
            <td class="stats_data">74.2&#176;F</td>
          </tr>
        </tbody>
      </table>
    </div>
    <p>&nbsp;</p>
    <div class="stats">
      <div class="stats_header">Since Midnight</div>
      <table>
        <tbody>
          <tr>
            <td class="stats_label">
              High Temperature<br/>
              Low Temperature
            </td>
            <td class="stats_data">
              69.5&#176;F at 14:52:20<br/>
              33.6&#176;F at 05:18:40
            </td>
          </tr>
          <tr>
            <td class="stats_label">
              High Heat Index<br/>
              Low Wind Chill
            </td>
            <td class="stats_data">
              69.5&#176;F at 14:52:20<br/>
              33.6&#176;F at 05:18:40
            </td>
          </tr>
          <tr>
            <td class="stats_label">
              High Humidity<br/>
              Low Humidity
            </td>
            <td class="stats_data">
              89% at 06:12:58<br/>
              25% at 14:29:58
            </td>
          </tr>
          <tr>
            <td class="stats_label">
              High Dewpoint<br/>
              Low Dewpoint
            </td>
            <td class="stats_data">
              40.1&#176;F at 17:31:58<br/>
              29.0&#176;F at 00:00:02
            </td>
          </tr>
          <tr>
            <td class="stats_label">
              High Barometer<br/>
              Low Barometer
            </td>
            <td class="stats_data">
              30.089 inHg at 08:30:58<br/>
              29.930 inHg at 14:41:58
            </td>
          </tr>
          <tr>
            <td class="stats_label">Today's Rain</td>
            <td class="stats_data">0.00 in</td>
          </tr>
          <tr>
            <td class="stats_label">High Rain Rate</td>
            <td class="stats_data">0.00 in/hr at 00:00:02</td>
          </tr>
          <tr>
            <td class="stats_label">
              High Wind
            </td>
            <td class="stats_data">
              13 mph from 245&#176; at 13:54:16
            </td>
          </tr>
          <tr>
            <td class="stats_label">
              Average Wind
            </td>
            <td class="stats_data">
              1 mph
            </td>
          </tr>
          <tr>
            <td class="stats_label">
              RMS Wind
            </td>
            <td class="stats_data">
              1 mph
            </td>
          </tr>
          <tr>
            <td class="stats_label">
              Vector Average Speed<br/>
              Vector Average Direction
            </td>
            <td class="stats_data">
              1 mph<br/>
              281&#176;
            </td>
          </tr>
          <tr>
            <td class="stats_label">
              High Inside Temperature<br/>
              Low Inside Temperature
            </td>
            <td class="stats_data">
              74.2&#176;F at 15:00:56<br/>
              68.6&#176;F at 04:45:56
            </td>
          </tr>
          </tbody>
        </table>
      </div> <!--End class "stats" -->
      <p>&nbsp;</p>
  </div> <!--End class "stats_group" -->
  <div id="content">
    <div id="about">
      <div class="header">
      <a href="https://www.bartonphillips.com/aboutweewx.php">About this Weather Station</a>
      </div>
      <table>
        <caption class="caption">Location</caption>
        <tr>
          <td class="label">Latitude:</td>
          <td class="data">35&deg; 06.66' N</td>
        </tr>
        <tr>
          <td class="label">Longitude:</td>
          <td class="data">077&deg; 05.57' W</td>
        </tr>
        <tr>
          <td class="label">Altitude:</td>
          <td class="data">26 feet</td>
        </tr>
      </table>
      <p>
        This station has a Davis VantageVue, controlled by
        <a href="http://www.weewx.com">'weewx'</a>, a
        weather software system written in Python. Weewx
        was designed to be simple, fast, and easy to understand by
        leveraging modern software concepts.
      </p>
      <p><a href="smartphone/index.html">Smartphone formatted</a></p>
      <p>Weewx uptime:  49 days, 0 hours, 4 minutes<br/>
         Server uptime: 49 days, 0 hours, 12 minutes<br/>
         weewx v3.7</p>
    </div> <!-- End id "about" -->
    <div id="almanac">
      <div class="header">
        Today's Almanac
      </div>
      <div class="celestial_group">
        <div class="celestial_body">
          <table>
            <caption class="caption">Sun</caption>
            <tr>
              <td class="label">Start civil twilight:</td>
              <td class="data">05:59:54</td>
            </tr>
            <tr>
              <td class="label">Sunrise:</td>
              <td class="data">06:25:37</td>
            </tr>
            <tr>
              <td class="label">Transit:</td>
              <td class="data">12:18:34</td>
            </tr>
            <tr>
              <td class="label">Sunset:</td>
              <td class="data">18:12:04</td>
            </tr>
            <tr>
              <td class="label">End civil twilight:</td>
              <td class="data">18:37:48</td>
            </tr>
            <tr>
              <td class="label">Azimuth:</td>
              <td class="data">260.5&deg;</td>
            </tr>
            <tr>
              <td class="label">Altitude:</td>
              <td class="data">6.8&deg;</td>
            </tr>
            <tr>
              <td class="label">Right ascension:</td>
              <td class="data">351.1&deg;</td>
            </tr>
            <tr>
              <td class="label">Declination:</td>
              <td class="data">-3.8&deg;</td>
            </tr>
            <tr>
              <td class="label">Equinox:</td>
              <td class="data">03/20/18 12:15:17</td>
            </tr>
            <tr>
              <td class="label">Solstice:</td>
              <td class="data">06/21/18 06:07:23</td>
            </tr>
          </table>
        </div> <!-- end class "celestial_body" -->
        <div class="celestial_body">
          <table>
            <caption class="caption">Moon</caption>  
            <tr>
              <td class="label">Rise:</td>
              <td class="data">01:48:49</td>
            </tr>
            <tr>
              <td class="label">Transit:</td>
              <td class="data">07:00:24</td>
            </tr>
            <tr>
              <td class="label">Set:</td>
              <td class="data">12:10:58</td>
            </tr>
            <tr>
              <td class="label">Azimuth:</td>
              <td class="data">295.9&deg;</td>
            </tr>
            <tr>
              <td class="label">Altitude:</td>
              <td class="data">-62.7&deg;</td>
            </tr>
            <tr>
              <td class="label">Right ascension:</td>
              <td class="data">276.3&deg;</td>
            </tr>
            <tr>
              <td class="label">Declination:</td>
              <td class="data">-20.3&deg;</td>
            </tr>
            <tr>
              <td class="label">New moon:</td>
              <td class="data">03/17/18 09:11:34</td>
            </tr>
            <tr>
              <td class="label">Full moon:</td>
              <td class="data">03/31/18 08:36:51</td>
            </tr>
            <tr>
              <td class="label">Phase:</td>
              <td class="data">Last quarter<br/>(36% full)</td>
            </tr>
          </table>
        </div> <!-- end class "celestial_body" -->
      </div> <!-- end class "celestial_group" -->
    </div> <!-- end id "almanac" -->
    <div id="plots">
      <img src="daytempdew.png"   alt="temperatures" />
      <img src="dayinside.png"    alt="Inside" />
      <!--<img src="daytempchill.png" alt="heatchill" />-->
      <img src="daywind.png"      alt="wind" />
      <img src="daywinddir.png"   alt="Hi Wind" />
      <img src="daywindvec.png"   alt="Wind Vector" />
      <img src="daybarometer.png" alt="barometer"/>


      <img src="dayrx.png"        alt="day rx percent"/>
    </div> <!-- End id "plots" -->
  </div> <!-- End id "content" -->
  <div id="navbar">
    <input type="button" value="   Current   " onclick="openURL('index.php')" />
    <input type="button" value="    Week     " onclick="openURL('week.php')" />
    <input type="button" value="    Month    " onclick="openURL('month.php')" />
    <input type="button" value="    Year     " onclick="openURL('year.php')" />
    <!-- New BLP 2017-01-28 -->
    <input type="button" value=" Daily Table " onclick="openURL('daily.php')" />
    <p>Monthly summary:&nbsp;
    <select NAME=noaaselect onchange="openNoaaFile(value)">
      <option value="2017-05">2017-05</option>
      <option value="2017-06">2017-06</option>
      <option value="2017-07">2017-07</option>
      <option value="2017-08">2017-08</option>
      <option value="2017-09">2017-09</option>
      <option value="2017-10">2017-10</option>
      <option value="2017-11">2017-11</option>
      <option value="2017-12">2017-12</option>
      <option value="2018-01">2018-01</option>
      <option value="2018-02">2018-02</option>
      <option value="2018-03">2018-03</option>
      <option selected>-Select month-</option>
    </select>
    <br/>
    Yearly summary:&nbsp;
    <select NAME=noaaselect onchange="openNoaaFile(value)">
      <option value="2017">2017</option>
      <option value="2018">2018</option>
      <option selected>-Select year-</option>
    </select>
    </p>
  </div>
</div>
$footer
EOF;


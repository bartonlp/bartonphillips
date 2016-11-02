<?php
$_site = require_once(getenv("SITELOAD") ."/siteload.php");
$S = new $_site->className($_site);
$h->link = <<<EOF
  <link rel="stylesheet" href="weewx.css">
EOF;

$h->script = <<<EOF
  <script>
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
    <h1>828 Cayo Grande Ct., Newbury Park, CA</h1>
    <h2>Current Weather Conditions</h2>
    <h2>Wednesday November  2 2016, 14:10</h2>
    </div>
    <div id="stats_group">
      <div class="stats">
        <div class="stats_header">Current Conditions</div>
        <table>
          <tbody>
            <tr>
              <td class="stats_label">Outside Temperature</td>
              <td class="stats_data">78.1&#176;F</td>
            </tr>
            <tr>
              <td class="stats_label">Wind Chill</td>
              <td class="stats_data">78.1&#176;F</td>
            </tr>
            <tr>
              <td class="stats_label">Heat Index</td>
              <td class="stats_data">78.1&#176;F</td>
            </tr>
            <tr>
              <td class="stats_label">Dewpoint</td>
              <td class="stats_data">35.0&#176;F</td>
            </tr>
            <tr>
              <td class="stats_label">Humidity</td>
              <td class="stats_data">21%</td>
            </tr>
            <tr>
              <td class="stats_label">Barometer</td>
              <td class="stats_data">30.055 inHg</td>
            </tr>
            <tr>
              <td class="stats_label">Barometer Trend (3 hours)</td>
              <td class="stats_data">-0.057 inHg</td>
            </tr>
            <tr>
              <td class="stats_label">Wind</td>
              <td class="stats_data">7 mph from 0&#176; (N)</td>
            </tr>
            <tr>
              <td class="stats_label">Rain Rate</td>
              <td class="stats_data">0.00 in/hr</td>
            </tr>
            <tr>
              <td class="stats_label">Inside Temperature</td>
              <td class="stats_data">72.0&#176;F</td>
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
                78.1&#176;F at 14:09<br/>
                45.1&#176;F at 04:14
              </td>
            </tr>
            <tr>
              <td class="stats_label">
                High Heat Index<br/>
                Low Wind Chill
              </td>
              <td class="stats_data">
                78.1&#176;F at 14:09<br/>
                45.1&#176;F at 04:14
              </td>
            </tr>
            <tr>
              <td class="stats_label">
                High Humidity<br/>
                Low Humidity
              </td>
              <td class="stats_data">
                99% at 06:33<br/>
                19% at 13:35
              </td>
            </tr>
            <tr>
              <td class="stats_label">
                High Dewpoint<br/>
                Low Dewpoint
              </td>
              <td class="stats_data">
                48.7&#176;F at 06:54<br/>
                31.8&#176;F at 13:39
              </td>
            </tr>
            <tr>
              <td class="stats_label">
                High Barometer<br/>
                Low Barometer
              </td>
              <td class="stats_data">
                30.141 inHg at 09:09<br/>
                30.053 inHg at 14:10
              </td>
            </tr>
            <tr>
              <td class="stats_label">Today's Rain</td>
              <td class="stats_data">0.01 in</td>
            </tr>
            <tr>
              <td class="stats_label">High Rain Rate</td>
              <td class="stats_data">0.00 in/hr at 00:00</td>
            </tr>
            <tr>
              <td class="stats_label">
                High Wind
              </td>
              <td class="stats_data">
                25 mph from 72&#176; at 13:47
              </td>
            </tr>
            <tr>
              <td class="stats_label">
                Average Wind
              </td>
              <td class="stats_data">
                4 mph
              </td>
            </tr>
            <tr>
              <td class="stats_label">
                RMS Wind
              </td>
              <td class="stats_data">
                6 mph
              </td>
            </tr>
            <tr>
              <td class="stats_label">
                Vector Average Speed<br/>
                Vector Average Direction
              </td>
              <td class="stats_data">
                7 mph<br/>
                55&#176;
              </td>
            </tr>
            <tr>
              <td class="stats_label">
                High Inside Temperature<br/>
                Low Inside Temperature
              </td>
              <td class="stats_data">
                72.1&#176;F at 14:09<br/>
                60.7&#176;F at 07:33
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
          <a href="http://www.bartonphillips.com/aboutweewx.php">About this Weather Station</a>
          </div>
          <table>
            <caption class="caption">Location</caption>
            <tr>
              <td class="label">Latitude:</td>
              <td class="data">34&deg; 11.46' N</td>
            </tr>
            <tr>
              <td class="label">Longitude:</td>
              <td class="data">118&deg; 57.38' W</td>
            </tr>
            <tr>
              <td class="label">Altitude:</td>
              <td class="data">719 feet</td>
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
          <p>Weewx uptime:  17 days, 3 hours, 38 minutes<br/>
             Server uptime: 130 days, 3 hours, 1 minute<br/>
             weewx v3.1.0</p>
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
                  <td class="data">06:49</td>
                </tr>
                <tr>
                  <td class="label">Sunrise:</td>
                  <td class="data">07:16</td>
                </tr>
                <tr>
                  <td class="label">Transit:</td>
                  <td class="data">12:39</td>
                </tr>
                <tr>
                  <td class="label">Sunset:</td>
                  <td class="data">18:01</td>
                </tr>
                <tr>
                  <td class="label">End civil twilight:</td>
                  <td class="data">18:29</td>
                </tr>
                <tr>
                  <td class="label">Azimuth:</td>
                  <td class="data">207.4&deg;</td>
                </tr>
                <tr>
                  <td class="label">Altitude:</td>
                  <td class="data">36.2&deg;</td>
                </tr>
                <tr>
                  <td class="label">Right ascension:</td>
                  <td class="data">218.5&deg;</td>
                </tr>
                <tr>
                  <td class="label">Declination:</td>
                  <td class="data">-15.1&deg;</td>
                </tr>
                <tr>
                  <td class="label">Solstice:</td>
                  <td class="data">Dec 21, 2016 02:44</td>
                </tr>
                <tr>
                  <td class="label">Equinox:</td>
                  <td class="data">Mar 20, 2017 03:28</td>
                </tr>
              </table>
            </div> <!-- end class "celestial_body" -->
            <div class="celestial_body">
              <table>
                <caption class="caption">Moon</caption>  
                <tr>
                  <td class="label">Rise:</td>
                  <td class="data">09:43</td>
                </tr>
                <tr>
                  <td class="label">Transit:</td>
                  <td class="data">15:04</td>
                </tr>
                <tr>
                  <td class="label">Set:</td>
                  <td class="data">20:23</td>
                </tr>
                <tr>
                  <td class="label">Azimuth:</td>
                  <td class="data">164.1&deg;</td>
                </tr>
                <tr>
                  <td class="label">Altitude:</td>
                  <td class="data">36.0&deg;</td>
                </tr>
                <tr>
                  <td class="label">Right ascension:</td>
                  <td class="data">254.6&deg;</td>
                </tr>
                <tr>
                  <td class="label">Declination:</td>
                  <td class="data">-18.3&deg;</td>
                </tr>
                <tr>
                  <td class="label">Full moon:</td>
                  <td class="data">Nov 14, 2016 05:52</td>
                </tr>
                <tr>
                  <td class="label">New moon:</td>
                  <td class="data">Nov 29, 2016 04:18</td>
                </tr>
                <tr>
                  <td class="label">Phase:</td>
                  <td class="data">Waxing crescent<br/>(9% full)</td>
                </tr>
              </table>
            </div> <!-- end class "celestial_body" -->
          </div> <!-- end class "celestial_group" -->
        </div> <!-- end id "almanac" -->
        <div id="plots">
          <img src="daytempdew.png"   alt="temperatures" />
          <img src="daytempchill.png" alt="heatchill" />
          <img src="dayrain.png"      alt="rain" />
          <img src="daywind.png"      alt="wind" />
          <img src="daybarometer.png" alt="barometer"/>
          <img src="daywinddir.png"   alt="Hi Wind" />
          <img src="dayinside.png"    alt="Inside" />
          <img src="daywindvec.png"   alt="Wind Vector" />
          <img src="dayrx.png"        alt="day rx percent"/>
        </div> <!-- End id "plots" -->
      </div> <!-- End id "content" -->
      <div id="navbar">
        <input type="button" value="   Current   " onclick="openURL('index.php')" />
        <input type="button" value="    Week     " onclick="openURL('week.php')" />
        <input type="button" value="    Month    " onclick="openURL('month.php')" />
        <input type="button" value="    Year     " onclick="openURL('year.php')" />
        <p>Monthly summary:&nbsp;
        <select NAME=noaaselect onchange="openNoaaFile(value)">
          <option value="2012-09">2012-09</option>
          <option value="2012-10">2012-10</option>
          <option value="2012-11">2012-11</option>
          <option value="2012-12">2012-12</option>
          <option value="2013-01">2013-01</option>
          <option value="2013-02">2013-02</option>
          <option value="2013-03">2013-03</option>
          <option value="2013-04">2013-04</option>
          <option value="2013-05">2013-05</option>
          <option value="2013-06">2013-06</option>
          <option value="2013-07">2013-07</option>
          <option value="2013-08">2013-08</option>
          <option value="2013-09">2013-09</option>
          <option value="2013-10">2013-10</option>
          <option value="2013-11">2013-11</option>
          <option value="2013-12">2013-12</option>
          <option value="2014-01">2014-01</option>
          <option value="2014-02">2014-02</option>
          <option value="2014-03">2014-03</option>
          <option value="2014-04">2014-04</option>
          <option value="2014-05">2014-05</option>
          <option value="2014-06">2014-06</option>
          <option value="2014-07">2014-07</option>
          <option value="2014-08">2014-08</option>
          <option value="2014-09">2014-09</option>
          <option value="2014-10">2014-10</option>
          <option value="2014-11">2014-11</option>
          <option value="2014-12">2014-12</option>
          <option value="2015-01">2015-01</option>
          <option value="2015-02">2015-02</option>
          <option value="2015-03">2015-03</option>
          <option value="2015-04">2015-04</option>
          <option value="2015-05">2015-05</option>
          <option value="2015-06">2015-06</option>
          <option value="2015-07">2015-07</option>
          <option value="2015-08">2015-08</option>
          <option value="2015-09">2015-09</option>
          <option value="2015-10">2015-10</option>
          <option value="2015-11">2015-11</option>
          <option value="2015-12">2015-12</option>
          <option value="2016-01">2016-01</option>
          <option value="2016-02">2016-02</option>
          <option value="2016-03">2016-03</option>
          <option value="2016-04">2016-04</option>
          <option value="2016-05">2016-05</option>
          <option value="2016-06">2016-06</option>
          <option value="2016-07">2016-07</option>
          <option value="2016-08">2016-08</option>
          <option value="2016-09">2016-09</option>
          <option value="2016-10">2016-10</option>
          <option value="2016-11">2016-11</option>
          <option selected>-Select month-</option>
        </select>
        <br/>
        Yearly summary:&nbsp;
        <select NAME=noaaselect onchange="openNoaaFile(value)">
          <option value="2012">2012</option>
          <option value="2013">2013</option>
          <option value="2014">2014</option>
          <option value="2015">2015</option>
          <option value="2016">2016</option>
          <option selected>-Select year-</option>
        </select>
        </p>
      </div>
    </div>
$footer
EOF;


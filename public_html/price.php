<?php
// Include the library
require('simple_html_dom.php');

// Retrieve the DOM from a given URL
$html = file_get_html('http://www.kitco.com/mobile/');

// Extract all text from a given cell
$gold["bid"] = $html->find('td[align="center"]', 4)->plaintext.'<br><hr>'; 
$gold["ask"] = $html->find('td[align="center"]', 5)->plaintext.'<br><hr>'; 
$gold["change"] = $html->find('td[align="center"]', 7)->plaintext.'<br><hr>'; 
$silver["bid"] = $html->find('td[align="center"]', 9)->plaintext.'<br><hr>'; 
$silver["ask"] = $html->find('td[align="center"]', 10)->plaintext.'<br><hr>';
$silver["change"] = $html->find('td[align="center"]', 12)->plaintext.'<br><hr>'; 
$platinum["bid"] = $html->find('td[align="center"]', 14)->plaintext.'<br><hr>'; 
$platinum["ask"] = $html->find('td[align="center"]', 15)->plaintext.'<br><hr>'; 
$platinum["change"] = $html->find('td[align="center"]', 17)->plaintext.'<br><hr>';
$palladium["bid"] = $html->find('td[align="center"]', 19)->plaintext.'<br><hr>'; 
$palladium["ask"] = $html->find('td[align="center"]', 20)->plaintext.'<br><hr>';
$palladium["change"] = $html->find('td[align="center"]', 22)->plaintext.'<br><hr>';
$rhodium["bid"] = $html->find('td[align="center"]', 24)->plaintext.'<br><hr>'; 
$rhodium["ask"] = $html->find('td[align="center"]', 25)->plaintext.'<br><hr>';  
$rhodium["change"] = $html->find('td[align="center"]', 27)->plaintext.'<br><hr>';

/*
//To prove it works.
var_dump($gold); 
var_dump($silver); 
var_dump($platinum); 
var_dump($palladium); 
var_dump($rhodium);
*/
?>

<style>
 table {
     border-collapse: collapse;
 }
 table, td, th {
     border: 1px solid black;
 }
</style>

<table>
<thead>
 <tr>
  <th>Element</th>
  <th>Bid</th>
  <th>Ask</th>
  <th>Change</th>
 </tr>
</thead>
<tbody>
 <tr>
  <td>Gold</td>
  <td><?php echo(number_format($gold["bid"],2,".","")); ?></td>
  <td><?php echo(number_format($gold["ask"],2,".","")); ?></td>
  <td><?php echo(number_format($gold["change"],2,".","")); ?></td>
 </tr>
 <tr>
  <td>Silver</td>
  <td><?php echo(number_format($silver["bid"],2,".","")); ?></td>
  <td><?php echo(number_format($silver["ask"],2,".","")); ?></td>
  <td><?php echo(number_format($silver["change"],2,".","")); ?></td>
 </tr>
 <tr>
  <td>Platinum</td>
  <td><?php echo(number_format($platinum["bid"],2,".","")); ?></td>
  <td><?php echo(number_format($platinum["ask"],2,".","")); ?></td>
  <td><?php echo(number_format($platinum["change"],2,".","")); ?></td>
 </tr>
 <tr>
  <td>Palladium</td>
  <td><?php echo(number_format($palladium["bid"],2,".","")); ?></td>
  <td><?php echo(number_format($palladium["ask"],2,".","")); ?></td>
  <td><?php echo(number_format($palladium["change"],2,".","")); ?></td>
 </tr>
 <tr>
  <td>Rhodium</td>
  <td><?php echo(number_format($rhodium["bid"],2,".","")); ?></td>
  <td><?php echo(number_format($rhodium["ask"],2,".","")); ?></td>
  <td><?php echo(number_format($rhodium["change"],2,".","")); ?></td>
 </tr>
</tbody> 
</table>

<br>
Gold/Silver Ratio (GSR): <?php echo(number_format(($gold["bid"]/$silver["bid"]),2,".",",")); ?>



 <br>
 <img src="http://www.kitco.com/images/live/silver.gif">




<br>
<br>

<?php $silverprice=$silver["bid"]; ?>


<table>
<thead>
<tr>
<th>Size</th>
<th>#</th>
<th>Note</th>
</tr>
</thead>
<tbody>
<tr>
 <td>Silver Fat Man</td>
 <td>$<?php echo(number_format(($silverprice*3624.74),2,".",",")); ?></td>
 <td>Fat Adult Male = 248.5536 lbs = 3,624.74 troy ounces</td>
</tr>

<tr>
 <td>Silver Man</td>
 <td>$<?php echo(number_format(($silverprice*2668.75),2,".",",")); ?></td>
 <td>Average Adult Male = 183lbs = 2,668.75 troy ounces</td>
</tr>
<tr>
 <td>Silver Kilogram</td>
 <td>$<?php echo(number_format(($silverprice*32.1507466),2,".",",")); ?></td>
 <td>1 Kilogram = 32.1507466  troy ounces</td>
</tr>
<tr>
 <td>Silver Pound</td>
 <td>$<?php echo(number_format(($silverprice*14.5833333),2,".",",")); ?></td>
 <td>1 pound = 14.5833333 troy ounces</td>
</tr>
<tr>
 <td>Silver Ounce</td>
 <td>$<?php echo(number_format(($silverprice*1),2,".",",")); ?></td>
 <td>1 Troy Ounce</td>
</tr>
 <td>Silver Gram</td>
 <td>$<?php echo(number_format(($silverprice/31.1034768),2,".",",")); ?></td>
 <td>31.1034768 = 1 troy ounce</td>
</tr>
<tr>
 <td>Silver Grain</td>
 <td>$<?php echo(number_format(($silverprice/480),2,".",",")); ?></td>
 <td>480 grain = 1 troy ounce</td>
</tr>





<tr>
 <td>$1 FV 90% Silver Coins (0.715ozt)</td>
 <td>$<?php echo(number_format(($silverprice*.0715),2,".",",")); ?></td>
 <td></td>
</tr>
<tr>
 <td>10ozt Silver Bar</td>
 <td>$<?php echo(number_format(($silverprice*10),2,".",",")); ?></td>
 <td></td>
</tr>
<tr>
 <td>Tube of Silver Eagles (20ozt)</td>
 <td>$<?php echo(number_format(($silverprice*20),2,".",",")); ?></td>
 <td></td>
</tr>
<tr>
 <td>100oz Silver Bar</td>
 <td>$<?php echo(number_format(($silverprice*100),2,".",",")); ?></td>
 <td></td>
</tr>
<tr>
 <td>Moster Box Silver Eagles (500oz)</td>
 <td>$<?php echo(number_format(($silverprice*500),2,".",",")); ?></td>
 <td></td>
</tr>
<tr>
 <td>$1,000 FV 90% Silver Coins (715ozt)</td>
 <td>$<?php echo(number_format(($silverprice*715),2,".",",")); ?></td>
 <td></td>
</tr>
<tr>
 <td>COMEX 1000oz Good Delivery Silver Bar</td>
 <td>$<?php echo(number_format(($silverprice*1000),2,".",",")); ?></td>
 <td></td>
</tr>


</tbody>
</table>

 
 <br>
$1 Face Value, New (0.723 ozt): <?php echo(number_format(($silverprice*.723),2,".",",")); ?>x
 <br>
$1 Face Value, Worn (0.715 ozt): <?php echo(number_format(($silverprice*.715),2,".",",")); ?>x
 <br>
$1 Face Value, Morgan/Peace (0.7734 ozt): <?php echo(number_format(($silverprice*.7734),2,".",",")); ?>x
  <br>
  Constitutional Dollar = 371.25 grains of pure silver (0.7734375 troy ounce)<br><br>

 
 <table>
 <thead>
  <tr>
   <td>Type</td>
   <td>Value</td>
   <td>ASW*</td>
   <td>Note</td>
  </tr>
 </thead>
 
 <tbody>



  <tr>
  <td>Jefferson War Nickle (1942-1945)</td>
  <td>$<?php echo(number_format(($silverprice*.0563),2,".",",")); ?></td>
  <td>0.0723 ozt</td>
  <td>56% Copper, 35% Silver, 9% Manganese</td>
 </tr>

  <tr>
  <td>Barber Dime (1892-1916)</td>
  <td>$<?php echo(number_format(($silverprice*.0723),2,".",",")); ?></td>
  <td>0.0723 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(10*.0723)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Mercury Dime (1916-1945)</td>
  <td>$<?php echo(number_format(($silverprice*.0723),2,".",",")); ?></td>
  <td>0.0723 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(10*.0723)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Roosevelt Dime (1946-1964)</td>
  <td>$<?php echo(number_format(($silverprice*.0723),2,".",",")); ?></td>
  <td>0.0723 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(10*.0723)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Barber Quarter (1892-1916)</td>
  <td>$<?php echo(number_format(($silverprice*.1808),2,".",",")); ?></td>
  <td>0.1808 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(4*.1808)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Standing Liberty Quarter (1916-1930)</td>
  <td>$<?php echo(number_format(($silverprice*.1808),2,".",",")); ?></td>
  <td>0.1808 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(4*.1808)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Washington Quarter (1932-1964)</td>
  <td>$<?php echo(number_format(($silverprice*.1808),2,".",",")); ?></td>
  <td>0.1808 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(4*.1808)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Barber Half Dollar (1892-1915)</td>
  <td>$<?php echo(number_format(($silverprice*.36169),2,".",",")); ?></td>
  <td>0.36169 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(2*.36169)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Franklin Half Dollar (1948-1963)</td>
  <td>$<?php echo(number_format(($silverprice*.36169),2,".",",")); ?></td>
  <td>0.36169 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(2*.36169)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Kennedy Half Dollar (1964)</td>
  <td>$<?php echo(number_format(($silverprice*.36169),2,".",",")); ?></td>
  <td>0.36169 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(2*.36169)),2,".",",")); ?></td>
 </tr>
  
  <tr>
  <td>Kennedy Half Dollar (1965-1970)</td>
  <td>$<?php echo(number_format(($silverprice*.1479),2,".",",")); ?></td>
  <td>0.1479 ozt</td>
  <td>40% Silver, 60% Copper; $1 Face: <?php echo(number_format(($silverprice*(2*.1479)),2,".",",")); ?></td>
 </tr>
 
  <tr>
  <td>Morgan Dollar (1878-1921)</td>
  <td>$<?php echo(number_format(($silverprice*.7734),2,".",",")); ?></td>
  <td>0.7734 ozt</td>
  <td>90% Silver, Face: <?php echo(number_format(($silverprice*.7734),2,".",",")); ?></td>
 </tr>
 
  <tr>
  <td>Peace Dollar (1921-1935)</td>
  <td>$<?php echo(number_format(($silverprice*.7734),2,".",",")); ?></td>
  <td>0.7734 ozt</td>
  <td>90% Silver, Face: <?php echo(number_format(($silverprice*.7734),2,".",",")); ?></td>
 </tr>
 
  <tr>
  <td>Eisenhower (1971-1978)</td>
  <td>$<?php echo(number_format(($silverprice*.3161),2,".",",")); ?></td>
  <td>0.3161 ozt</td>
  <td>60% Copper, 40% Silver</td>
 </tr>
 
  <tr>
  <td>American Silver Eagle (1986-Present)</td>
  <td>$<?php echo(number_format(($silverprice*1),2,".",",")); ?></td>
  <td>1 ozt</td>
  <td>99.93% Silver</td>
 </tr>
 
  <tr>
  <td>America the Beautiful 'Quarter' (2010-Present)</td>
  <td>$<?php echo(number_format(($silverprice*5),2,".",",")); ?></td>
  <td>5 ozt</td>
  <td>99.93% Silver</td>
 </tr>
 
 
 </tbody>
 </table>
 *Actual Silver Weight
 
 

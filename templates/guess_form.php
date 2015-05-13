<?php
// configuration

if(!isset($_SESSION["id"])){$id=0;}else{$id=$_SESSION["id"];}


//CONTEST #1 FOR WHEN WE HAVE MULTIPLE CONTESTS/EVENTS
$event = 1;
$availableguesses=20;
$minval=0.01; //minimum value
$maxval=50; //maximum price


$format = 'Y-m-j G:i:s';
$contestdate='2015-06-14 12:34:31'; //date of spot at 2400est
$contestend=date ( $format, strtotime ( '-1 month' . $contestdate ) );; //last date to submit vote
if(strtotime($contestend)>time()){$contest='OPEN';}else{$contest='CLOSED';}
////
//$format = 'Y-m-j G:i:s';
//$date = date ( $format );
//// - 7 days from today
//echo date ( $format, strtotime ( '-7 day' . $date ) );
//// - 1 month from today
//echo date ( $format, strtotime ( '-1 month' . $date ) );


//PULL NY SPOT
    // Include the library
    require('simple_html_dom.php');
    // Retrieve the DOM from a given URL
    $html = file_get_html('http://www.kitco.com/mobile/');
    // Extract all text from a given cell
    $silver["bid"] = $html->find('td[align="center"]', 9)->plaintext.'<br><hr>'; 
    $silver["ask"] = $html->find('td[align="center"]', 10)->plaintext.'<br><hr>';
    $silver["change"] = $html->find('td[align="center"]', 12)->plaintext.'<br><hr>'; 
  $spot=($silver["bid"]+$silver["ask"])/2;
/*
    $gold["bid"] = $html->find('td[align="center"]', 4)->plaintext.'<br><hr>'; 
    $gold["ask"] = $html->find('td[align="center"]', 5)->plaintext.'<br><hr>'; 
    $gold["change"] = $html->find('td[align="center"]', 7)->plaintext.'<br><hr>'; 
    $platinum["bid"] = $html->find('td[align="center"]', 14)->plaintext.'<br><hr>'; 
    $platinum["ask"] = $html->find('td[align="center"]', 15)->plaintext.'<br><hr>'; 
    $platinum["change"] = $html->find('td[align="center"]', 17)->plaintext.'<br><hr>';
    $palladium["bid"] = $html->find('td[align="center"]', 19)->plaintext.'<br><hr>'; 
    $palladium["ask"] = $html->find('td[align="center"]', 20)->plaintext.'<br><hr>';
    $palladium["change"] = $html->find('td[align="center"]', 22)->plaintext.'<br><hr>';
    $rhodium["bid"] = $html->find('td[align="center"]', 24)->plaintext.'<br><hr>'; 
    $rhodium["ask"] = $html->find('td[align="center"]', 25)->plaintext.'<br><hr>';  
    $rhodium["change"] = $html->find('td[align="center"]', 27)->plaintext.'<br><hr>';
*/




//SEE IF USER NEEDS TO MAKE A GUESS
$filterusers=null;
if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
  if (isset($_POST["user"]))
  {
    $postUser = $_POST["user"];
    $filterusers =	query("SELECT uid, id, price, name, date FROM spot WHERE (id=? AND event = ?) ORDER BY price ASC", $postUser, $event);

  }
      
    
  if (isset($_POST["clear"]) && $id==1)
  {
    if (query("TRUNCATE TABLE `spot`") === false){apologize("Clear Spot Database Failure");}
  }
  
  
  
  if (isset($_POST["newguess"])) 
  {
    //CHECK DATE
    if($contest!='OPEN'){apologize("Contest is not open!");}
     
    //POST DATA TO LOCAL
    $newguess = $_POST["newguess"];
    //CHECK TO MAKE SURE GUESS IS VALID
      if (preg_match("/^([0-9.]+)$/", $newguess) == false) {apologize("You submitted an invalid price. Failure #1. $newguess");}
    ////CURRENCY CHECK
      //ACCEPTS NEGATIVE NUMBER. REMOVE "-?" AT THE BEGINNING TO STOP
      //ACCEPTS ONLY ONE DECIMAL "0.7". IF YOU WANT IT TO ALWAYS BE TWO REPLACE "{1,2}" WITH {2}
      if (preg_match("/^-?[0-9]+(?:\.[0-9]{1,2})?$/", $newguess) == false) {apologize("You submitted an invalid price. Failure #2. $newguess");}
    //POSITIVE CHECK
      if ($newguess < 0) {apologize("Price must be positive!");}
    
      if ($newguess > $maxval){apologize("Maximum value is $maxval!");}
      if ($newguess < $minval){apologize("Minimum value is $minval!");}


    //SEE IF USER IS AUTHORIZED
    $countQ = query("SELECT COUNT(id) AS total FROM spot WHERE (id=?)", $id); // query database for user
    $numberguesses = $countQ[0]["total"];
    if($numberguesses>=$availableguesses){apologize("User has no available guesses!");}
    
    //CHECK TO MAKE SURE PRICE ISNT TAKEN
    $countQ = query("SELECT COUNT(id) AS total FROM spot WHERE (price=? AND event=?)", $newguess, $event); // query database for user
     $taken = $countQ[0]["total"];
    if($taken>0){apologize("Price already taken!");}

      //INSERT TO DB
    if (query("INSERT INTO spot (id,price,event) VALUES (?,?,?)", $id, $newguess, $event) === false) {apologize("Unable to insert guess!");}
  
  } //isset
} //if post




//PULL DB QUERY OF CURRENT GUESSES
  //PULLS ALL GUESSES, AT THE MOMENT WE ARE JUST PULLING IT FOR EACH NUMBER
  $guesses =	query("SELECT uid, id, price, name, date FROM spot WHERE event = ? ORDER BY price ASC", $event);
$count=count($guesses);
  if(!empty($guesses)) 
  {

  $i=0;
  $winningDif=$maxval;
  foreach ($guesses as $guess) { 
        $thisValue = $guesses[$i]['price'];
        $currentDif = ($spot-$thisValue);
        
        //WINNING
        if($currentDif<$winningDif&&$currentDif>0){$winning=$guesses[$i]['uid'];$winningDif=$currentDif;}
        $i++;
  }

  }//!empty
  ?>





<?php
if($id==1){
?>
    <form method="post" action="guess.php">
        <button type="submit" class="btn btn-danger btn-xs" name="clear" value="yes">
        <span class="glyphicon glyphicon-remove-circle"></span>CLEAR TABLE
        </button>
    </form>
<?php
}//if id==1

?>









<table class="table table-striped table-condensed table-bordered" >
    <tr>
        <th>Bid</th>
        <th>Spot</th>
        <th>Ask</th>
        <th>Change</th>
    </tr>
    <tr>
        <td><?php echo(number_format((float)$silver["bid"],2,".","")); ?></td>
        <td><?php echo(number_format((float)$spot,2,".","")); ?></td>
        <td><?php echo(number_format((float)$silver["ask"],2,".","")); ?></td>
        <td><?php echo(number_format((float)$silver["change"],2,".","")); ?></td>
    </tr>
</table>








<!--DATE-->
<br>
<?php 
function secondsToTime($seconds) {
    $dtF = new DateTime("@0");
    $dtT = new DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a d, %h h, %i m, %s s');
}
?>
<table class="table table-striped table-condensed table-bordered" >
    <tr>
        <th>CONTEST DATE</th>
        <th>TIME TO CLOSE</th>
        <th>LAST DAY TO VOTE</th>
        <th>TIME TO VOTE</th>
    </tr>
    <tr>
        <td><?php echo $contestdate; ?></td>
        <td><?php 
            $timeremaining=strtotime($contestdate)-time();
            if($timeremaining>0){echo secondsToTime($timeremaining); }else{echo("Contest is Closed!");}
            ?></td>
        <td><?php echo $contestend; ?></td>
        <td><?php 
            
            $timeremaining=strtotime($contestend)-time();
            if($timeremaining>0){echo secondsToTime($timeremaining); }else{echo("Voting is Closed!");}
            ?></td>
    </tr>
</table>









<?php //echo('Contest is ' . $contest); ?>
<?php if($contest!='OPEN'){ ?><h2 style="color:red">CONTEST IS CLOSED!</h2><?php } ?>
<?php if($contest=='OPEN'){ ?><h2 style="color:green">CONTEST IS OPEN!</h2>

<table class="table table-striped table-condensed table-bordered" >
    <tr>
        <th>NEW</th>
        <th>USED</th>
        <th>AVAILABLE</th>
        <th>ALL</th>
    </tr>
    <tr>
        <td>
        <form method="post" action="guess.php">
            <select  name="newguess" >
                <?php 
                $i=$minval;
                while($i<=$maxval){ 
                    $i=round($i, 2); //$i=number_format(($i),2,".","")
                    $taken = query("SELECT COUNT(id) AS total FROM spot WHERE (price=?)", $i); // query database for user
                    $taken = $taken[0]["total"];
                    if($taken<=0){echo('<option value="' .  number_format(($i),2,".",",") . '">' . number_format(($i),2,".",",") . '</option>');} 
                    $i=$i+0.01;}  
                ?>
            </select>
            <button type="submit" >Submit</button>
        </form>
        </td>
        <td><?php 
            $countQ = query("SELECT COUNT(id) AS total FROM spot WHERE (id=?)", $id); // query database for user
            $numberguesses = $countQ[0]["total"];
            echo($numberguesses); ?></td>
        <td><?php $guessesleft=$availableguesses-$numberguesses; echo($guessesleft); ?></td>
        <td><?php echo($count); ?></td>
    </tr>
</table>
<?php } //if open ?>

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
 

<!--WINNING -->
<table class="table table-striped table-condensed table-bordered" >
    <tr>
        <th colspan="4">WINNING GUESS</th>
    </tr>
    <tr>
      <td><b>PRICE</b></td>
      <td><b>USER (ID)</b></td>
      <td><b>DATE</b></td>
      <td><b>SPOT</b></th>
    </tr>   
<?php 
//$winningQ =   query("SELECT uid, id, price, name, date FROM spot WHERE (event=? AND uid=?) ORDER BY price ASC", $event, $winning);
$winningQ =   query("SELECT uid, id, price, name, date FROM spot WHERE (event=? AND price<=?) ORDER BY price DESC LIMIT 1", $event, $spot);
  if(!empty($winningQ)) 
  {
        $distance =           ($winningQ[0]["price"]-$spot);
        $distancepercentage = 100*(($winningQ[0]["price"]-$spot)/$spot);

    echo('<tr style="color:green;font-weight: bolder;font-size: 150%;">');
        echo('<td>' . number_format($winningQ[0]["price"],2,".",",") . '</td>');
        echo('<td><a href="http://www.reddit.com/user/' . $winningQ[0]["name"] . '" target="_blank">' . $winningQ[0]["name"] . '</a> (' . $winningQ[0]["id"] . ')</td>');  //. $guess["name"] . '/'
        echo('<td>' . $winningQ[0]["date"] . '</td>');
        echo('<td>' . number_format(($distance),2,".",",") . ' (' . number_format($distancepercentage,2,".",",") . '%)</td>');
    echo('</tr>');
    }
    else{echo('<tr><td colspan="3">None</td></tr>');}
    ?>
    
</table>










<!--FILTER BY USER-->
<?php
  //USER GUESSERS DROP DOWN
  $guessers =	query("SELECT distinct id, name FROM spot WHERE (event = ?) ORDER BY name ASC", $event);
  if(!empty($guessers)) 
  {
      ?>
  <form method="post" action="guess.php">
    <select  name="user" >
        <?php   foreach ($guessers as $user) { 
            echo('<option value="' . $user["id"] . '">'  . $user["name"] . '</option>');
        } //foreach
        ?>
      </select>
<button type="submit" >FIND USER</button>
</form>          
      
      <?
  }
  ?>
<br>
<?php 
if(!is_null($filterusers))
{ 
    echo('Filtered by user: ' . $postUser);
    echo('
    <table class="table table-striped table-condensed table-bordered" >
    <tr>
        <th>PRICE</th>
        <th>USER (ID)</th>
        <th>DATE</th>
        <th>SPOT</th>
    </tr>');
    foreach ($filterusers as $filtered) { 
        $distance =           ($filtered["price"]-$spot);
        $distancepercentage = 100*(($filtered["price"]-$spot)/$spot);

        echo('<tr>');
        echo('<td>' . number_format($filtered["price"],2,".",",") . '</td>');
        echo('<td>' . $filtered["name"] . ' (' . $filtered["id"] . ')</td>');  //. $guess["name"] . '/'
        echo('<td>' . $filtered["date"] . '</td>');
        echo('<td>' . number_format(($distance),2,".",",") . ' (' . number_format($distancepercentage,2,".",",") . '%)</td>');
        echo('</tr>');
    } //foreach
     echo('</table>');
}//if
?>











<!--ALL-->
 <table class="table table-striped table-condensed table-bordered" >
    <tr>
        <th colspan="6">ALL GUESSES</th>
    </tr>
    <tr>
      <td><b>PRICE</b></td>
      <td><b>USER (ID)</b></td>
      <td><b>SPOT</b></td>
      <td><b>PREV</b></td>
      <td><b>NEXT</b></td>
      <td><b>DATE</b></td>
    </tr>   
<?php
  if(!empty($guesses)) 
  {

  $i=0;
  foreach ($guesses as $guess) { 
      
      $distance =           ($spot-$guess["price"]);
      $distancepercentage = 100*(($spot-$guess["price"])/$spot);

        if($i==0){$prevValue=$minval;}else{$prevValue = $guesses[$i - 1]['price'];}
        $thisValue = $guesses[$i]['price'];
        if($i>=($count-1)){$nextValue=$maxval;}else{
            $nextValue = $guesses[$i + 1]['price'];}
            
        //$percentageDiff = ($nextValue-$thisValue)/$thisValue;
        //$currentDif = ($spot-$thisValue);
      
        
        if($guess["uid"]==$winning){echo('<tr style="color:green;font-weight: bolder;font-size: 150%;">');}
        else{echo('<tr>');}
        echo('<td>' . number_format($guess["price"],2,".",",") . '</td>');
        echo('<td><a href="http://www.reddit.com/user/' . $guess["name"] . '" target="_blank">' . $guess["name"] . '</a> (' . $guess["id"] . ')</td>');  //. $guess["name"] . '/'
        echo('<td>' . number_format(($distance),2,".",",") . ' (' . number_format($distancepercentage,2,".",",") . '%)</td>');
        echo('<td>' . number_format(($prevValue-$guess["price"]),2,".",",") . '</td>');
        echo('<td>' . number_format(($nextValue-$guess["price"]),2,".",",") . '</td>');
        echo('<td>' . $guess["date"] . '</td>');
    echo('</tr>');
    
    $i++;
    } //foreach
  } //if
  else{echo('<tr><td colspan="6">None</td></tr>');}
?>

  </table>







<?php
  if(!empty($guesses)) 
  {
?>

<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1.1','packages':['corechart']}]}"></script>
       <div id="chart_div" style="width: 100%; height: 1000px;"></div>

<script>
          google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Spot', 'Guess'],<?php   

foreach ($guesses as $guess) 
{ 
    echo('[ ' . $guess["price"] . ', ' . $guess["price"] . '],');   
} //foreach
?>
        ]);

        var options = {
          title: 'Spot Guesses',
          hAxis: {title: 'Spot', minValue: 10, maxValue: 0},
          vAxis: {title: 'Guess', minValue: 10, maxValue: 0},
          legend: 'none'
        };

        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
</script>

<?php } //if ?>



<style>
    #middle
    {
        background-color:transparent;
        border:0;
    }
    .symbolForm {
        display: inline-block;
        text-align:center;
        width:25%;
    }
    .panel-success .panel-heading
    {
        /*color: #3c763d;*/
        background-color: #dff0d8;
        border-color: #d6e9c6;
        font-size: 20px;
        color: black;
        padding: 5px 5px 5px 5px;
    }
        *
    {
        /*for sparkline box*/
        box-sizing: initial;
        /*box-sizing: content-box;*/

    }
</style>
<?php //need To ensure the vars sugh as bids group arefed. ?>
<head>

<!--FOR SPARKLINES-->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/sparkline.js"></script>
<script type="text/javascript">
    $(function() {
    /** This code runs when everything has been loaded on the page */
    /* Inline sparklines take their values from the contents of the tag */
    $('.inlinesparkline').sparkline();
    $('.sparklines').sparkline('html', { enableTagOptions: true });
    });
</script>
<!--END SPARKLINES-->


   <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <!--  <script type="text/javascript" src="js/jsapi"></script> -->
     <!--script type="text/javascript" src="https://www.google.com/jsapi"></script-->
    <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart()
        {
        <?php
            if($tradesGroup != null)
            {
            ?>


            /////////////////
            //CHART 1
            //TRADES GROUP
            ////////////////
            var data = google.visualization.arrayToDataTable([
                <?php

                echo("['Date', 'Price', 'Volume(k)'],"); // ['Year', 'Sales', 'Expenses'],
                //SQL QUERY FOR ALL TRADES

                foreach ($tradesGroup as $trade)	// for each of user's stocks
                {
                    $dbDate = $trade["date"];
                    $date = strtotime($dbDate);
                    $price = number_format(getPrice($trade["price"]), 2, '.', '');
                    $quantity = number_format(($trade["quantity"]), 2, '.', '')/1000;
                    //$quantity = (int)$trade["quantity"];
                    //$quantity = ($quantity/1000);

                    echo("['" . date("m-d-Y", $date) . "', " . $price .  ", " . $quantity . "],");
                }//ex: ['2013',  1000, 400],
                ?>
            ]);
            var options =
            {
                title: '<?php echo($symbol); ?> - TRADES/DAY',
                hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},
                vAxis: {title: 'Price(avg) & Volume(k)', minValue: 0},
                colors:['green','gray']
                //height: 500,
                
            };
            var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
            chart.draw(data, options);
            //////////////
            //END CHART 1
            ////////////


            //////////
            //CHART 2
            //TRADES
            //////////
            var data1 = google.visualization.arrayToDataTable([
                <?php

                echo("['Date', 'Price', 'Volume'],"); // ['Year', 'Sales', 'Expenses'],
                //SQL QUERY FOR ALL TRADES
                $tradesChart = array_reverse($trades); //so it will be in correct ASC order for chart
                foreach ($tradesChart as $trade)	// for each of user's stocks
                {
                    $dbDate = $trade["date"];
                    $date = strtotime($dbDate);
                    $price = number_format(getPrice($trade["price"]), 2, '.', '');
                    $quantity = number_format(($trade["quantity"]), 2, '.', '');
                    //$quantity = (int)$trade["quantity"];
                    //$quantity = ($quantity/1000);

                    echo("['" . date("m-d-Y", $date) . "', " . $price .  ", " . $quantity . "],");
                }//ex: ['2013',  1000, 400],
                ?>
            ]);
            var options1 =
            {
                title: '<?php echo($symbol); ?> - TRADES',
                hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},
                vAxis: {title: 'Price & Quantity', minValue: 0},
                colors:['green','gray']
                //height: 500,

            };
            var chart1 = new google.visualization.AreaChart(document.getElementById('chart_div1'));
            chart1.draw(data1, options1);
            //////////
            //END CHART 2
            ////////////


            //////////
            //CHART 5 volume
            //////////
            var data5 = google.visualization.arrayToDataTable([
                <?php

                echo("['Date', 'Quantity'],"); // ['Year', 'Sales', 'Expenses'],
                //SQL QUERY FOR ALL TRADES
                $tradesChart = array_reverse($trades); //so it will be in correct ASC order for chart
                foreach ($tradesChart as $trade)	// for each of user's stocks
                {
                    $dbDate = $trade["date"];
                    $date = strtotime($dbDate);
                    $price = number_format(getPrice($trade["price"]), 2, '.', '');
                    $quantity = number_format(($trade["quantity"]), 2, '.', '');
                    //$quantity = (int)$trade["quantity"];
                    //$quantity = ($quantity/1000);

                    echo("['" . date("m-d-Y", $date) . "', " . $quantity . "],");
                }//ex: ['2013',  1000, 400],
                ?>
            ]);
            var options5 =
            {
                title: '<?php echo($symbol); ?> - QUANTITY',
                hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},
                vAxis: {title: 'Quantity', minValue: 0, isStacked: true},
                colors:['gray'],
                legend: {position: 'none', textStyle: {color: 'blue', fontSize: 16}}
                //height: 500,

            };
            var chart5 = new google.visualization.SteppedAreaChart(document.getElementById('chart_div5'));
            chart5.draw(data5, options5);
            //////////
            //END CHART 5 volume
            ////////////

            //////////
            //CHART 6 trades only
            //////////
            var data6 = google.visualization.arrayToDataTable([
                <?php

                echo("['Date', 'Price'],"); // ['Year', 'Sales', 'Expenses'],
                //SQL QUERY FOR ALL TRADES
                $tradesChart = array_reverse($trades); //so it will be in correct ASC order for chart
                foreach ($tradesChart as $trade)	// for each of user's stocks
                {
                    $dbDate = $trade["date"];
                    $date = strtotime($dbDate);
                    $price = number_format(getPrice($trade["price"]), 2, '.', '');
                    $quantity = number_format(($trade["quantity"]), 2, '.', '');
                    //$quantity = (int)$trade["quantity"];
                    //$quantity = ($quantity/1000);

                    echo("['" . date("m-d-Y", $date) . "', " . $price . "],");
                }//ex: ['2013',  1000, 400],
                ?>
            ]);
            var options6 =
            {
                title: '<?php echo($symbol); ?> - PRICE',
                hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},
                vAxis: {title: 'Price', minValue: 0},

                colors:['green'],
                legend: {position: 'none', textStyle: {color: 'blue', fontSize: 16}}
                //height: 500,

            };
            var chart6 = new google.visualization.AreaChart(document.getElementById('chart_div6'));
            chart6.draw(data6, options6);
            //////////
            //END CHART 6 trades only
            ////////////







            <?php }   //tradesgroup != null ?>



            <?php
            if($bidsGroup != null)
            {
             ?>
            //////////
            //CHART 2
            //ORDERBOOK
            //////////
            var data2 = google.visualization.arrayToDataTable([
                <?php

                echo("['Date', 'Bids', 'Asks'],"); // ['Year', 'Sales', 'Expenses'],
                //SQL QUERY FOR ALL TRADES

                $bidsGroupChart = array_reverse($bidsGroup); //so it will be in correct ASC order for chart
                foreach ($bidsGroupChart as $order)	// for each of user's stocks
                {
                    $date = 0;
                    $price = number_format(getPrice($order["price"]), 2, '.', '');
                    $quantity = number_format(($order["quantity"]), 2, '.', '');
                    echo("['" . $price . "', " . $quantity .  ", " . $date . "],");
                }

                foreach ($asksGroup as $order)	// for each of user's stocks
                {
                    $date = 0;
                    $price = number_format(getPrice($order["price"]), 2, '.', '');
                    $quantity = number_format(($order["quantity"]), 2, '.', '');
                    echo("['" . $price . "', " . $date .  ", " . $quantity . "],");
                }




                ?>
            ]);
            var options2 =
            {
                title: '<?php echo($symbol); ?> - ORDERBOOK',
                hAxis: {title: 'Price',  titleTextStyle: {color: '#333'}},
                vAxis: {title: 'Quantity', minValue: 0, isStacked: true}
               // height: 500,

            };
            //var chart2 = new google.visualization.AreaChart(document.getElementById('chart_div2'));
            var chart2 = new google.visualization.SteppedAreaChart(document.getElementById('chart_div2'));

            chart2.draw(data2, options2);
            //////////
            //END CHART 2
            ////////////
            <?php }   //$bidsGroupChart != null ?>



            /////////////////
            //CHART PIE
            //OWNERSHIP
            ////////////////

            var data3 = google.visualization.arrayToDataTable([
                ['User', 'Quantity'],
               <?php
               $owned=0;
               foreach ($ownership as $owners)	// for each of user's stocks
                {
                    $quantity = number_format(($owners["quantity"]), 0, '.', '');
                    $id = number_format(($owners["id"]), 0, '.', '');
                    echo("['User: " . $id . "', " . $quantity . "],");
                    $owned=$owned+$quantity;
                }

            $asset["askstotal"]=number_format(($asset["askstotal"]), 0, '.', '');
            $leftOver=($asset["public"]-$owned-$asset["askstotal"]); //takes the amount issued and subtracts the listed owned to figure out how many shares are left from top listed users for pie chart
            $leftOver=number_format(($leftOver), 0, '.', '');
            echo("['Other Users', " . $leftOver . "],");
            echo("['Orderbook', " . $asset["askstotal"] . "],");
            //if($leftOver>0){} //if($askQuantity>0){}
             //   ['Work',     11],
             //   ['Sleep',    7]
                ?>
            ]);




            var options3 = {
                //title: 'Ownership Control',
                //is3D: true,
                //legend: 'none',
                //pieSliceText: 'percentage' //'label', 'percentage', 'value', 'none'
                //width: 400,
                height: 500
                //colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6'],

            };

            var chart3 = new google.visualization.PieChart(document.getElementById('piechart'));

            chart3.draw(data3, options3);



            /////////////////
            //END CHART PIE 3
            ////////////////















            //////////
            //CHART 4
            //ORDERBOOK V2 MARKET DEPTH
            //////////
            var data4 = google.visualization.arrayToDataTable([
                <?php

                echo("['Date', 'Bids', 'Asks'],"); // ['Year', 'Sales', 'Expenses'],
                //SQL QUERY FOR ALL TRADES
                $bquantity=0; $i=0;
                $bidsG2=[];
                foreach ($bidsGroupAll as $order)	// for each of user's stocks
                { $i++;
                    $date = 0;
                    $order["price"];
                    $bquantity = $bquantity+$order["quantity"];
                    $order["quantity"] = $bquantity;
                    $bidsG2[$i]=$order;
                }
                $bidsGroupChart = array_reverse($bidsG2); //so it will be in correct ASC order for chart
                foreach ($bidsGroupChart as $order)	// for each of user's stocks
                {
                    $date = 0;
                    $price = number_format(getPrice($order["price"]), 2, '.', '');
                    $quantity =  number_format(($order["quantity"]), 2, '.', '');
                    echo("['" . $price . "', " . $quantity .  ", " . $date . "],");
                }

                $aquantity=0;
                foreach ($asksGroupAll as $order)	// for each of user's stocks
                {
                    $date = 0;
                    $price = number_format(getPrice($order["price"]), 2, '.', '');
                    $aquantity2 = $order["quantity"];
                    $aquantity = ($aquantity + $aquantity2);
                    $aquantity =  number_format(($aquantity), 2, '.', '');
                    echo("['" . $price . "', " . $date .  ", " . $aquantity . "],");
                }

                ?>
            ]);
            var options4 =
            {
                title: '<?php echo($symbol); ?> - MARKET DEPTH',
                hAxis: {title: 'Price',  titleTextStyle: {color: '#333'}},
                vAxis: {title: 'Quantity', minValue: 0, isStacked: true}
                // height: 500,

            };
            var chart4 = new google.visualization.SteppedAreaChart(document.getElementById('chart_div4'));

            chart4.draw(data4, options4);
            //////////
            //END CHART 3A V2
            ////////////






















//echo(var_dump(get_defined_vars()));
        }
    </script>
</head>



    
    
    <div class="panel panel-success"> <!--success info primary danger warning -->
    <!-- Default panel contents -->
    <div class="panel-heading">INFORMATION</div>
<table class="table">
    <thead>
    </thead>
    <tbody>
    <tr >
        <td>
            Symbol: <?php echo(htmlspecialchars($asset["symbol"])) ?><br>
            Name: <?php echo(htmlspecialchars($asset["name"])) ?><br>
            URL: <?php echo(htmlspecialchars($asset["url"])) ?><br>
            Market Cap: <?php echo($unitsymbol . number_format($asset["marketcap"], 2, ".", ",")) ?>

        </td>
        <td >
            <?php echo($unitsymbol . number_format($asset["price"], 2, ".", ",")) ?> - Price<br>
            <?php echo($unitsymbol . number_format($bidsPrice, 2, ".", ",")) ?> - Bid<br>
            <?php echo($unitsymbol . number_format($asksPrice, 2, ".", ",")) ?> - Ask<br>
            <?php echo($unitsymbol . number_format($asset["avgprice"], 2, ".", ",")) ?> - Avg. (30d)
        </td>
        <td >
            <?php echo(number_format($asset["volume"], 0, ".", ",")) ?> - Volume (30d)<br>
            <?php echo(number_format($asset["public"], 0, ".", ",")) ?> - Publicly Held<br>
            <?php echo(number_format($asset["issued"], 0, ".", ",")) ?> - Issued (<?php echo(number_format($asset["userid"], 0, ".", ",")) ?>)<br>
            <?php echo(htmlspecialchars($asset["date"])) ?> - Listed
        </td>
        <td >
            Dividend: <?php echo(number_format($asset["dividend"], 2, ".", ",")) ?><br>
            Rating: <?php echo(htmlspecialchars($asset["rating"])) ?><br>
            Type: <?php echo(htmlspecialchars(ucfirst($asset["type"]))) ?>
        </td>
    </tr>
    <tr>
        <td colspan="4">Description: <?php echo(htmlspecialchars(ucfirst($asset["description"]))) ?></td>
    </tr>
    </tbody>
</table>
    </div><!--panel-primary-->


























    <div class="panel panel-primary"> <!--success info primary danger warning -->
    <!-- Default panel contents -->
    <div class="panel-heading">YOUR ACCOUNT</div>
<table class="table">

        <thead>
    <tr class="active">            
        <th colspan="1">Available</th>
        <th colspan="1">Orderbook</th>
        <th colspan="1">Total</th>
        <th colspan="1">Control</th>
        <th colspan="1">Value</th>
    </tr>            
        </thead>
<tbody>
    <tr>
        <td colspan="1"><?php echo(number_format($asset["userportfolio"], 0, ".", ",")) ?></td>
        <td colspan="1"><?php echo(number_format($asset["userlocked"], 0, ".", ",")) ?></td>
        <td colspan="1"><?php echo(number_format(($asset["userlocked"]+$asset["userportfolio"]), 0, ".", ",")) ?></td>
        <td colspan="1"><?php echo(number_format($asset["control"], 0, ".","")) ?>%</td>
        <td colspan="1"><?php echo($unitsymbol . number_format((($asset["userlocked"]+$asset["userportfolio"])*$asset["price"]), 2, ".", ",")) ?></td>
    </tr>
</tbody>
</table>
    </div><!--panel-primary your account-->














    <div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading">TRADES</div>
<table class="table">
<?php
if($tradesGroup != null)
{ ?>
    <tr><td colspan="7"><div id="chart_div" style="overflow:hidden;"></div></td></tr>
<?php } /*tradesgroup*/?>


<?php
if($trades == null){ ?>
<tr><td colspan="7">No Trades</td></tr>
<?php } /* trades==null */ 

if($trades != null)
{ ?>
    <tr><td colspan="7"><div id="chart_div1" style="overflow:hidden;"></div></td></tr><!-- trades -->
    <tr><td colspan="7"><div id="chart_div6" style="overflow:hidden;"></div></td></tr><!-- price -->
    <tr><td colspan="7"><div id="chart_div5" style="overflow:hidden;"></div></td></tr><!-- quantity -->

    <tr class='active'>
        <td>Trade #</td>
        <td>Buyer-Bid/Seller-Ask/Type</td>
        <td>Date/Time (Y/M/D)</td>
        <td>Symbol</td>
        <td>Quantity</td>
        <td>Price</td>
        <td>Total</td>
    </tr>
    <?php
    $i=0;
    foreach ($trades as $trade) {
        @$tradeID = $trade["uid"];
        @$tradeType = $trade["type"];
        @$biduid = $trade["bidorderuid"];//$trade["buyer"];
        @$askuid = $trade["askorderuid"];
        @$buyer = $trade["buyer"];//$trade["buyer"];
        @$seller = $trade["seller"];
        @$symbol = $trade["symbol"];
        @$quantity = $trade["quantity"];
        @$price = getPrice($trade["price"]);
        @$total = getPrice($trade["total"]);
        @$date = $trade["date"];
        echo("
                <tr>
                <td>" . number_format($tradeID, 0, ".", ",") . "</td>
                <td>" . $buyer . "-" . $biduid . "/" . $seller . "-" . $askuid . "/" . strtoupper($tradeType) . "</td>
                <td>" . htmlspecialchars(date('Y-m-d H:i:s', strtotime($date))) . "</td>
                <td>" . htmlspecialchars("$symbol") . "</td>
                <td>" . number_format($quantity, 0, ".", ",") . "</td>
                <td>$" . number_format($price, 2, ".", ",") . "</td>
                <td>$" . number_format($total, 2, ".", ",") . "</td>
                </tr>");
        $i++;
        if($i==5){break;}
    } //foreach
    ?>
<?php } /*trades != null*/
?>

</table>
    </div><!--panel-primary trades-->









<?php if($bids != null || $asks != null) { ?>
<div class="panel panel-primary"> <!--success info primary danger warning -->
    <!-- Default panel contents -->
    <div class="panel-heading">MARKET DEPTH</div>
    <table class="table">
        <thead>
        </thead>
        <tbody>
        <tr>
            <td>
                <div id="chart_div4" style="overflow:hidden;"></div>
            </td>
        </tr>
        </tbody>
    </table>
</div><!--panel-primary orderbook-->
<?php } /*GroupAll*/?>












<div class="panel panel-primary">
<!-- Default panel contents -->
<div class="panel-heading">ORDERBOOK</div>
<table class="table">
<?php if($asks == null && $bids == null )
{ ?>
    <tr><td>No orders</td></tr>
<?php } 
if($asks!= null && $bids != null )
{
?>

<tr>
    <td style="width:10%">
    <div class="panel panel-info">
    <!-- Default panel contents -->
    <div class="panel-heading">BIDS</div>
        <table class="table" style="display: inline-table;text-align:center;">
            <tr>
                <td ><b>Qty</b></td>
                <td ><b>$</b></td>
            </tr>

            <?php
            foreach ($bidsGroup as $order)
            {
                $quantity = $order["quantity"];
                $price = getPrice($order["price"]);
                echo("<tr><td >" . number_format($quantity,0,".",",") . "</td><td >" . number_format($price,2,".",",") . "</td></tr>");
            }
            ?>

            <tr>
                <td><b><?php echo(number_format($asset["bidstotal"],0,".",","));?></b></td>
                <td><b>ALL</b></td>
            </tr>

        </table>
    </div><!--panel bids-->

    </td>
    <td style="vertical-align: bottom;">
        <div id="chart_div2"></div>
    </td>
    <td style="width:10%">
    
    <div class="panel panel-danger">
    <!-- Default panel contents -->
    <div class="panel-heading">ASKS</div>

        <table class="table" style="display: inline-table;text-align:center;">
            <tr>
                <td ><b>$</b></td>
                <td ><b>Qty</b></td>
            </tr>



            <?php
            foreach ($asksGroup as $order)
            {
                $price = getPrice($order["price"]);
                $quantity = $order["quantity"];
                echo("<tr ><td >" . number_format($price,2,".",",") . "</td><td >" . number_format($quantity,0,".",",") . "</td></tr>");
            }
            ?>

            <tr>
                <td><b>ALL</b></td>
                <td><b><?php echo(number_format($asset["askstotal"],0,".",","));?></b></td>
            </tr>



        </table>
    </div><!--panel danger asks-->
    </td>
</tr><!--orderbook chart row-->
<tr><!--bids-->
<td colspan="3">


    <div class="panel panel-info">
    <!-- Default panel contents -->
    <div class="panel-heading">TOP BIDS</div>
    <table class="table" align="center">
    <tr class="active">
        <td>Order #</td>
        <td>Side</td>
        <!--th>Type</th-->
        <td>Date/Time (Y/M/D)</td>
        <td>Symbol</td>
        <td>Quantity</td>
        <td>Price</td>
    </tr>
    <?php
    foreach ($bids as $row)
    {
        //if ($row["side"]=="b"){$row["side"]="Bid";}
        //if ($row["side"]=="a"){$row["side"]="Ask";}
        echo("<tr>");
        echo("<td>" . (number_format($row["uid"],0,".",",")) . "</td>");
        if($row["side"]=='b'){$side='BID';}; if($row["side"]=='a'){$side='ASK ';};
        echo("<td>" . htmlspecialchars($side) . "</td>");
        echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");
        echo("<td>" . htmlspecialchars(strtoupper($row["symbol"])) . "</td>");
        //echo("<td>" . htmlspecialchars($row["type"]) . "</td>");
        echo("<td>" . number_format($row["quantity"],0,".",",") . "</td>");
        echo("<td>" . (number_format(getPrice($row["price"]),2,".",",")) . "</td>");
        echo("</tr>");
    }
    ?>
    </table>
    </div><!--panel order bids-->


</td>    
</tr><!--orderbook bids row-->
<tr><!--orderbook asks row-->
<td colspan="3">

    <div class="panel panel-danger">
    <!-- Default panel contents -->
    <div class="panel-heading">TOP ASKS</div>
    <table class="table" align="center">
    <tr class="active">
        <td>Order #</td>
        <td>Side</td>
        <!--th>Type</th-->
        <td>Date/Time (Y/M/D)</td>
        <td>Symbol</td>
        <td>Quantity</td>
        <td>Price</td>
    </tr>

    <?php
    foreach ($asks as $row)
    {
        //if ($row["side"]=="b"){$row["side"]="Bid";}
        //if ($row["side"]=="a"){$row["side"]="Ask";}
        echo("<tr>");
        echo("<td>" . (number_format($row["uid"],0,".",",")) . "</td>");
        if($row["side"]=='b'){$side='BID';}; if($row["side"]=='a'){$side='ASK ';};
        echo("<td>" . htmlspecialchars($side) . "</td>");
        echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");
        echo("<td>" . htmlspecialchars(strtoupper($row["symbol"])) . "</td>");
        //echo("<td>" . htmlspecialchars($row["type"]) . "</td>");
        echo("<td>" . number_format($row["quantity"],0,".",",") . "</td>");
        echo("<td>" . (number_format(getPrice($row["price"]),2,".",",")) . "</td>");
        echo("</tr>");

    }
    ?>

    </table>
    </div><!--panel order asks-->

</td>
</tr><!--orderbook asks row-->
<tr><!--orderbook lastorders row-->
<td colspan="3">

    <div class="panel panel-warning">
    <!-- Default panel contents -->
    <div class="panel-heading">LAST ORDERS</div>
    <table class="table" align="center">
    <tr class="active">
        <td>Order #</td>
        <td>Side</td>
        <!--th>Type</th-->
        <td>Date/Time (Y/M/D)</td>
        <td>Symbol</td>
        <td>Quantity</td>
        <td>Price</td>
    </tr>

    <?php
    foreach ($lastorders as $row)
    {
        //if ($row["side"]=="b"){$row["side"]="Bid";}
        //if ($row["side"]=="a"){$row["side"]="Ask";}
        echo("<tr>");
        echo("<td>" . (number_format($row["uid"],0,".",",")) . "</td>");
        if($row["side"]=='b'){$side='BID';}; if($row["side"]=='a'){$side='ASK ';};
        echo("<td>" . htmlspecialchars($side) . "</td>");
        echo("<td>" . htmlspecialchars(date('Y-m-d H:i:s',strtotime($row["date"]))) . "</td>");
        echo("<td>" . htmlspecialchars(strtoupper($row["symbol"])) . "</td>");
        //echo("<td>" . htmlspecialchars($row["type"]) . "</td>");
        echo("<td>" . number_format($row["quantity"],0,".",",") . "</td>");
        echo("<td>" . (number_format(getPrice($row["price"]),2,".",",")) . "</td>");
        echo("</tr>");

    }
    ?>

    </table>
    </div><!--panel order last orders-->

</td>
</tr><!--orderbook last orders row-->

<?php } /* $lastorders != null */ ?>
</table><!--orderbook table-->
</div><!--panel-primary orderbook-->









<div class="panel panel-primary">
    <!-- Default panel contents -->
                <?php
            $symbol = $row["symbol"];
            $tradesG = query("SELECT SUM(quantity) AS volume, AVG(price) AS price, date FROM trades WHERE ( (type='LIMIT' or type='MARKET') AND symbol =?) GROUP BY DAY(date) ORDER BY date DESC LIMIT 0,7", $symbol);      // query user's portfolio
            $tradesGreverse = array_reverse($tradesG); //so it will be in correct ASC order for chart
            $tradesCount=count($tradesG);
            ?>
    <div class="panel-heading">DAILY ACTIVITY</div>
<table class="table table-condensed table-striped table-bordered" id="activity" style="border-collapse:collapse;text-align:left;vertical-align:middle;">
<tr class="active">
<th>Date</th>
<th>Avg. Price
<span class="sparklines" sparkType="line" style="box-sizing: initial;">
<?php
                $t=0;
                foreach($tradesGreverse as $trade){
                    echo(number_format(getPrice($trade["price"]), 2, ".", ""));
                    $t++;
                    if($t<$tradesCount){echo(",");}
                }
                ?>
</span>
</th>
<th>Volume
<span class="sparklines" sparkType="bar" sparkBarColor="blue">
<?php
                $t=0;
                foreach($tradesGreverse as $trade){
                    echo(number_format(($trade["volume"]), 0, ".", ""));
                    $t++;
                    if($t<$tradesCount){echo(",");}
                }
                ?>
</span>
</th>
</tr>

            <?php
            foreach($tradesG as $trade){
                echo('<tr><td>' . date("M j, Y", strtotime($trade["date"])) . '</td><td>' . number_format(getPrice($trade["price"]), 2, ".", "") . '</td><td>' . number_format(($trade["volume"]), 0, ".", "") . '</td></tr>');
                }
            ?>
</table>
</div><!--panel-primary DAILY ACTIVITY-->

















<div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading">ACTIVITY</div>
<table class="table table-condensed table-striped table-bordered" id="activity" style="border-collapse:collapse;text-align:left;vertical-align:middle;">

    <tr class="active">
        <th>PERIOD</th><th>ORDERS</th><th>TRADES</th><th>VOLUME</th><th>VALUE</th>
    </tr>

    <tr>
        <td>00-24h</td>
        <td><?php echo(number_format($dash["ordersday1"], 0, '.', ',')); ?></td>
        <td><?php echo(number_format($dash["tradesday1"], 0, '.', ',')); ?></td>
        <td><?php echo(number_format($dash["volumeday1"], 0, '.', ',')); ?></td>
        <td><?php echo($unitsymbol . number_format(getPrice($dash["valueday1"]), 2, '.', ',')); ?></td>
    </tr>
    <tr>
        <td>24-48h</td>
        <td><?php echo(number_format($dash["ordersday2"], 0, '.', ',')); ?></td>
        <td><?php echo(number_format($dash["tradesday2"], 0, '.', ',')); ?></td>
        <td><?php echo(number_format($dash["volumeday2"], 0, '.', ',')); ?></td>
        <td><?php echo($unitsymbol . number_format(getPrice($dash["valueday2"]), 2, '.', ',')); ?></td>
    </tr>
    <tr>
        <td>48-72h</td>
        <td><?php echo(number_format($dash["ordersday3"], 0, '.', ',')); ?></td>
        <td><?php echo(number_format($dash["tradesday3"], 0, '.', ',')); ?></td>
        <td><?php echo(number_format($dash["volumeday3"], 0, '.', ',')); ?></td>
        <td><?php echo($unitsymbol . number_format(getPrice($dash["valueday3"]), 2, '.', ',')); ?></td>
    </tr>
    <tr>
        <td>72-96h</td>
        <td><?php echo(number_format($dash["ordersday4"], 0, '.', ',')); ?></td>
        <td><?php echo(number_format($dash["tradesday4"], 0, '.', ',')); ?></td>
        <td><?php echo(number_format($dash["volumeday4"], 0, '.', ',')); ?></td>
        <td><?php echo($unitsymbol . number_format(getPrice($dash["valueday4"]), 2, '.', ',')); ?></td>
    </tr>
    <tr>
        <td>96-120h</td>
        <td><?php echo(number_format($dash["ordersday5"], 0, '.', ',')); ?></td>
        <td><?php echo(number_format($dash["tradesday5"], 0, '.', ',')); ?></td>
        <td><?php echo(number_format($dash["volumeday5"], 0, '.', ',')); ?></td>
        <td><?php echo($unitsymbol . number_format(getPrice($dash["valueday5"]), 2, '.', ',')); ?></td>
    </tr>
    <tr>
        <td>120-144h</td>
        <td><?php echo(number_format($dash["ordersday6"], 0, '.', ',')); ?></td>
        <td><?php echo(number_format($dash["tradesday6"], 0, '.', ',')); ?></td>
        <td><?php echo(number_format($dash["volumeday6"], 0, '.', ',')); ?></td>
        <td><?php echo($unitsymbol . number_format(getPrice($dash["valueday6"]), 2, '.', ',')); ?></td>
    </tr>
    <tr>
        <td>144-168h</td>
        <td><?php echo(number_format($dash["ordersday7"], 0, '.', ',')); ?></td>
        <td><?php echo(number_format($dash["tradesday7"], 0, '.', ',')); ?></td>
        <td><?php echo(number_format($dash["volumeday7"], 0, '.', ',')); ?></td>
        <td><?php echo($unitsymbol . number_format(getPrice($dash["valueday7"]), 2, '.', ',')); ?></td>
    </tr>

    <tr class="active">
        <td>Last 7d</td>
        <td><?php echo(number_format($dash["ordersweek"], 0, '.', ',')); ?></td>
        <td><?php echo(number_format($dash["tradesweek"], 0, '.', ',')); ?></td>
        <td><?php echo(number_format($dash["volumeweek"], 0, '.', ',')); ?></td>
        <td><?php echo($unitsymbol . number_format(getPrice($dash["valueweek"]), 2, '.', ',')); ?></td>

    </tr>
    <tr class="active">
        <td>Last 30d</td>
        <td><?php echo(number_format($dash["ordersmonth"], 0, '.', ',')); ?></td>
        <td><?php echo(number_format($dash["tradesmonth"], 0, '.', ',')); ?></td>
        <td><?php echo(number_format($dash["volumemonth"], 0, '.', ',')); ?></td>
        <td><?php echo($unitsymbol . number_format(getPrice($dash["valuemonth"]), 2, '.', ',')); ?></td>

    </tr>
    <tr class="active">
        <td>Total</td>
        <td><?php echo(number_format($dash["orderstotal"], 0, '.', ',')); ?></td>
        <td><?php echo(number_format($dash["tradestotal"], 0, '.', ',')); ?></td>
        <td><?php echo(number_format($dash["volumetotal"], 0, '.', ',')); ?></td>
        <td><?php echo($unitsymbol . number_format(getPrice($dash["valuetotal"]), 2, '.', ',')); ?></td>

    </tr>
</table>
</div><!--panel-primary ACTIVITY-->

























    <div class="panel panel-primary"> <!--success info primary danger warning -->
    <!-- Default panel contents -->
    <div class="panel-heading">OWNERSHIP - MAJOR HOLDERS</div>
    <table class="table">
    <thead>
    <tr class="active">
        <th>Holder</th>
        <th>Quantity</th>
        <th>Control</th>
    </tr>
    </thead>
    <tbody>


    <?php
    foreach ($ownership as $row)
    { $percentage=($row["quantity"]/$asset["public"])*100;
        echo("<tr>");
        echo("<td>User: <b>" . (number_format($row["id"],0,".",",")) . "</b> (sans orderbook)</td>");
        echo("<td>" . (number_format($row["quantity"],0,".",",")) . "</td>");
        echo("<td>" . (number_format($percentage,2,".",",")) . "%</td>");
        echo("</tr>");
    }

   // if($leftOver>0)
   // {
        $percentage=($leftOver/$asset["public"])*100;
        echo("<tr><td>Other Users</td><td>" . number_format($leftOver, 0, '.', '') . "</td><td>" . (number_format($percentage,2,".",",")) . "%</td>");
   // }

    //if($asset["askstotal"]>0)
    //{
        $percentage=($asset["askstotal"]/$asset["public"])*100;
        echo("<tr><td>Orderbook</td><td>");
        echo((number_format($asset["askstotal"],0,".",",")));
        echo("</td><td>" . (number_format($percentage,2,".",",")) . "%</td></tr>");
    //}
    ?>
    <tr>
        <td colspan="3">
  <div id="piechart" style=""></div>
          
        </td>
    </tr>
    </tbody>


</table>

</div><!--panel-primary orderbook-->









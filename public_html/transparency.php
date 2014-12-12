<?php

// configuration
require("../includes/config.php");

$id = $_SESSION["id"]; //get id from session

        /*
        
        //PORTFOLIO
        //TOTAL SHARES PUBLIC MINUS ORDERBOOK
        $public =	query("SELECT SUM(quantity) AS quantity FROM portfolio WHERE symbol =?", $symbol);	  // query user's portfolio
        if(empty($public[0]["quantity"])){$public[0]["quantity"]=0;}
        $asset["totalportfolio"] = $public[0]["quantity"]; //shares held
        
        //USERS OWNERSHIP
        $usersPortfolio =query("SELECT SUM(`quantity`) AS quantity FROM `portfolio` WHERE (symbol=? AND id=?)", $symbol, $id);	  // query user's portfolio
        $asset["userportfolio"]=$usersPortfolio[0]["quantity"];
        
        //ALL OWNERSHIP FOR PIECHART
        $ownership =query("SELECT SUM(`quantity`) AS quantity, id FROM `portfolio` WHERE (symbol = ?) GROUP BY `id` ORDER BY `quantity` DESC LIMIT 0, 5", $symbol);	  // query user's portfolio

        $ownership2 = ownership($symbol);
        
        //USERS ORDERBOOK
        $askQuantity =	query("SELECT SUM(quantity) AS quantity FROM orderbook WHERE (id=? AND symbol =? AND side='a')", $id, $symbol);	  // query user's portfolio
        if(empty($askQuantity[0]["quantity"])){$askQuantity[0]["quantity"]=0;}
        $askQuantity = $askQuantity[0]["quantity"]; //shares trading
        $asset["userlocked"] = $askQuantity;

        //TOTAL SHARES PUBLIC (ON ORDERBOOK + ON PORTFOLIO)
        $asset["public"] = $asset["askstotal"]+$asset["totalportfolio"];

        $asset["marketcap"] = ($asset["price"] * $asset["issued"]);
        //$dividend =	query("SELECT SUM(quantity) AS quantity FROM history WHERE type = 'dividend' AND symbol = ?", $asset["symbol"]);	  // query user's portfolio
        //$asset["dividend"] = $dividend["dividend"]; //shares actually held public
        $asset["dividend"]=0; //until we get real ones

         //USERS CONTROL
        if($asset["public"]==0){$asset["control"]=0;} //can also use 'issued' for this and the one below as they should in theory be the same
        else{$asset["control"] = (($asset["userportfolio"]+$asset["userlocked"])/$asset["public"])*100; } //based on public
       
        $allStocks =	query("SELECT symbol, quantity FROM portfolio WHERE id = ? ORDER BY symbol ASC", $id);	  // query user's portfolio
        $stocks = [];
        foreach ($allStocks as $row)		// for each of user's stocks
        {
            $stock = [];
            $stock["symbol"] = $row["symbol"];
            $stock["quantity"] = $row["quantity"];
                $askQuantity =	query("SELECT SUM(quantity) AS quantity FROM orderbook WHERE id=? AND symbol =? AND side='a'", $id, $row["symbol"]);	  // query user's portfolio
                if(empty($askQuantity[0]["quantity"])){$askQuantity[0]["quantity"]=0;}
            $stock["locked"] = $askQuantity[0]["quantity"]; //shares trading
            
            $stocks[] = $stock;
        }
    
        $assets =	query("SELECT symbol FROM assets ORDER BY symbol ASC");	  // query user's portfolio
        //$stocks = $infos;
        //apologize(var_dump(get_defined_vars()));
        
        */

?>

<p>Below is a record our financial obligations to our members along with the amount of assets in our full reserve. Our real-time transparency system enables anyone at any time to confirm our solvency and ensure that his or her value is safe.</p>

<table border="3" style="text-align:center;">
<tr>
<td></td>
    <td>BTC</td>
    <td>GOLD/XAU</td>
    <td>SILVER/XAG</td>
    <td>USD</td>
    <td>EUR</td>
    <td>GBP</td>
    <td>CNY</td>
    <td>JPY</td>
<td><strong>TOTAL (USD)</strong></td>
</tr>
<tr>
<td>Assets</td>
    <td>1037.423455</td>
    <td>40.00</td>
    <td>40.00</td>
    <td>172473.63</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td>0.00</td>
    <td><strong>590,613.87</strong></td>
</tr>
<tr>
<td>Obligations</td>
    <td>885.731546</td>
    <td>28.43055</td>
    <td>28.43055</td>
    <td>116883.83</td>
    <td>7448.52</td>
    <td>2927.93</td>
    <td>8303.87</td>
    <td>99332.99</td>
    <td><strong>482,934.71</strong></td>
</tr>
</table>
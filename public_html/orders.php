<?php
require("../includes/config.php");

$id =  $_SESSION["id"];
$title = "Orders";
$limit = "LIMIT 0, 10";
$tabletitle = "Last 10";
$option = '';

if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{
    
    if (isset($_POST["symbol"]))
    {
        $symbol = htmlspecialchars($_POST["symbol"]);
        if (!ctype_alnum($symbol)){apologize("Invalid query!");}
        $option = 'AND symbol = ' + $symbol;
        $limit = ""; $tabletitle = htmlspecialchars($symbol);
    }
    
    
    if (isset($_POST["side"]))
    {
        if($_POST["side"]=='b'){$option = "AND side = 'b'";}
        else{$option = "AND side = 'a'";}
    }
    
    
    if (isset($_POST["cancel"]))
    {
        $uid = $_POST["cancel"];
        if ($uid == 'ALL') 
        { //CANCEL ALL USERS ORDERS
            if (query("UPDATE orderbook SET type = 'cancel' WHERE id = ?", $id) === false) {apologize("Unable to cancel all orders!");}
            
        } 
        else 
        { //CANCEL ONLY 1 ORDER
            if (!ctype_digit($uid)){apologize("Invalid order #");}
            if (query("UPDATE orderbook SET type = 'cancel' WHERE uid = ?", $uid) === false) {apologize("Unable to cancel order!");}
            
        }
    }
    
    
    if (isset($_POST["history"])) 
    {
        $history = $_POST["history"];
        if ($history == "all") {$limit = ""; $tabletitle = "All";}
    }
    
}
/*
else
{

} //else !post , 
*/
$orders = query("SELECT uid, date, symbol, side, type, quantity, price, total FROM orderbook WHERE (id = ? $option) ORDER BY uid DESC", $id);
$ordertotal = query("SELECT SUM(total) AS sumtotal FROM orderbook WHERE (id = ? $option)", $id);
$history = query("SELECT ouid, date, symbol, transaction, total FROM history WHERE (id = ? $option) ORDER BY uid DESC $limit", $id);
render("orders_form.php", ["title" => $title, "tabletitle" => $tabletitle, "orders" => $orders,  "ordertotal" => $ordertotal, "history" => $history]);

?>


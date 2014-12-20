<?php 

require("../includes/config.php");
//apologize(var_dump(get_defined_vars()));
$id = $_SESSION["id"];
$title = "Exchange";


if ($_SERVER["REQUEST_METHOD"] == "POST")// if form is submitted
{

    if(empty($_POST["symbol1"]) || empty($_POST["symbol2"])){apologize("Please fill out all required fields. Asset not selected.");}
    if(empty($_POST["quantity"])){apologize("Please fill out all required fields. Amount not selected.");}
    if(!is_numeric($_POST["quantity"])){apologize("Invalid Quantity");}

    $symbol1 = $_POST["symbol1"];
    $symbol2 = $_POST["symbol2"];
    $amount = (int)$_POST["quantity"];


    try {convertAsset($id, $symbol1, $symbol2, $amount);}
    catch(Exception $e) {apologize($e->getMessage());}


    redirect("trades.php");
}
else
{
    $assets =	query("SELECT symbol, name FROM assets ORDER BY symbol ASC");
    $stocks=[];
    $stocksQ = query("SELECT symbol, quantity FROM portfolio WHERE id = ? ORDER BY symbol ASC", $id);	 
    foreach ($stocksQ as $row)	
    {
        $stock["symbol"] = $row["symbol"];
        $name =	query("SELECT name FROM assets WHERE symbol=?", $stock["symbol"]);
        if(empty($name)){$stock["name"]='';}else{$stock["name"] = $name[0]["name"];}

        $stock["quantity"] = $row["quantity"];

        $askQuantity =	query("SELECT SUM(quantity) AS quantity FROM orderbook WHERE (id=? AND symbol=? AND side='a')", $id, $stock["symbol"]);
        if(empty($askQuantity)){$stock["locked"]=0;}else{$stock["locked"] = (int)$askQuantity[0]["quantity"];}

        $askPrice =	query("SELECT price FROM orderbook WHERE symbol =? AND side='a' ORDER BY price DESC", $stock["symbol"]);
        if(empty($askPrice)){$stock["askprice"]=0;}else{$stock["askprice"] = getPrice($askPrice[0]["price"]);}

        $stocks[] = $stock;
    }

    render("exchange-convert_form.php", [
        "title" => $title,
        "assets" => $assets,
        "stocks" => $stocks
    ]);

}
?>

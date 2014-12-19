
<style>
.nobutton button
    {
        padding:0;
        font-weight: 100;
        border:0;
        background:transparent;
    }
.table, th
    {
        background:white;
        text-align: center;
    }




/*BELOW FOR PICTURE RADIO*/
    label > input{ /* HIDE RADIO */
      display:none;
    }
    label > input + img{ /* IMAGE STYLES */
      cursor:pointer;
      border:5px solid #fff; /*5px solid transparent*/
    }
    label > input:checked + img{ /* (CHECKED) IMAGE STYLES */
      border:5px solid #000; /*f00*/
    }  
/*ABOVE FOR PICTURE RADIO*/
    
  </style>
  





<?php
function colorize($symbol)
{
    $color = '888888';
    if($symbol == 'CNY'){$color = 'ff0000';} //red
    if($symbol == 'EUR'){$color = '000099';} //official euro blue
    if($symbol == 'GBP'){$color = '3355dd';} //blue
    if($symbol == 'INR'){$color = '663300';} //brown
    if($symbol == 'JPY'){$color = 'ffa500';} //orange
    if($symbol == 'USD'){$color = '00ff00';} //green
    if($symbol == 'XBT'){$color = '000000';} //black
    if($symbol == 'XAG'){$color = 'cccccc';} //gray
    if($symbol == 'XAU'){$color = 'ffd700';} //gold

    return($color);
/*CONSTANTS
$unittype = "USD";
$unitdescription = "U.S. Dollar";
$unitdescriptionshort = "Dollar";
$unitsymbol = "$";
$decimalplaces = 2;
*/

    
/*ASSETS
XAU - Gold Ounce AU
XAG - Silver Ounce AG
XBT - Bitcoin NA
USD - US Dollar (United States) $
EUR - Euro (Euro Member Countries) €
GBP - British Pound (United Kingdom) £
INR - Indian Rupee (India) ₹
CHF - Swiss Franc (Switzerland) NA
JPY - Japanese Yen (Japan) ¥
CNY - Chinese Yuan Renminbi (China) ¥
*/
}

?>
<h3>Convert Asset</h3>

<form action="convert.php" method="post">
    <fieldset>


<input type="number" id="quantity" placeholder="Quantity" name="quantity" min="1" required>



<hr>
<h3>FROM</h3>


<!--UNITS-->
<label>
<input type="radio" name="symbol1" value="<?php echo($unittype); ?>" />
<img src="placeholder.php?height=100&width=200&text=<?php echo($unittype); ?>&quantity=<?php echo($units); ?>&price=<?php echo("1"); ?>&backgroundcolor=<?php echo("00ff00"); ?>&fontcolor=ffffff" alt="<?php echo($unittype); ?>" />
</label>

                                <?php

                        if (empty($stocks)) {
                            echo("<option value=''>No Assets Held</option>");
                        } else 
                        {
                            foreach ($stocks as $stock) {
                                $symbol = $stock["symbol"];
                                $symbol = htmlspecialchars($symbol);
                                $quantity = $stock["quantity"];
                                $quantity = htmlspecialchars($quantity);
                                $lockedStock = $stock["locked"];
                                $price=$stock["askprice"];
                                $lockedStock = htmlspecialchars($lockedStock);
                                $color = colorize($symbol);
                                //echo("<option value='" . $symbol . "'>  " . $symbol . " (" . $quantity . "/" . $lockedStock . ")</option>");
                                if($quantity>0)
                                {
                                ?>
                                  <label>
                                    <input type="radio" name="symbol1" value="<?php echo($symbol); ?>" />
                                      <img src="placeholder.php?height=100&width=200&text=<?php echo($symbol); ?>&quantity=<?php echo($quantity); ?>&price=<?php echo($price); ?>&backgroundcolor=<?php echo($color); ?>&fontcolor=ffffff" alt="<?php echo($symbol); ?>" />
                                  </label>
                                <?php
                                }
                            }
                        }
?>
        <br>






<hr>
<h3>TO</h3>


<!--UNITS-->
<label>
<input type="radio" name="symbol2" value="<?php echo($unittype); ?>" />
<img src="placeholder.php?height=100&width=200&text=<?php echo($unittype); ?>&backgroundcolor=<?php echo("00ff00"); ?>&fontcolor=ffffff" alt="<?php echo($unittype); ?>" />
</label>
        <?php

                        if (empty($assets)) {
                            echo("<option value=' '>No Assets</option>");
                        } else 
                        {
                            
                            foreach ($assets as $asset) {
                                $symbol = $asset["symbol"];
                                $symbol = htmlspecialchars($symbol);
                                $color = colorize($symbol);

                                //echo("<option value='" . $symbol . "'>  " . $symbol . "</option>");
                                ?>
                              <label>
                                <input type="radio" name="symbol2" value="<?php echo($symbol); ?>" />
                                  <img src="placeholder.php?height=100&width=200&text=<?php echo($symbol); ?>&backgroundcolor=<?php echo($color); ?>&fontcolor=ffffff" alt="<?php echo($symbol); ?>" />
                              </label>
                            <?php
                            }
                        }
                        ?>
        <br>





<hr>



        <button type="submit" class="btn btn-info">CONVERT</button>


    </fieldset>
</form>

<div style="font-size: xx-small; color:red;">
<?php $commission*=100; echo(number_format($commission, 2, '.', ',') . "% Commission"); ?>
</div>


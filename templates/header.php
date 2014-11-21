<!DOCTYPE html>
<html lang="en">

<style>
    .table {margin-bottom:0;
                        padding-bottom:11px;

    } /*set to 20 in bootstrap*/
    .sitelogo 
    {        float: left; vertical-align: baseline; line-height: 32.6667px;
        padding-bottom:10px;


    /*  
        margin-left: auto;
        margin-right: auto; 
        text-align:center;
        padding-top:20px;
        padding-bottom:2px;*/
    /**/    
    }
    .sitelogo td
    {
        background-color:transparent;
                        padding-bottom:11px;

    }
    .sitenamefont { 
    vertical-align: baseline; 
        font-family: Roboto, Helvetica, sans-serif;
        font-size:xx-large;
        text-shadow: 1px 1px 5px #000;
        display: inline;
                                padding-bottom:11px;

        /*
        font-family:Georgia, "Times New Roman", Times, serif;
        font-size: 15px;
        */

    }
    .titlefont {
    vertical-align: baseline; 
        font-family: Roboto, Helvetica, sans-serif;
        font-size:xx-large;
        text-shadow: 1px 1px 5px #000;
        display: inline;
         float: right;
                                         padding-bottom:11px;

    }
    .navigationBar .btn-default
    { float: right; vertical-align: baseline;

        color: #444;
        background-color: #fff;
        border-color: #f8f8f8;
    }


</style>
<head>
    <?php require("../includes/constants.php"); //global finance constants  ?>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/scripts.js"></script>



    <link href="css/bootstrap.css" rel="stylesheet"/>
    <link href="css/styles.php" rel="stylesheet" media="screen"/>

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div id="page" style="text-align:center">
<div id="top" style="text-align:center">


    <title>
        <?php
        if (isset($title))
        {
            echo(htmlspecialchars($sitename));
            echo(" ");
            echo(htmlspecialchars($title));

        }  ?>
    </title>

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>





    <table class="sitelogo" >
        <tr>
            <td>
                <div class="sitenamefont">
                    <?php echo(htmlspecialchars($sitename)); ?>
               
                &nbsp;&nbsp;<img src="img/logo/<?php //echo($ranimg); ?>1.png" width="18" style="vertical-align: baseline; " />&nbsp;&nbsp;
                </div><!--   sitenamefont  -->
                <div class="titlefont">
                    <?php if (isset($title)){ echo(htmlspecialchars($title));} ?>
                </div><!--titlefont-->
            </td>
        </tr>
    </table>





    <!-- Menu in style.css -->
    <?php
    //SHOW ON LOG IN ARGUMENT FOR MENU AND INFORMATION
    if (isset($_SESSION["id"]))
    {
    $users =query("SELECT id, email, active FROM users WHERE id = ?", $_SESSION["id"]);
    @$userid = $users[0]["id"];
    @$email = $users[0]["email"];
    @$active = $users[0]["active"];
    if($active==1)
    {
         // query cash for template
        $accounts =	query("SELECT units, loan, rate, approved FROM accounts WHERE id = ?", $userid);	 //query db
        @$units = (float)$accounts[0]["units"];
        @$loan = (float)$accounts[0]["loan"];
        @$rate = $accounts[0]["rate"];
        $rate *= 100; //for display as %
        @$approved = $accounts[0]['approved'];	//convert array from query to value
        //0 approved
        //1 unapproved
        //2 pending - not yet implemented
    ?>
    <div class="navigationBar">
        <div class="btn-group">

            <div class="btn-group">
                <div class="input-group">
                    <button id="bankButton" type="button" class="btn btn-default  btn-sm   dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-home"></span>
                        Home
                        <span class="caret"></span>
                    </button>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="accounts.php">Accounts</a></li>
                        <li><a href="portfolio.php">Portfolio</a></li>
                        <li><a href="history.php">History</a></li>
                        <li><a href="change.php">Edit Account</a></li>
                        <!--<li><a href="transfer.php">Transfer </a></li><li><a href="loan.php">Loan</a></li><?php //if ($loan < 0) { //-0.00000001 ?><li><a href="loanpay.php">Pay Loan</a></li> --><?php //} ?>
                    </ul>
                </div>
            </div>

            <div class="btn-group">
                <div class="input-group">
                    <button id="exchangeButton" type="button" class="btn btn-default  btn-sm dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-stats"></span>
                        Exchange
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="instatrade.php">Trade</a></li>
                        <li><a href="exchange.php">Place Order</a></li>
                        <li><a href="orders.php">Orders</a></li>
                        <li><a href="trades.php">Trades</a></li>
                        <li><a href="assets.php">Assets</a></li>
                        <li><a href="information.php">Information</a></li>


                    </ul>
                </div>
            </div>
            <?php if ($_SESSION["id"] == $adminid) { //ADMIN MENU FOR ADMIN?>

                <div class="btn-group">
                    <div class="input-group">
                        <button id="adminButton" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-star"></span>
                            Admin
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="admin_deposit.php">Deposit </a></li>
                            <li><a href="admin_withdraw.php">Withdraw </a></li>
                            <li><a href="admin_activate.php">Activate </a></li>
                            <li><a href="admin_users.php">Users </a></li>
                            <li><a href="admin_offering.php">Offering </a></li>
                            <li><a href="admin_update.php">Update </a></li>
                            <li><a href="_admin.php">Test</a></li>
                            <li><a href="ion/index.html">Ion</a></li>
                            <li><a href="admin/index.html">Admin Dash</a></li>

                            
                        </ul>
                    </div>
                </div>
            <?php } ?>

            <div class="btn-group">
                <div class="input-group">
                    <a href="logout.php"><button type="button" class="btn btn-danger  btn-sm ">
                            <span class="glyphicon glyphicon-off"></span>
                            Log Out</button></a>
                </div>
            </div>


        </div><!--btn-group-->
    </div><!--navigationBar-->




       <?php
    } //if active==1
    ?>


</div> <!--top-->
<div id="middle" style="text-align:center"> <!--placing it here it only shows up when logged on so no box on login screen-->




<table class="table table-condensed" style="margin-bottom:0; text-align: left;">
    <tr>
        <td><strong></strong><?php echo($email) ?> (# <?php echo($userid) ?>)
        <!--<td><?php //echo date("Y-m-d H:i:s"); ?></td> -->
    </tr>
</table>
<?php

//var_dump(get_defined_vars()); //dump all variables anywhere (displays in header)
//include("banner.php");
 } //bracket for the show on log in argument
?>

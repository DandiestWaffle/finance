
<?php
require("../includes/config.php");
$id = $_SESSION["id"];
if ($id != 1) { apologize("Unauthorized!");}

clear_trades();

redirect("index.php");
?>

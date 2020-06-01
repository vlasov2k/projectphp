<?php
include "secure/secure.inc.php";
include "../inc/lib.inc.php";
include "../inc/config.inc.php";

if (isset ($_GET['logout'])) {
    logOut();
}

?>
<!-- <a href = "index.php", link = "home">admin</a> -->
<a href = "index.php">admin</a>
<a href = "add2cat.php">add2cat</a>
<a href = "orders.php">orders</a>
<a href = "adduser.php">adduser</a>
<a href = "../catalog.php">exit</a>
<?





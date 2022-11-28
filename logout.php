<?php
include "Config/Database.php";

$_SESSION = [];
session_unset();
session_destroy();
header("Location: login.php");

?>




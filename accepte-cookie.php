<?php
session_start();
$_SESSION["accepte-cookie"] = true;
header("Location: index.php")
?>

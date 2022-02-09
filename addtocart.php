<?php
include('config.php');
session_start();
if (isset($_POST["btnAddCart"])) {
    $getid = $_POST["txtid"];
    $getname = $_POST["txtname"];
    $getprice = $_POST["txtprice"];
    $getQuantity = $_POST["quantity"];
    $getURL = $_POST["txturl"];
    if (isset($_SESSION["cart"])) {
        $_SESSION["cart"][$getid] = array($getid, $getname, $getprice, $getQuantity);

    } else {
        $_SESSION["cart"][$getid] = array($getid, $getname, $getprice, $getQuantity);
    }
    header("Location: $getURL");
}



?>


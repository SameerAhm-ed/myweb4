<?php
session_start();

if(isset($_POST["btnDelete"]))
{
   $getProductId = $_POST["productId"];
    $getQuantity = $_POST["productQuantity"];
// echo count($_POST["productId"]);

    for ($c=0; $c<count($_POST["productId"]); $c++) 
    {
        foreach ($_SESSION["cart"] as $item) {
            if ($item[0] == $getProductId[$c]) {
                $_SESSION["cart"][$item[0]][3]= $getQuantity[$c];
            }
        }
    }
    header("Location: cartview.php");
    
}


?>
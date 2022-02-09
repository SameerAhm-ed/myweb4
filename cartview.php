<?php
session_start();

include('config.php');

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $getitemdelete = $_GET["id"];
    foreach ($_SESSION["cart"] as $item) {
        if ($item[0] == $getitemdelete) {
            unset($_SESSION["cart"][$getitemdelete]);
        }
    }
}

if (isset($_POST["btnClearAll"])) {
    session_destroy();
}




?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Cart view</title>
</head>

<body>
    <?php
    include('navbar.php');
    $amount = 0;
    ?>
    <form action="update.php" method="POST">
        <div class="container">
            <h2>Items in Your Bag</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Id</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Product Total</th>
                    </tr>
                </thead>
                <?php
                if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) {
                ?>
                    <tbody>
                        <?php
                        $productTotal = 0;
                        foreach ($_SESSION["cart"] as $item) { ?>
                            <tr class="info">
                                <td>
                                    <?php echo $item[0]; ?>
                                    <input type="hidden" name="productId[]" value="<?php echo $item[0]; ?>">
                                </td>
                                <td><?php echo $item[1]; ?></td>
                                <td>
                                    <input type="number" name="productQuantity[]" value="<?php echo $item[3]; ?>">
                                </td>
                                <td><?php echo $item[2]; ?></td>
                                <td><?php
                                    $productTotal = $item[2] * $item[3];
                                    echo $productTotal;
                                    $amount = $amount + $productTotal;
                                    ?>
                                </td>
                                <td>
                                    <a name="btnDelete" href="cartview.php?id=<?php echo $item[0]; ?>" class="btn btn-danger">Delete</a>
                                </td>
                                <td>
                                    <?php

                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                <?php
                }
                ?>

            </table>
        </div>
        <div class="container">
            <table class="table">
                <tbody>
                    <?php
                    if (empty($_SESSION["cart"])) {
                    } else {
                        echo '<tr class="info">';
                        echo '<td style="text-align:right;" colspan="1">';
                        echo '<button name="btnDelete" class="btn btn-primary">Update</button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>

                </tbody>
            </table>
    </form>
    <form action="cartview.php" method="post">
        <table class="table">
            <tbody>
                <?php
                if (empty($_SESSION["cart"])) {
                } else {
                    echo '<tr class="info">';
                    echo '<td style="text-align:right;" colspan="1">';
                    echo '<button name="btnClearAll" class="btn btn-danger">Clear All</button>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>

            </tbody>
        </table>
    </form>
    </div>
    <div class="container">
        <table class="table">
            <tbody>
                <tr class="success">
                    <td></td>
                    <th style="text-align:right;" colspan="3">Amount</th>
                    <td><?= $amount; ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <br><br><br>
    <?php
    if (!empty($_SESSION["cart"])) {
        if (!isset($_SESSION["UserID"])) {
        } else {
    ?>
            <div class="container">
                <h1>Shipping Label</h1>
                <form action="" method="post" class="form-horizontal">
                    <label for="">Name: </label>
                    <input type="text" name="name"><br><br>
                    <label for="">Address: </label>
                    <input type="text" name="address"><br><br>
                    <label for="">Contact: </label>
                    <input type="tel" name="contact" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"><br><br>
                    <input class="btn btn-success" type="button" value="Check Out">
                </form>
            </div>
    <?php
        }
    }
    ?>

</body>

</html>
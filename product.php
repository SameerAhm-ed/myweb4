<?php

include("config.php");
$getid = $_GET["id"];
if(!isset($getid)) {
    header("Location: index.php");  
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Products</title>

    <style>
        .thumbnail {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5);
            transition: 0.3s;
            min-width: 40%;
            border-radius: 5px;
        }

        .thumbnail-description {
            min-height: 40px;
        }

        .thumbnail:hover {
            cursor: pointer;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 1);
        }
    </style>

</head>

<body>
    <?php
    include('navbar.php');
    ?>

    <div class="row">
        <div class="col-md-2">&nbsp;</div>
        <div class="col-md-8">
            <div class="row space-16">&nbsp;</div>
            <div class="row">
                <?php 
                    $qrySearchPro = "select * from tbl_product where product_status = 'Active' AND sub_cat_id = '".$getid."'";  // 0
                    $resultPro = mysqli_query($con, $qrySearchPro);
                    while ($RecordsPro =  mysqli_fetch_assoc($resultPro)) {
                        
                ?>
                <div class="col-sm-4">
                    <div class="thumbnail">
                        <div class="caption text-center">
                            <div class="position-relative">
                                <img src="./product/iphone.png" style="width:200px;height:172px;" />
                            </div>
                            <h4 id="thumbnail-label"><a href="#"><?php echo $RecordsPro["product_name"]; ?></a></h4>
                            <div class="thumbnail-description smaller">Ceramic Shield front
                                Textured matte glass back and
                                stainless steel design</div>
                            </div>
                            <div class="caption card-footer text-center">
                                <ul class="list-inline">
                                    <li><i class="people lighter">Price</i>&nbsp;<?php echo $RecordsPro["product_price"]; ?></li>
                                    <li></li>
                                    <li><a href="#">&nbsp;BUY</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>
            <div class="col-md-2">&nbsp;</div>
        </div>
    </div>

</body>

</html>
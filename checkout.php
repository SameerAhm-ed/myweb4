<?php
session_start();
include('config.php');
date_default_timezone_set("Asia/Karachi");
$dt = date("d-M-Y");
$order_num = date("dmYhis");


//====================

function itemGet()
{
    foreach ($_SESSION["cart"] as $item) { ?>

        <tbody>
            <tr>
                <th scope='row'>1</th>
                <td> <?php echo $item[1]; ?> </td>
                <td> <?php echo $item[3]; ?> </td>
                <td> <?php echo $item[2]; ?> </td>
            </tr>
        </tbody>


<?php
    }
}


if (isset($_POST["btncheck"])) {
    if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) {
        $getName = $_POST["name"];
        $getAddress = $_POST["address"];
        $getContact = $_POST["contact"];

        $qryRecord = "insert into tbl_order (customer_id,order_date,order_num,order_status,shipping_name,shipping_address,shipping_contact) values ('" . $_SESSION["UserID"] . "','" . $dt . "','" . $order_num . "','Pending','" . $getName . "','" . $getAddress . "','" . $getContact . "')";
        $sqlResult = mysqli_query($con, $qryRecord);
        if ($sqlResult) {
            foreach ($_SESSION["cart"] as $item) {
                $qry = "insert into order_detail (customer_id,order_num,product_id,order_quantity,order_price) values ('" . $_SESSION["UserID"] . "','" . $order_num . "','" . $item[0] . "','" . $item[3] . "','" . $item[2] . "')";
                $sqlOrder = mysqli_query($con, $qry);
            }

            require_once "./email/PHPMailer/PHPMailerAutoload.php";

            //==Email Process===================
            $mail = new PHPMailer;
            //Enable SMTP debugging. 
            //$mail->SMTPDebug = 3;                               
            //Set PHPMailer to use SMTP.
            $mail->isSMTP();
            //Set SMTP host name                          
            $mail->Host = "smtp.gmail.com";
            //Set this to true if SMTP host requires authentication to send email
            $mail->SMTPAuth = true;
            //Provide username and password     
            $mail->Username = "sameer901ahmed@gmail.com";
            $mail->Password = "pakistan123pak";
            //If SMTP requires TLS encryption then set it
            $mail->SMTPSecure = "tls";
            //Set TCP port to connect to 
            $mail->Port = 25;

            $mail->From = "sameer901ahmed@gmail.com";
            $mail->FromName = "Softwebpk";

            $mail->addAddress("rexonot916@diolang.com", "My Cart");
            //$mail->AddCC($varEmail,'');

            $mail->isHTML(true);

            $mail->Subject = "Order ";
            $mail->Body = "
				<h1>Order Details</h1>
				<p>'" . $order_num . "'</p>
                <br>
                <table class='table table-dark table-striped'>
                    <thead>
                        <tr>
                            <th scope='col'> #</th>
                            <th scope='col'> Product Name</th>
                            <th scope='col'> Quantity</th>
                            <th scope='col'> Unit Price</th>
                            <th scope='col'> Product Total</th>
                        </tr>
                    </thead>
                    '".itemGet()."'

                </table>
                
                ";

            $mail->AltBody = "This is the plain text version of the email content";
            $mail->send();

            echo "success";
            //==End Email Process===================


            echo "succes";
            unset($_SESSION["cart"]);
        } else {
            echo "Please try again !";
        }
    }
}

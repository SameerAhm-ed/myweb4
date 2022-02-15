<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer/Exception.php');
require('PHPMailer/SMTP.php');
require('PHPMailer/PHPMailer.php');

session_start();
include('config.php');
date_default_timezone_set("Asia/Karachi");
$dt = date("d-M-Y");
$order_num = date("dmYhis");


$msg = "";
$heading = "";
$amount=0;
if (isset($_POST["btncheck"])) {
    if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) {
        $getName = $_POST["name"];
        $getAddress = $_POST["address"];
        $getContact = $_POST["contact"];

        $qryRecord = "insert into tbl_order (customer_id,order_date,order_num,order_status,shipping_name,shipping_address,shipping_contact) values ('" . $_SESSION["UserID"] . "','" . $dt . "','" . $order_num . "','Pending','" . $getName . "','" . $getAddress . "','" . $getContact . "')";
        $sqlResult = mysqli_query($con, $qryRecord);
        if ($sqlResult) {
            $productTotal = 0;
            foreach ($_SESSION["cart"] as $item) {
                $qry = "insert into order_detail (customer_id,order_num,product_id,order_quantity,order_price) values ('" . $_SESSION["UserID"] . "','" . $order_num . "','" . $item[0] . "','" . $item[3] . "','" . $item[2] . "')";
                $sqlOrder = mysqli_query($con, $qry);
                $productTotal = $item[2] * $item[3];
                $amount = $amount + $productTotal;
                
                $msg .= "
                    <tbody>
                        <tr>
                            <th scope='row'>1</th>
                            <td>$item[1]</td>
                            <td>$item[3]</td>
                            <td>$item[2]</td>
                            <td>$productTotal</td>
                        </tr>
                    </tbody>
                ";
            }

            $heading .= "
            <thead>
                <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Name</th>
                    <th scope='col'>Quantity</th>
                    <th scope='col'>Price</th>
                    <th scope='col'>Total</th>
                </tr>
            </thead>";

            $mail = new PHPMailer(true);
            try {            
                //==Email Process===================
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

                $mail->addAddress("samcr891@gmail.com", "My Cart");
                //$mail->AddCC($varEmail,'');

                $mail->isHTML(true);

                $mail->Subject = "Order ";
                $mail->Body = "<h1>Order#: $order_num</h1>
                <table border='1' style='border: 2px solid #96D4D4;border-collapse: collapse;'>
                    $heading
                    $msg

                    <tr>
                        <th colspan='4'>Amount</th>
                        <td>$amount</td>
                    </tr>
                </table>
                
                <h1>Shipping to: </h1><p>$getName .->. $getAddress .->. $getContact</p>
                
                ";

                $mail->AltBody = "This is the plain text version of the email content";
                $mail->send();

                echo "success";
                unset($_SESSION["cart"]);
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

        } else {
            echo "Please try again !";
        }
    }
}

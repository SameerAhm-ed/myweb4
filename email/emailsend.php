<?php

require_once "PHPMailer/PHPMailerAutoload.php";


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
				
				$mail->addAddress("nali01075@gmail.com", "My Cart");
				//$mail->AddCC($varEmail,'');
				
				$mail->isHTML(true);
				
				$mail->Subject = "Order ";
				$mail->Body = "
				<h1>Order Details</h1>
				<p>'".$order_num."'</p>
				
				";
				
				$mail->AltBody = "This is the plain text version of the email content";
				$mail->send();		

				echo "success";
			//==End Email Process===================
			
			
		
			
			
			
			


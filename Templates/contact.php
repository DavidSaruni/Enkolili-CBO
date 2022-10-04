<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	if(isset($_POST['contact'])){
		$name = $_POST['name'];
		$replyto = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];

		//Load phpmailer
		require 'vendor/autoload.php';

		$mail = new PHPMailer(true);                             
	    try {
	        //Server settings
	        $mail->isSMTP();                                     
	        $mail->Host = 'mail.enkolili-cbo.org';                      
	        $mail->SMTPAuth = true;                               
	        $mail->Username = 'system@enkolili-cbo.org';     
	        $mail->Password = 'systemexample';                    
	        $mail->SMTPOptions = array(
	            'ssl' => array(
	            'verify_peer' => false,
	            'verify_peer_name' => false,
	            'allow_self_signed' => true
	            )
	        );                         
	        $mail->SMTPSecure = 'ssl';                           
	        $mail->Port = 465;                                   

			$mail->setFrom('system@enkolili-cbo.org', $name.' Via Contact Enkolili CBO');
	        
	        //Recipients
	        $mail->addAddress('contact@enkolili-cbo.org');              
	        $mail->addReplyTo($replyto);
	       
	        //Content
	        $mail->isHTML(true);                                  
	        $mail->Subject = $subject;
	        $mail->Body    = $message;

	        $mail->send();

	     	header('location: contactus.html');
	    } 
	    catch (Exception $e) {
	       echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
	    }
	}
	header('location: contactus.html');
?>
<?php
if (isset($_POST['submit'])) {
	echo "<p>submitted</p>"; 

$sendersEmail = $_POST['senders-email'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$date = date("m/d/y");

$mail_to_tc = 'tomdcarden@yahoo.com';
$mail_to_admin = 'spn-discussion@lists.sustainabilitypractice.net.';


//$mult_rec .= '
$esubject = 'New Mail from Contact Form';
$emessage  = 'From: ' . $sendersEmail . "\n";
$emessage .= 'Subject: ' . $subject . "\n";
$emessage .= "Message:\n" . $message . " \n\n";

//	$name = $_POST['name'];
	
 
        
	if ($sendersEmail != "" && $sendersEmail != 'Email:') {
		$sendersEmail = filter_var($sendersEmail, FILTER_SANITIZE_EMAIL);
		if (!filter_var($sendersEmail, FILTER_VALIDATE_EMAIL)) {
                $errors .= "$sendersEmail is <strong>NOT</strong> a valid email address.<br/><br/>";
            }
        } else {
            $errors .= 'Please enter your email address.<br/>';
        }
	
	        
	if ($subject != "" && $subject != 'Subject:') {
			$subject = filter_var($subject, FILTER_SANITIZE_STRING);
			if ($subject == "") {
				$errors .= 'Please enter a Subject.<br/>';
			}
		} else {
			$errors .= 'Please enter a Subject.<br/>';
		}	
		
	if ($message != "" && $message != 'Message:') {
			$message = filter_var($message, FILTER_SANITIZE_STRING);
			if ($message == "") {
				$errors .= 'Please enter a Message.<br/>';
			}
		} else {
			$errors .= 'Please enter a Message.<br/>';
		}		

//echo "This is the $name";
	if(!$errors) {
		
		mail($mail_to_tc, $esubject, $emessage);
		//header("Location: http://www.birdycity.com/sent");
		echo '<script>window.location = "http://www.google.com"</script>';
	} else {
		//echo "<p>There were errors</p>";
		//echo $errors;
		header("Location: http://birdy1234.domain.com/email-error.php");
	}



	
}  // END IF SUBMIT




?>
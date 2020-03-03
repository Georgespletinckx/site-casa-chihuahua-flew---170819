<?php
   if(isset($_POST['send'])) {
   // Prepare the email
   $to = 'info@slowdivecasachihuahua.com';
   $subject = 'Message sent from website';
   $name = $_POST['name']; 
   $email_from = $_POST['email']; 
   $message = $_POST['message'];
   $error_message = "";
   $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

   //if(!isset($_POST['name']) ||
     //   !isset($_POST['email']) ||
       // !isset($_POST['message'])) {
        //died('Problem with the form you submitted');       
    //}


if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered is not valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The Name you entered is not valid.<br />';
  }
 
  if(strlen($message) < 2) {
    $error_message .= 'The message you entered is not valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";

$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  


// Send it
  $sent = mail($to, $subject, $message);
  if($sent) {
  echo 'Your message has been sent successfully!';
  } 
  else {
  echo 'Sorry, your message could not send.';
  }
  }

?>
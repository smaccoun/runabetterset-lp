<?php
require('sendgrid-php/sendgrid-php.php');
if($_POST)
{
    $to_email       = "theraccoun@gmail.com"; //Recipient email, Replace with own email here
    $from_email     = 'josh@runabetterset.com'; //from mail, it is mandatory with some hosts and without it mail might endup in spam.

    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {

        $output = json_encode(array( //create JSON data
            'type'=>'error',
            'text' => 'Sorry Request must be Ajax POST'
        ));
        die($output); //exit script outputting json data
    }

    //Sanitize input data using PHP filter_var().
    $user_name      = filter_var($_POST["user_name"], FILTER_SANITIZE_STRING);
    $user_email     = filter_var($_POST["user_email"], FILTER_SANITIZE_EMAIL);
    $iama           = filter_var($_POST["i_am_a"], FILTER_SANITIZE_STRING);
    $phone_number   = filter_var($_POST["phone_number"], FILTER_SANITIZE_NUMBER_INT);
    $subject = 'From RABS.com';
    $message        = filter_var($_POST["msg"], FILTER_SANITIZE_STRING);

    //additional php validation
    if(strlen($user_name)<4){ // If length is less than 4 it will output JSON error.
        $output = json_encode(array('type'=>'error', 'text' => 'Name is too short or empty!'));
        die($output);
    }
    if(!filter_var($phone_number, FILTER_SANITIZE_NUMBER_FLOAT)){ //check for valid numbers in phone number field
        $output = json_encode(array('type'=>'error', 'text' => 'Enter only digits in phone number'));
        die($output);
    }
    if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){ //email validation
        $output = json_encode(array('type'=>'error', 'text' => 'Please enter a valid email!'));
        die($output);
    }
    if(strlen($message)<3){ //check emtpy message
        $output = json_encode(array('type'=>'error', 'text' => 'Too short message! Please enter something.'));
        die($output);
    }

    //email body
    $message_body = "\r\n\r\nName: ".$user_name."\r\nI am a: ". $iama ."\r\nEmail : ".$user_email . "\r\nPhone Number: " . $phone_number . "\r\nMessage: " . $message ;

    //proceed with PHP email.
    $headers = 'From: '. $from_email .'' . "\r\n" .
    'Reply-To: '.$user_email.'' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    $from = new SendGrid\Email(null, $from_email);
    $subject = $subject;
    $to = new SendGrid\Email(null, $to_email);
    $content = new SendGrid\Content("text/plain", $message_body);
    $mail = new SendGrid\Mail($from, $subject, $to, $content);

    $apiKey = getenv('SENDGRID_API_KEY');
    $sg = new \SendGrid($apiKey);

    $response = $sg->client->mail()->send()->post($mail);
    echo $response->statusCode();
    echo $response->headers();
    echo $response->body();

    $output = "Thank you for contacting us. A representative will be with you soon.";
    die($output);

    if(!$response)
    {
        //If mail couldn't be sent output error. Check your PHP email configuration (if it ever happens)
        $output = json_encode(array('type'=>'error', 'text' => 'Could not send mail! Please check your PHP mail configuration.'));
        die($output);
    }else{
        $output = json_encode(array('type'=>'message', 'text' => 'Hi '.$user_name .'. Thank you for your email!'));
        die($output);
    }
}
?>

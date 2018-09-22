<?php

error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields, removes html tags and whitespace.
    $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Check the data.
    if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: http://www.kaggy.pl/index.php?success=-1#contact");
        exit;
    }

    // Set the recipient email address. Update this to YOUR desired email address.
    $recipient = "kaghar@kaggy.pl";

    // Set the email subject.
    $subject = "New contact from $name";

    

    // Build the email content.
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Build the email headers.
    $email_headers = "kaggy@kaggy.pl";

    // Send the email.
    mail($recipient, $subject, $email_content, $email_headers);
    
    // Redirect to the index.html page with success code
    header("Location: http://www.kaggy.pl/index.php?success=1#contact");
}else {
    echo "There was a problem with your submission, please try again.";
}
?>
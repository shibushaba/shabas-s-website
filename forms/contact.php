<?php
// Replace contact@example.com with your real receiving email address
$receiving_email_address = 'shibushabas23@gmail.com';

// Load the PHP Email Form library
if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

$contact = new PHP_Email_Form;
$contact->ajax = true;

$contact->to = $receiving_email_address;
$contact->from_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$contact->from_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$contact->subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);

// Ensure the email and name are not empty
if (!$contact->from_name || !$contact->from_email) {
    die('Invalid input!');
}

// Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
/*
$contact->smtp = array(
  'host' => 'example.com',
  'username' => 'example',
  'password' => 'pass',
  'port' => '587'
);
*/

$contact->add_message($contact->from_name, 'From');
$contact->add_message($contact->from_email, 'Email');
$contact->add_message(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING), 'Message', 10);

echo $contact->send();
?>

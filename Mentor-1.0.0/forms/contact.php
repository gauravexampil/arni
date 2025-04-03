<?php
  // Replace with your actual receiving email address
  $receiving_email_address = 'contact@arnicomputer.com';

  if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
  } else {
    die('Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  // SMTP Configuration for Arni Computer Institute
  $contact->smtp = array(
    'host' => 'smtp.arnicomputer.com', // Use actual SMTP host
    'username' => 'your-email@arnicomputer.com', // Replace with real email
    'password' => 'your-email-password', // Use the correct email password
    'port' => '587', // Usually 587 for TLS, 465 for SSL
    'encryption' => 'tls' // Use 'ssl' if required
  );

  $contact->add_message($_POST['name'], 'From');
  $contact->add_message($_POST['email'], 'Email');
  $contact->add_message($_POST['message'], 'Message', 10);

  echo $contact->send();
?>

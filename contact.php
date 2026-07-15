<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: contact.html'); exit; }
function clean($v){ return trim(str_replace(["","
"], ' ', $v ?? '')); }
if (!empty($_POST['website'] ?? '')) { header('Location: contact.html'); exit; }
$name=clean($_POST['name']??''); $phone=clean($_POST['phone']??''); $email=filter_var($_POST['email']??'', FILTER_SANITIZE_EMAIL); $city=clean($_POST['city']??''); $type=clean($_POST['project_type']??''); $budget=clean($_POST['budget']??''); $timing=clean($_POST['timing']??''); $message=trim($_POST['message']??'');
if (!$name || !$phone || !filter_var($email,FILTER_VALIDATE_EMAIL) || !$message) { http_response_code(400); exit('Please return to the form and complete all required fields.'); }
$to='info@ironoakrenovations.ca'; $subject='New estimate request from '.$name; $body="Name: $name
Phone: $phone
Email: $email
City: $city
Project: $type
Budget: $budget
Timing: $timing

Message:
$message
"; $headers="From: Iron Oak Website <info@ironoakrenovations.ca>
Reply-To: $email
Content-Type: text/plain; charset=UTF-8
";
$sent=mail($to,$subject,$body,$headers);
?><!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><link rel="stylesheet" href="assets/css/style.css"><title>Thank You | Iron Oak Renovations</title></head><body><main class="simple-page"><div class="wrap narrow"><img class="thank-logo" src="assets/images/logo.png" alt="Iron Oak Renovations"><h1><?php echo $sent ? 'Thank you.' : 'We could not send your message.'; ?></h1><p><?php echo $sent ? 'Your estimate request has been sent. We will contact you as soon as possible.' : 'Please call 519-619-9406 or email info@ironoakrenovations.ca.'; ?></p><a class="btn primary" href="index.html">Return Home</a></div></main></body></html>
<?php
  function sendEmail($to, $subject, $body, $from = "info@bctngl.com") {
    $message = "<html><body>";
    $message .= $body;
    $message .= "</body></html>";
    $headers = "From: " . $from . "\r\n" .
      "Reply-To: " . $from . "\r\n" .
      "MIME-Version: 1.0" . "\r\n" .
      "Content-Type: text/html; charset=ISO-8859-1" . "\r\n" .
      "X-Mailer: PHP/" . phpversion();

    mail($to, $subject, $message, $headers);
  }

  if (array_key_exists("to", $_POST) && array_key_exists("subject", $_POST) &&
      array_key_exists("message", $_POST)) {

    // we can send an email, let's check to see if there is a from field (it's optional)
    if (array_key_exists("from", $_POST)) {
      sendEmail($_POST["to"], $_POST["subject"], $_POST["message"], $_POST["from"]);
    } else {
      sendEmail($_POST["to"], $_POST["subject"], $_POST["message"]);
    }

    echo json_encode(array("result" => "OK"));
  } else {
    echo json_encode(array("error" => "Unable to send the email because of missing parameters"));
  }
?>
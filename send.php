<?php
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function insert($name, $datum, $uhrzeit, $text, $server, $user, $pw, $db, $table) {
    // open db connection...
    $mysqli = new mysqli($server, $user, $pw, $db);
    if ($mysqli->connect_errno) {
      require_once "_layouts/dberror.php";
    }
    // avoid sql injection...
    $query = "INSERT INTO " . $table . " (name, datum, zeit, text) VALUES (?, ?, ?, ?)";
    $statement = $mysqli->prepare($query);
    // set the variables...
    $statement->bind_param('ssss', $name,$datum,$uhrzeit,$text);
    // save...
    $statement->execute();
    // and close.
    $mysqli->close();
  }

  function send($name, $text, $server, $port, $user, $from, $to) {
    // create new mailer class
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';

    // set credentials from settings.php
    $mail->Host = $server;
    $mail->Port = $port;
    $mail->Username = $user;
    $mail->Password = "";

    // set the mail headers
    $mail->setFrom($from, 'Feedback-Mail');
    $mail->addAddress($to);

    $mail->Subject = '[Feedback] Neuer Eintrag';
    $mail->Body = "Feedback von: " . $name . ":\n\n" . $text;
    // and send the message.
    if(!$mail->send()) {
      require_once "_layouts/mailerror.php";
    } else {
      require_once "_layouts/success.php";
    }
  }
?>

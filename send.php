<?php
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function insert($name, $datum, $uhrzeit, $text, $sql_server, $sql_user, $sql_pw, $sql_db, $sql_table) {
    // open db connection...
    $mysqli = new mysqli($sql_server, $sql_user, $sql_pw, $sql_db);
    if ($mysqli->connect_errno) {
      require_once "_layouts/dberror.php";
    }
    // avoid sql injection...
    $query = "INSERT INTO " . $sql_table . " (name, datum, zeit, text) VALUES (?, ?, ?, ?)";
    $statement = $mysqli->prepare($query);
    // set the variables...
    $statement->bind_param('ssss', $name,$datum,$uhrzeit,$text);
    // save...
    $statement->execute();
    // and close.
    $mysqli->close();
  }
  

  function send($name, $text, $mail_server, $mail_port, $mail_user, $mail_pw, $sender_mail, $sender_friendlyname, $recipient_mail, $mail_subject) {
    // create new mailer class
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';

    // set credentials from settings.php
    $mail->Host = $mail_server;
    $mail->Port = $mail_port;
    $mail->Username = $mail_user;
    $mail->Password = $mail_pw;

    // set the mail headers
    $mail->setFrom($sender_mail, $sender_friendlyname);
    $mail->addAddress($recipient_mail);
    $mail->Subject = $mail_subject;
    $mail->Body = "Feedback von: " . $name . "\n" . $text;

    // and send the message.
    if(!$mail->send()) {
      require_once "_layouts/mailerror.php";
    } else {
      require_once "_layouts/success.php";
    }
  }
?>

<?php
require_once "settings.php";
require "PHPMailerAutoload.php";
require_once "send.php";

require_once "_includes/header.php";
// define variables and set to empty values
$name = $text = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"]) || empty($_POST["text"])) {
    require_once "_layouts/error.php";
  } else {
    $name = test_input($_POST["name"]);
    $text = test_input($_POST["text"]);
    $datum = date("Y-m-d");
    $uhrzeit = date("H:i");
    insert($name, $datum, $uhrzeit, $text, $sql_server, $sql_user, $sql_pw, $sql_db, $sql_table);
    send($name, $text, $mail_server, $mail_port, $mail_user, $bot_mail, $user_mail);
  }
} else {
  require_once "_layouts/form.php";
}

require_once "_includes/footer.php";

?>

<?php

require_once 'config/connection.php';

$title = $_POST['title'];
$text = $_POST['text'];
$date_time = $_POST['dateTime'];
$modified_date = date('Y-m-d H:i:s', strtotime($date_time));

mysqli_query($connect, query: "INSERT INTO `notes` (`title`, `text`, `dateTime`) VALUES ('$title', '$text', '$modified_date')");

header('Location: /');
?>
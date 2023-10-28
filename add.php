<?php

require_once 'config/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $text = $_POST['text'];
    $dateTime = $_POST['date'];

    mysqli_query($connect, "INSERT INTO `notes` (`title`, `text`, `dateTime`) VALUES ('$title', '$text', '$dateTime')");
    
    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
    header("Location: $redirect");
    exit();
}
?>
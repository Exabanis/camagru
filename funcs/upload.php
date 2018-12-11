<?php
session_start();
require_once('../config/database.php');

if ($_POST['image_data']){
    $timestamp = new DateTime();
    $timestamp = $timestamp->getTimestamp();
    $filename = 'img'.$timestamp.'.png';
    $pic = 'uploads/'.$filename;
    $slie = '../uploads/'.$filename;
    $src = explode(',', $_POST['image_data']);

    $name =$_SESSION['username'];

    try{
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("INSERT INTO `gallery` (`user`, `image`, `date_added`) VALUES ('" . $name . "', '" . $pic . "', CURRENT_TIMESTAMP)");
        file_put_contents($slie, base64_decode($src[1]));
        if ($query->execute())
            header("Location: ../camera.php");
        else
            echo "failure";//session message failure

    } catch(PDOException $e){
        echo "ERROR EXECUTING: \n".$e->getMessage();
    }
} else {
    header("Location: ../camera.php");
}
?>
<!DOCTYPE html>
<HTML>
<head>
    <meta charset="UTF-8">
    <title>Upload picture</title>
    <link rel="stylesheet" href="../css/cam.css">
</head>
<body>
</body>
</HTML>
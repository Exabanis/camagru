<?php
    require_once 'database.php';

    //database creation
    try {
        $dbh = new PDO($DB_DSN1, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE IF NOT EXISTS Camagru";
        $dbh->exec($sql);
        echo "Database created successfully<br>";
    } catch (PDOException $e) {
        echo "ERROR CREATING DB: \n".$e->getMessage();
        exit(1);
    }

    //Tables creation

    //comments
    try {
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `comments` (
            `comment_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `username` varchar(255) NOT NULL,
            `comment` text NOT NULL,
            `image_id` int(255) NOT NULL,
            `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
          )";
        $dbh->exec($sql);
        echo "Comments table created successfully<br>";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage() . "<br>";
    }

    //gallery
    try {
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `gallery` (
            `image_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `image` varchar(255) NOT NULL,
            `user` varchar(255) NOT NULL,
            `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
          )";
        $dbh->exec($sql);
        echo "Gallery table created successfully<br>";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage() . "<br>";
    }

    //likes
    try {
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `likes` (
            `like_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `image_id` int(11) DEFAULT NULL,
            `user` varchar(255) DEFAULT NULL,
            `image` int(11) DEFAULT NULL
          )";
        $dbh->exec($sql);
        echo "Likes table created successfully<br>";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage() . "<br>";
    }

    //users
    try {
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `users` (
            `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `username` varchar(50) NOT NULL,
            `email` varchar(100) NOT NULL,
            `passwd` varchar(255) NOT NULL,
            `token` varchar(50) NOT NULL,
            `varified` varchar(1) NOT NULL DEFAULT '0',
            `mailNotif` int(1) NOT NULL DEFAULT '1'
          )";
        $dbh->exec($sql);
        echo "Users table created successfully<br><br><br>";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage() . "<br><br><br>";
    }

    //create folder for uploaded pictures
    if (!file_exists('../uploads')) {
        mkdir('../uploads', 0777, true);
    }
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <div>
        <button style="width: 200px; height: 60px; background-color: gray; border: solid yellow 5px;"><a href="../index.php"><h2>Start Evaluation</h2></a></button>
    </div>
</body>
</html>
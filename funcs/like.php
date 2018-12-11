<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../config/database.php';
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    if (isset($_GET['type'], $_GET['image_id'])) {

        $type = $_GET['type'];
        $id = $_GET['image_id'];
        $name = $_SESSION['username'];

        switch ($type) {
            case 'image':
            $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            // set the PDO error mode to exception
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $dbh->prepare('SELECT * FROM likes WHERE user=? AND image_id=?');
            $sql->execute(array($_SESSION['username'], $_GET['image_id']));
            if ($sql->rowcount() > 0) {
                $sql = $dbh->prepare('DELETE FROM likes WHERE user=? AND image_id=?');
                $sql->execute(array($_SESSION['username'], $_GET['image_id']));
            } else {
                $sql = $dbh->prepare('INSERT INTO likes (image_id, `user`) VALUES(?, ?)');
                $sql->execute(array($_GET['image_id'], $_SESSION['username']));
            }
        }
        header('location: ../gallery.php');
    }
}




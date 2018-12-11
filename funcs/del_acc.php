<?php
    session_start();
    require_once '../config/database.php';
    $user = $_SESSION['username'];
    try{
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $dbh->prepare("DELETE FROM likes WHERE user = ?");
        $sql->execute(array($user));
        $sql->closeCursor();

        $sql = $dbh->prepare("DELETE FROM comments WHERE username = ?");
        $sql->execute(array($user));
        $sql->closeCursor();

        $sql = $dbh->prepare("DELETE FROM gallery WHERE user = ?");
        $sql->execute(array($user));
        $sql->closeCursor();

        $sql = $dbh->prepare("DELETE FROM users WHERE username = ?");
        $sql->execute(array($user));
        $sql->closeCursor();

        session_destroy();

        header("Location: ../index.php");
    } catch (PDOException $e){
        echo "Error deleting your account".$e->getMessage();
    }
?>
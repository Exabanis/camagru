<?php
    session_start();
    include('../config/database.php');
    $_SESSION['err'] = null;

    $mail = $_POST['Email'];
    try{
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo = $conn->prepare("SELECT username FROM users WHERE email = ? AND varified = ?");
        $pdo->execute(array($mail, '1'));
        $found = $pdo->rowCount();
        
        if ($found == 1)
        {
            
            $pass = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $pass = str_shuffle($pass);
            $pass = substr($pass,0, 8);
            $url = $_SERVER['HTTP_HOST'] . str_replace("forgot.php", "", $_SERVER['REQUEST_URI']);
            reset_password($mail,$pass, $url);

            $hashed = hash("whirlpool", $pass);
            $pdo = $conn->prepare("UPDATE users SET passwd = ? WHERE email = ? AND varified = ?");
            $pdo->execute(array($hashed, $mail, '1'));

            $_SESSION['er'] = "Check Email to change password";
            header('Location: ../login.php');
            
            exit();
        }
        else
        {
            $_SESSION['err'] = "Email incorrect or not found $found";
            header('Location: ../reset.php');
            exit();
        }

    }
    catch(PDOEXCEPTION $e)
    {
        $_SESSION['err'] = "Something went wrong try again later";
        header('Location: ../reset.php');
        exit();
    }

    function reset_password($mail,$pass, $ip)
    {
    
    $to      = $mail; 
    $subject = 'Create New Password'; 

    $message = '
    
    ------------------------
    Email: '.$mail.'
    Password: '.$pass.'
    ------------------------ 
    Please click this link to login into your account:

    http://localhost:8080/camagru/login.php


    http://' .$ip.'login.php'; 
                        
    $headers = 'From:exabanis@camagru.com' . "\r\n";
    mail($to, $subject, $message, $headers); 
    }
?>
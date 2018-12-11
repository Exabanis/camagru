<?php
session_start();
include('../config/database.php');


$_SESSION['er'] = null;
$user = $_POST['username'];
$pwd = $_POST['password'];
$rem = $_POST['remember'];
$pass = hash("Whirlpool", $pwd);

try{
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo = $conn->prepare("SELECT * FROM `users` WHERE (username=?) AND (passwd = ?) AND (varified = 1)");
    $pdo->execute(array($user, $pass));
    $row = $pdo->fetch(PDO::FETCH_ASSOC);
    $found= $pdo->rowCount();
    
    echo $found;
    echo $user;

    if ($found == 1)
    {
       
        $_SESSION['username'] = $row['username'];
        $_SESSION['mail'] = $row['email'];
        $_SESSION['id'] = $row['id'];
        header('Location: ../camera.php');
        exit;
    }
    else
    {
        $_SESSION['er'] = "Wrong credentials or account doesn't exist";
        
       header('Location: ../login.php');
        exit();
    } 
}
catch (PDOEXCEPTION $e)
{
    $_SESSION['er'] = $e; 
    header('Location: ../login.php');
    exit();  
}

$conn = NULL;
?>

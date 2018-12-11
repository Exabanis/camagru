<?php
    session_start();
    include_once('../config/database.php');
    include_once('verify_signup.php');

    $mail = $_POST['Email'];
    $username = $_POST['Username'];
    $pwd = $_POST['Password'];
    $cpwd = $_POST['cPassword'];

    $_SESSION['error'] = null;

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
    {
        $_SESSION['error'] = "Enter a valid Email";
        header("Location: ../register.php");
        exit();
    }
    if (!preg_match("#[a-zA-Z]+#", $pwd))
    {
        $_SESSION['error'] = "Password must contain lower & upper case letters";
        header("Location: ../register.php");
        exit();
    }
    if (!preg_match("#[0-9]+#", $pwd))
    {
        $_SESSION['error'] = "Password must contain at least 1 digit";
        header("Location: ../register.php");
        exit();
    }
    if (strlen($pwd) < 4)
    {
        $_SESSION['error'] = "Password must contain at least 8 characters";
        header("Location: ../register.php");
        exit();
    }
    if (strlen($username) < 4)
    {
        $_SESSION['error'] = "username must contain at least 4 characters";
        header('Location: ../register.php');
        exit();
    }
    if (!preg_match("/^[a-zA-Z0-9]{3,}$/", $username)) 
    {
        $_SESSION['error'] = "Username must contain Lower/Upper case and should have atleast 4 characters";
        header('Location: ../register.php');
        exit();
    }
    if ($pwd != $cpwd)
    {
        $_SESSION['error'] = "Passwords dont match try again";
        header('Location: ../register.php');
        exit();
    }
    $url = $_SERVER['HTTP_HOST'] . str_replace("signup.php", "", $_SERVER['REQUEST_URI']);

    verify_signup($mail, $username, $pwd, $url);

    header("Location: ../register.php");
?>
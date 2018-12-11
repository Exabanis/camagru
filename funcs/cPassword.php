<?php session_start();
    include('../config/database.php');

    $_SESSION['f'] = null;
    $opass = $_POST['oPassword'];
    $pass = $_POST['Password'];
    $cpass = $_POST['cPassword'];

    if ($pass != $cpass)
    {
        $_SESSION['f'] = "Passwords dont match try again ";
        header("Location: ../cPassword.php");
        exit();
    }
    if (!preg_match("#[a-zA-Z]+#", $pass))
    {
        $_SESSION['f'] = "Password shoud contain at least Lowercase, Uppercase";
        header("Location: ../cPassword.php");
        exit();
    }
    if (!preg_match("#[0-9]+#", $pass))
    {
        $_SESSION['f'] = "Password shoud contain at least a digit ";
        header("Location: ../cPassword.php");
        exit();
    }
    if (strlen($pass) < 4)
    {
        $_SESSION['f'] = "Password should contain at least 4 chars";
        header("Location: ../cPassword.php");
        exit();
    }
    $hash_pass = hash("whirlpool", $opass);
    if (isset($_POST['Update'])){
        $user = $_SESSION['username'];

        try{
            $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo = $conn->prepare("SELECT * FROM users WHERE `username` = ?");
            $pdo->execute(array($user));
        }catch(PDOException $e){
            $_SESSION['f'] = "Connection errors in select";
            header("Location: ../cPassword.php");
        }
        $row = $pdo->fetch(PDO::FETCH_ASSOC);

        $pas = $row['passwd'];
        $oldPassword = $_POST['oPassword'];
        $newPassword = $_POST['Password'];
        $oldHash = hash("whirlpool", $oldPassword);
        $newHash = hash("whirlpool", $newPassword);

        if ($oldHash == $pas){
            try{
                $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo = $conn->prepare("UPDATE users SET `passwd` = '$newHash' WHERE `username` = ?");
                $pdo->execute(array($user));
                $_SESSION['f'] = "Password succesfully changed";
                header("Location: ../cPassword.php");
            }catch(PDOException $e){
                $_SESSION['f'] = "Connection errors on update";
                header("Location: ../cPassword.php");
            }
        }
        else{
            $_SESSION['f'] = "Passwords don't match ";
            header("Location: ../cPassword.php");
        }
    }
?>



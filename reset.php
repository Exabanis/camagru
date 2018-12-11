<?php
    session_start();
    require_once('config/database.php');
    if (isset($_SESSION['id']) && !empty($_SESSION['id'])){
        include "head_foot/navigation.html";
    } else {
        header("Location: login.php");
    }
?>
<hr>
<!DOCTYPE html>
<HTML>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <form method="POST" action="funcs/forgot.php" style="max-width:500px;margin:auto">
        <h3>Reset Password<br><br></h3>
        <div class="input-container">
            <i class="fa fa-envelope icon"></i>
            <input class="input-field" type="text" placeholder="Enter Email" name="Email" required>
        </div>
        <button type="submit" class="btn" name="submit">Reset</button>
        <?php
        if(isset($_SESSION['success'])){
            echo $_SESSION['success'];
            $_SESSION['success'] = null;
        }else{
            echo $_SESSION['err'];
            $_SESSION['err'] = null;
        }
        ?>
        <span class="psw">Not yet a member?<a href="index.php">Join Now</a></span>
    </form>
</body>
</HTML>
<hr>
<?php
    include "head_foot/footer.html";
?>

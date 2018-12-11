<?php
    session_start();
    require_once('config/database.php');
    if (isset($_SESSION['id']) && !empty($_SESSION['id'])){
        header("Location: index.php");
    } else {
        include "head_foot/navigationl.html";
    }
?>
<hr>
<!DOCTYPE html>
<HTML>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <form method="post" action="funcs/sign_in.php">
        <div class="input-group">
            <label>Username</label>
                <input type="text" name="username" placeholder="Username" required value="<?php 
            if(isset($_COOKIE['usr'])) echo $_COOKIE['usr']; ?>">
        </div> 
   
        <div class="input-group">
            <label> Password </label>
                <input type="password" name="password" placeholder="Password" required value="<?php 
            if(isset($_COOKIE['passwd'])) echo $_COOKIE['passwd']; ?>">
        </div>

        <div class="input-group">
            <button  type="submit"  class="btn" name="Login"> Login</button>
        </div>

        <?php
            if(isset($_SESSION['er'])){
                echo $_SESSION['er'];
            $_SESSION['er'] = null;
            }
        ?>
 
        <p>
            Forgot Password? <br><a style="padding: 0;" href="reset.php">Reset</a>
        </p>
    </form>
</body>
</HTML>
<hr>
<?php
    include "head_foot/footer.html";
?>

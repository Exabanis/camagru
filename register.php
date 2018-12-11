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
    <title>Register</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>   
    <form method="post" action="funcs/signup.php">
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="Username" placeholder="Username" required>
        </div> 

        <div class="input-group">
            <label>Email</label>
            <input type="text" name="Email" placeholder="Email" required>
        </div>

        <div class="input-group">
            <label> Password </label>
            <input type="password" name="Password" placeholder="Password" required>
        </div>

        <div class="input-group">
            <label>Confirm Password</label>
            <input type="password" name="cPassword" placeholder="Confirm Password" required>
        </div>

        <p>By creating an account you agree to our Terms & Conditions.</p>

        <div class="input-group">
            <button  type="submit"  class="btn" name="Register" >Register <br></button>
            <?php
                if(isset($_SESSION['signup_success'])){
                    echo "Registration successful. Check your email for verification link.";
                    $_SESSION['signup_success'] = null;
                }else{
                    echo $_SESSION['error'];
                $_SESSION['error'] = null;
                }
            ?>
        </div>
    </form>
    <script src=""></script>
</body>
</HTML>
<hr>
<?php
    include "head_foot/footer.html";
?>

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
    <form method="post" action="funcs/cPassword.php?">
        <h3>Update your Password<br><br></h3>

        <div class="input-group">
            <label>Old Password</label>
            <input type="password" name="oPassword" placeholder="Old Password" required>
        </div> 
            <div class="input-group">
            <label>Password</label>
            <input type="password" name="Password" placeholder="New Password" required>
        </div> 
        
        <div class="input-group">
            <label> Confirm Password </label>
            <input type="password" name="cPassword" placeholder="Confirm Password" required>
        </div>

        <div class="input-group">
            <button  type="submit"  class="btn" name="Update" >Update</button>
        </div>
        
        <div>
            <?php
                if(isset($_SESSION['f'])){
                    echo $_SESSION['f'];
                $_SESSION['f'] = null;
                }
            ?>
        </div>
    </form>
</body>
</HTML>
<hr>
<?php
    include "head_foot/footer.html";
?>

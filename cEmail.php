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
    <form method="post" action="funcs/cEmail.php">
        <h3>Update your email<br><br></h3>

        <div class="input-group">
            <label>Old Email</label>
            <input type="text" name="oldMail" placeholder="old Email" required>
        </div> 
    
        <div class="input-group">
            <label> New Email</label>
            <input type="text" name="newMail" placeholder="New Email"  required >
            <div class="input-group">
                <button  type="submit"  class="btn" name="UpdateMail">Update Email</button>
            </div>
        </div>
        <div>
            <?php
                if(isset($_SESSION['y'])){
                    echo $_SESSION['y'];
                    $_SESSION['y'] = null;
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

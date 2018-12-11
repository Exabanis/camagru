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
    <form method="post" action="funcs/cUsername.php">
        <h3>Update Username</h3>
        <div class="input-group">
            <label>Old Username</label>
            <input type="text" name="oldUsername" placeholder="old Username" required>
        </div> 
    
        <div class="input-group">
            <label> New Username </label>
            <input type="text" name="newUsername" placeholder="New Username" required >
        </div>

        <div class="input-group">
            <button  type="submit"  class="btn" name="UpdateUser">Update Username</button>
        </div>

        <div>
            <?php
                if(isset($_SESSION['t'])){
                    echo $_SESSION['t'];
                $_SESSION['t'] = null;
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

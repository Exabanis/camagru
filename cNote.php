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
    <form action="funcs/cNote.php" method="post">
        <p>Would you like to keep receiving notification when you get comments?</p>
        <input type="radio" name="check" value="Yes" checked> Yes <br>
        <input type="radio" name="check" value="No"> No
        <p><input class="camBtn" type="submit" name="submit" value="submit"></p>

        <?php
            if(isset($_SESSION['notif'])){
                echo $_SESSION['notif'];
            $_SESSION['notif'] = null;
            }
        ?>
    </form>
</body>
</HTML>
<hr>
<?php
    include "head_foot/footer.html";
?>

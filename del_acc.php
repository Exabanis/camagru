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
<body style="background-color: pink;">
    <div class="input-group">
        <form action="funcs/del_acc.php" id="commentform" method="POST" style="margin:2%; align: center;">
            <h3> Are you sure? <br><br><h3>
            <button  type="submit"  class="btn" name="Login"> Yes delete </button>
        </form>
    </div>
<script src=""></script>
</body>
</HTML>
<hr>
<?php
    include "head_foot/footer.html";
?>
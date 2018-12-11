<?php
    session_start();
    require_once('config/database.php');
    if (isset($_SESSION['id']) && !empty($_SESSION['id'])){
        include "head_foot/navigation.html";
    } else {
        include "head_foot/navigationl.html";
    }
?>
<hr>
<!DOCTYPE html>
<HTML>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="">
</head>
<body style="background-color: pink;">
    <div>
        <img src="http://churchsermonseriesideas.com/wp-content/uploads/2016/04/WelcomeHome_web.png" width="100%" height="auto">
    </div>
<script src=""></script>
</body>
</HTML>
<hr>
<?php
    include "head_foot/footer.html";
?>
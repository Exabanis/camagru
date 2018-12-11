<?php
    session_start();
    require_once('config/database.php');
    if (isset($_SESSION['id']) && !empty($_SESSION['id'])){
        include "head_foot/navigation.html";
    } else {
        header("Location: login.php");
    }
    $name =$_SESSION['username'];
    $result;

    try{
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $conn->query("SELECT * FROM `gallery` WHERE user = '". $name ."' ORDER BY date_added DESC LIMIT 6 ", PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        echo "ERROR EXECUTING: \n".$e->getMessage();
    }
?>
<hr>
<!DOCTYPE html>
<HTML>
<head>
    <meta charset="UTF-8">
    <title>Camera</title>
    <link rel="stylesheet" href="css/cam.css">
</head>
<body style="background-color: pink;">
    <div class="c_upload">
        <input type="file" name="file" id="file">
    </div>
    <div class="mod_field">
        <div class="c_camera">
            <div class="camField">
                <video id="video" width="400" height="300"></video>
            </div>
            <div class="picField">
                <canvas id="canvas" width="400" height="300"></canvas>
            </div>
            <div id="pose">
                <img id="e1" src="emojis/i1.png" width="45%" height="130px" onclick="insertEmo('e1')" style="margin: 10px 2%;"/>
                <img id="e2" src="emojis/i2.png" width="45%" height="130px" onclick="insertEmo('e2')" style="margin: 10px 2%;"/>
                <img id="e3" src="emojis/i3.png" width="45%" height="130px" onclick="insertEmo('e3')" style="margin: 10px 2%;"/>
                <img id="e4" src="emojis/i4.png" width="45%" height="130px" onclick="insertEmo('e4')" style="margin: 10px 2%;"/>
            </div>
        </div>
        <div class="buts">
            <button id="clear" class="clrBtn" onclick="clearCanvas()">Clear</button>
            <button id="capture" class="capBtn">Capture</button>
            <form action="funcs/upload.php" method="POST">
                <input type="hidden" id="photo" name="image_data">
                <input name="call cam" type="submit" value=" Save pic " id="save" class="camBtn">
            </form>
        </div>
    </div>
    <div id="gallery">
        <?php
        if ($result)
            foreach ($result as $row) {
                ?><img id="e1" src=<?= $row['image']; ?> width="29%" height="auto"><?php
            }
        else
            echo "failure";
        ?>
    </div>
    <script src="js/cam.js"></script>

</body>
</HTML>
<hr>
<?php
    include "head_foot/footer.html";
?>

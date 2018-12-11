<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    session_start();
    require_once('config/database.php');
    if (isset($_SESSION['id']) && !empty($_SESSION['id'])){
        include "head_foot/navigation.html";
    } else {
        include "head_foot/navigationl.html";
    }

    $name = "";
    if(isset($_SESSION['id'])){
        $name = $_SESSION['username'];
    }

    if (isset($_GET['page'])) {
        $curpage = $_GET['page'];
    } else {
        $curpage = 0;
    }

    $result;
    $lyk;
    $pageNum;
    $curpager = $curpage;

    try {
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $count_page = $conn->query("SELECT COUNT(*) FROM `gallery`", PDO::FETCH_ASSOC)->fetchColumn();

        if ($curpage < $count_page && $curpage != -6) {
            $result = $conn->query("SELECT * FROM `gallery` ORDER BY date_added DESC LIMIT 6 OFFSET $curpage", PDO::FETCH_ASSOC)->fetchAll();
        }else if($curpage == -6){
            if ($count_page == 0){
                $curpage = 0;
            }elseif ($count_page % 6 == 0){
                $curpage = $count_page - 6;
            }else{
                $curpage = $count_page - $count_page % 6;
            }
            $result = $conn->query("SELECT * FROM `gallery` ORDER BY date_added DESC LIMIT 6 OFFSET $curpage", PDO::FETCH_ASSOC)->fetchAll();
        }
        else
        {
            $curpage = 0;
            $result = $conn->query("SELECT * FROM `gallery` ORDER BY date_added DESC LIMIT 6 OFFSET $curpage", PDO::FETCH_ASSOC)->fetchAll();
        }

    } catch (PDOException $e) {
        echo "ERROR EXECUTING: \n" . $e->getMessage();
    }

    if ($curpager == 0){
        $pageNum = 1;
    } else {
        $pageNum = intdiv($curpage, 6) + 1;
    }
?>
<hr>
<!DOCTYPE html>
<HTML>
<head>
    <meta charset="UTF-8">
    <title>Gallery</title>
    <link rel="stylesheet" href="css/cam.css">
</head>
<body>
        <?php
            if ($result){
                foreach ($result as $row) {
                    ?><img id="e1" src=<?= $row['image']; ?> width="98%" height="auto"><?php
                    if(isset($_SESSION['id'])){
                        $id = $row['image_id'];
                        $like = $conn->query("SELECT * FROM `likes` WHERE image_id = $id", PDO::FETCH_ASSOC);
                        $like->execute();
                        $liked = $like->rowCount();
                        ?>
<a style="display: inline;" href="funcs/like.php?type=image&image_id=<?php echo $id; ?>"><button>Like</button></a><?php echo "\t".$liked." People liked this";?>
                        <?php if(isset($_SESSION['username']) && $_SESSION['username'] == $row['user']){?>
                        <a style="display: inline;" href="funcs/remove_img.php?type=image&image_id=<?php echo $id; ?>"><button>Delete</button></a>
                        <?php } ?>
                        <form action="funcs/comments.php" id="commentform" method="POST" style="margin:2%;">
                            <input type="hidden" value="<?php echo $id; ?>" name="image_id">
                            <textarea name="comment_txt" placeholder="Comment on this picture"></textarea><br />
                            <input type="submit">
                        </form>
                        <div><table style="border: solid black 2px; margin: 2% 2%; padding: 10px;" width="98%">
                            <tr><td>
                                Comments<br><br>
                            </td></tr>
                            <tr><td>Username</td><td>Comments</td></tr>
                            <?php
                                $comment = $conn->query("SELECT * FROM `comments` WHERE image_id = $id", PDO::FETCH_ASSOC)->fetchAll();
                                foreach($comment as $comm){
                                    ?><tr><td><?php
                                        echo $comm['username']?></td><td><?php echo $comm['comment'];
                                    ?></td></tr><?php
                                }
                            ?> 
                        </table></div>
                <?php }}
            }
        ?>
    <div class="page" style="text-align: center; margin-top: 10px; ">
        <a class="page-link" style="color: black; display: inline;" href="?page=<?php echo $curpage-6?>">&laquo;</a>
        <?php echo "Page ".$pageNum;?>
        <a class="page-link" style="color: black; display: inline;" href="?page=<?php echo $curpage+6?>"> &raquo;</a>
    </div>
<hr>
<?php
    include "head_foot/footer.html";
?>
</body>
</HTML>

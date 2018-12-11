<?php session_start();

    include('../config/database.php');

    $_SESSION['t'] = null;
    $newUser = $_POST['newUsername'];
    $name = $_POST['oldUsername'];

    if (isset($_POST['UpdateUser'])){
        $oldUser = $_SESSION['username'];

        try{
            $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $dbh->prepare("SELECT * FROM users WHERE username = ?");

            $sql->execute(array($oldUser));
        

        }catch(PDOException $e){
            $_SESSION['t'] = "Connection Error on select";
            header("Location: ../cUsername.php");
            exit();
        }

        $row = $sql->fetch(PDO::FETCH_ASSOC);
        $user = $row['username'];

        if ($name == $oldUser){
            try{
                $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = $dbh->prepare("SELECT username FROM users WHERE username = ?");
                $sql->execute(array($newUser));
                $found = $sql->rowCount();
                
                if ($found == 0){
                    $sql = $dbh->prepare("UPDATE comments SET username = ? WHERE username = ?");
                    $sql->execute(array($newUser, $oldUser));
                    $sql = $dbh->prepare("UPDATE gallery SET user =? WHERE user = ?");
                    $sql->execute(array($newUser, $oldUser));
                    $sql = $dbh->prepare("UPDATE likes SET user = ? WHERE user = ?");
                    $sql->execute(array($newUser, $oldUser));
                    $sql = $dbh->prepare("UPDATE users SET username = ? WHERE username = ?");
                    $sql->execute(array($newUser, $oldUser));

                    $_SESSION['t'] = "Username successfully changed " ;
                    header("Location: ../cUsername.php");
                    exit();
                } else {
                    $_SESSION['t'] = "Username Already taken ";
                    header("Location: ../cUsername.php");
                    exit();   
                }
            }catch(PDOException $e){
                $_SESSION['t'] = "Connection errors on update";
                header("Location: ../cUsername.php");
                exit();
            }
        }else{
            $_SESSION['t'] = "Usernames don't match ";
            header("Location: ../cUsername.php");
            exit();
        }
    }
?>
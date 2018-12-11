<?php
    session_start();
    function verify_signup($mail, $username, $password, $ip) {
        $DB_NAME = "camagru";
        $DB_DSN = "mysql:host=localhost;dbname=".$DB_NAME;
        $DB_USER = "root";
        $DB_PASSWORD = "248647";
        
        $mail = strtolower($mail);

        try {
                $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo= $dbh->prepare("SELECT * FROM users WHERE username=? OR email=?");
                $pdo->execute(array($username, $mail));
                $user_exist = $pdo->rowCount();

                if ($user_exist == 1) {
                    $_SESSION['error'] = "Username or Email Already taken";
                    return ;
                }
                $pass = hash("whirlpool", $password);

                $query= $dbh->prepare("INSERT INTO users (username, email, passwd, token) VALUES (?, ?, ?, ?)");
                $token = uniqid(rand(), true);
                $query->execute(array($username, $mail, $pass, $token));

                varification_email($mail, $username, $token, $ip);
                $_SESSION['signup_success'] = true;
                return (0);
                
            
            } catch (PDOException $e) {
                $_SESSION['error'] = "ERROR: $username $mail $token ".$e->getMessage();
        }
    }

    function varification_email($mail, $username, $token, $ip){
        $to      = $mail; // Send email to our user
        $subject = ' Camagru Signup | Verification'; // Give the email a subject 

        $message = '
        
        Welcome to Camagru!
        
        Your account has been created, you can login with your credentials after you have activated your account by clicking the url below.
        
        Please click this link to activate your account:
        http://localhost:8080/camagru/funcs/verify.php?token='.$token.'

        http://' .$ip.'verify.php?token='.$token.'
        

        '; // Our message above including the link
                            
        $headers = 'From:exabanis@camagru.com' . "\r\n"; // Set from headers
        mail($to, $subject, $message, $headers); // Send our email
    }
?>

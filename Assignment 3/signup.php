<!doctype html>
<html lang="en">
<?php
require_once "db_connection.php";
require_once "session_create.php";
?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Jeopardy</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
        <link href="styles/main.css" rel="stylesheet" type="text/css">
        <script src="./javascript/login_check.js"></script>
    </head>
    <body>
        <?php 
            include "navbar.php";
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if(strlen($_POST['email_name']) > 0 && strlen($_POST['pwd']) > 0 && strlen($_POST['last_name']) > 0 && strlen($_POST['first_name']) > 0){ //isset, !empty 
                    $useremail_input = $_POST['email_name'];
                    $userpwd_input = $_POST['pwd'];
                    $userfn_input = $_POST['first_name'];
                    $userln_input = $_POST['last_name'];
                    echo "$useremail_input";
                    echo "$userpwd_input";
                    $txt = "INSERT INTO `user_info` (`email`, `password`, `first_name`, `last_name`) VALUES ('$useremail_input', '$userpwd_input', '$userfn_input', '$userln_input');\n";
                    $myFile = "sql.txt";
                    $db_sql = fopen($myFile, "w") or die("can't open file");
                    fwrite($db_sql, $txt);
                    fclose($db_sql);  
                    $db->query($txt);
                    setcookie('user', $_POST['email_name'], time()+3600); //60min 
                    setcookie('pwd', password_hash($_POST['pwd'], PASSWORD_DEFAULT), time()+3600);
                    header('Location: index.php');
                }
            }
        ?>
        <form class="row g-3 px-4" method="post" action="signup.php">
            <div class="col-6">
                <label class="form-label">First name</label>
                <input type="text" name="first_name" class="form-control form-control-lg" id="inputEmail4" placeholder="John" required="">
            </div>
            <div class="col-6">
                <label for="inputPassword4" class="form-label">Last name</label>
                <input type="text" name="last_name" class="form-control form-control-lg" id="inputPassword4" placeholder="Smith" required="">
            </div>
            <div class="col-6">
                <label class="form-label">Email</label>
                <input type="email" name="email_name" class="form-control form-control-lg" placeholder="email@address.com" required="">
            </div>
            <div class="col-6">
                <label class="form-label">Password</label>
                <input type="password" name = "pwd" class="form-control form-control-lg" placeholder="password" required="">
            </div>
            <div class="d-grid gap-2 py-2">
                <input type="submit" class="btn btn-primary btn-lg" value="Sign up">
            </div> 
        </form>

        <script>
            (function () {
                var highlight = document.getElementById('login-tab');   //anonymous function
                highlight.classList.add('active')
            })();
        </script>

    </body>
</html>
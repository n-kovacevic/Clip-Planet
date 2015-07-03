<?php
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Clip Planet :: Register</title>
        <link rel="stylesheet" type="text/css" href="../css/main.css" />
        <link rel="icon" type="image/png" href="../images/favicon.png"/>
    </head>
    <body>
        <?php
            require_once '../mysql_info.php';
                $link=  mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);

                $username=$_POST["username"];
                $username=  mysqli_escape_string($link, $username);
                $username=  htmlspecialchars($username);

                $password=$_POST["password"];
                $password=  mysqli_escape_string($link, $password);
                $password=  md5($password);

                $email=$_POST["email"];
                $email=  mysqli_escape_string($link, $email);
                
                $result=mysqli_query($link,'select id from users');
                
                $newid=0;
                while(mysqli_fetch_assoc($result)){
                    $newid+=1;
                }
                
                $query='insert into users (id, username, password, email) values ('.$newid.',"'.$username.'", "'.$password.'", "'.$email.'")';
                $res= mysqli_query($link, $query);
                mysqli_close($link);
        ?>
        <header>
            <a href="../index.php"><img src="../images/header.png" alt="Clip World" /></a>
            <div id="search">
                <form method="get" action="search.php">
                    <input type="text" name="q" />
                    <input type="submit" value="Search" />
                </form>
            </div>
        </header>
        <nav>
            <ul>
                <li><a href="../index.php">home</a></li>
                <?php
                if($_SESSION["id"])
                    echo '<li><a href="../profile.php">profile</a></li>
                        <li><a href="../upload.php">upload</a></li>
                        <li><a href="../signout.php">sign out</a></li>';
                else
                    echo '<li><a href="../signin.php">sign in</a></li>
                        <li><a href="../register.php">register</a></li>';
                ?>
            </ul>
        </nav>
        <main>
            <?php
            if($res===TRUE){
                echo '<h1>User '.$username.' registred successfully.</h1>';
                echo '<h1>You can sign in now with you username and password.</h1>';
            }else{
                echo '<h1>Registration was unsuccessfull.</h1>';
            }
            ?>
        </main>
        <footer>
            <p>Nikola Kovačević</p>
        </footer>
    </body>
</html>

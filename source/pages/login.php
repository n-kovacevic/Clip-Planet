<?php
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Clip Planet :: Log in</title>
        <link rel="stylesheet" type="text/css" href="../css/main.css" />
        <link rel="icon" type="image/png" href="../images/favicon.png"/>
    </head>
    <body>
        <?php
            
            require_once '../mysql_info.php';
                $link=  mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);

                $username=$_POST["username"];
                $username=  mysqli_escape_string($link, $username);

                $password=$_POST["password"];
                $password=  mysqli_escape_string($link, $password);
                $password=  md5($password);

                $result= mysqli_query($link, 'select * from users where username="'.$username.'" and password="'.$password.'" limit 1');
                if($res=  mysqli_fetch_assoc($result)){
                    
                    $_SESSION["id"]=$res["id"];
                }
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
            if($_SESSION["id"])
                echo '<h1>User '.$res["username"].' logged in successfully.</h1>';
            else
                echo '<h1>Unsuccessfull login.</h1>';
            ?>
        </main>
        <footer>
            <p>Nikola Kovačević</p>
        </footer>
    </body>
</html>

<?php
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Clip Planet :: Change Password</title>
        <link rel="stylesheet" type="text/css" href="../css/main.css" />
        <link rel="icon" type="image/png" href="../images/favicon.png"/>
    </head>
    <body>
        <?php
            require_once '../mysql_info.php';
                $link=  mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);

                $password=$_POST["password"];
                $password=  mysqli_escape_string($link, $password);
                $password=  md5($password);
                
                $newpass=$_POST["new"];
                $newpass=  mysqli_escape_string($link, $newpass);
                $newpass=md5($newpass);
                
                $id=$_SESSION["id"];

                $out="Something went wrong, password is not updated.";
                $result= mysqli_query($link, 'select * from users where id='.$id.' and password="'.$password.'" limit 1');
                if($res=  mysqli_fetch_assoc($result)){
                    $r=mysqli_query($link, 'update users set password="'.$newpass.'" where id='.$id);
                    if($r==TRUE){
                        $out="Password changed successfully.";
                    }
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
                echo '<h1>'.$out.'</h1>';
            ?>
        </main>
        <footer>
            <p>Nikola Kovačević</p>
        </footer>
    </body>
</html>

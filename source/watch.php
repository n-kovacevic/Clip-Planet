<?php
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Clip Planet</title>
        <link rel="stylesheet" type="text/css" href="css/main.css" />
        <link rel="icon" type="image/png" href="images/favicon.png"/>
    </head>
    <body>
        <?php
            $id= $_GET["id"];
            
            require_once './mysql_info.php';
            
            $link=mysqli_connect($mysql_host, $mysql_user, $mysql_password , $mysql_database);
            
            $result= mysqli_query($link, 'select * from videos where id="'.$id.'" limit 1');
            $res=  mysqli_fetch_assoc($result);
            $userid=$res["user"];
            $users=  mysqli_query($link, 'select username from users where id="'.$userid.'" limit 1');
            $newviews=$res["views"]+1;
            mysqli_query($link, 'update videos set views='.$newviews.' where id='.$id);
            $user= mysqli_fetch_assoc($users);
            $username=$user["username"];
            $title=$res["title"];
            $date=$res["date"];
            $description=$res["description"];
            mysqli_close($link)
        ?>
        <header>
            <a href="http://iswd.nkg5.cf"><img src="./images/header.png" alt="Clip World" /></a>
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
            <div id="description">
                <p>
                <?php
                    echo $description;
                ?>
                </p>
            </div>
            <video height="360" controls>
                <source type="video/mp4" src="video/<?php echo $id ?>.mp4" />
            </video>
            
            <h2><?php echo $title; ?></h2>
            <p id="user">Uploaded by: <?php echo '<a href="./user.php?id='.$userid.'">'.$username.'</a>'; ?></p>
            <p id="upload_date">Upload date: <?php echo $date ?> <img src="images/views.png" /> <?php echo $newviews; ?> </p>
            <div id="botmargin20"></div>
        </main>
        <footer>
            <p>Nikola Kovačević</p>
        </footer>
    </body>
</html>

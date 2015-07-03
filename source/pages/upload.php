<?php
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Clip Planet :: Upload</title>
        <link rel="stylesheet" type="text/css" href="../css/main.css" />
        <link rel="icon" type="image/png" href="../images/favicon.png"/>
    </head>
    <body>
        <?php
            require_once '../mysql_info.php';
            $link=  mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);
            
            $userid=$_SESSION["id"];
            $id=0;
            $ids=  mysqli_query($link, 'select id from videos');
            while($row=  mysqli_fetch_assoc($ids)){
                    $id++;
            }
            $video_dest="../video/".$id.".mp4";
            move_uploaded_file($_FILES["video"]["tmp_name"], $video_dest);
            $icon_name=$_FILES["icon"]["name"];
            $ext=pathinfo($icon_name, PATHINFO_EXTENSION);;
            move_uploaded_file($_FILES["icon"]["tmp_name"], '../video/thumbnails/'.$id.'.'.$ext);
            
            $title=$_POST["title"];
            $desc=$_POST["description"];
            $date=date('Y-m-d');
            $query='insert into videos (id, title, description, user, views, date) values ('.$id.', "'.$title.'", "'.$desc.'", '.$userid.', 0, "'.$date.'")';
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
            <h1>
            <?php
            if($res===TRUE){
                echo 'Video uploaded successfully';
            }else{
                echo 'Video uploaded unsuccessfully'; 
            }
            ?>
            </h1>
        </main>
        <footer>
            <p>Nikola Kovačević</p>
        </footer>
    </body>
</html>

<?php 
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Clip Planet :: Search</title>
        <link rel="stylesheet" type="text/css" href="css/main.css" />
        <link rel="icon" type="image/png" href="images/favicon.png"/>
    </head>
    <body>
       
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
            <h1>Search results for "
                <?php
                    echo $_GET["q"];
                ?>
                ".
            </h1>
            <div id="video_container">
                <?php
                    require_once './mysql_info.php';
                    $link=  mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database,$mysql_port);
                    
                    
                    $q=$_GET["q"];
                    $query='select * from videos where title like "%'.$q.'%" or description like "%'.$q.'%" order by date desc';
                    $result=mysqli_query($link, $query);
                    
                    while($res= mysqli_fetch_assoc($result)){
                        $user= mysqli_query($link, 'select username from users where id="'.$res["user"].'" limit 1');
                        $username= mysqli_fetch_assoc($user);
                        $id=$res["id"];
                        $user=$username["username"];
                        $image=$res["image"];
                        $date=$res["date"];
                        $views=$res["views"];
                        $title=$res["title"];
                        $title=substr($title, 0 , 9);
                        $title= $title . "...";
                        echo  '<article>
                                <a href="watch.php?id='.$id.'"><img src="./video/thumbnails/'.$id.'.png" alt="image"/></a>
                                <div id="info">
                                    <p id="title"><a href="watch.php?id=0">'.$title.'</a></p>
                                    <p id="author"><a href="user.php?id=0">'.$user.'</a></p>
                                    <p id="date">'.$date.'</p>
                                    <p id="views"><img id="view" src="./images/view.png"/>'.$views.'</p>
                                </div>
                                <div id="article_bottom"></div>
                            </article>';
                    }
                    
                    mysqli_close($link);
                ?>
            </div>
        </main>
        <footer>
            <p>Nikola Kovačević</p>
        </footer>
    </body>
</html>

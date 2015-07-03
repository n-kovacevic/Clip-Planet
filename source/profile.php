<?php
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Clip Planet :: Profile</title>
        <link rel="stylesheet" type="text/css" href="css/main.css" />
        <link rel="icon" type="image/png" href="images/favicon.png"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script>
            $("document").ready(function(){
                $("#changePasswordForm").hide();
                $("#changepass").click(function(){
                    $("#changePasswordForm").slideToggle();
                });
            });
        </script>
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
            <?php
                require_once './mysql_info.php';
                $link=  mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);
                $result=mysqli_query($link, 'select * from users where id='.$_SESSION["id"].' limit 1');
                $res=  mysqli_fetch_assoc($result);
                ?>
            <div id="profile">
                <h1>Profile</h1>
                <table id="info">
                    <tr>
                        <td>
                            <p>Username:</p>
                        </td>
                        <td>
                            <?php echo $res["username"]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Password:
                        </td>
                        <td>
                            <input type="button" id="changepass" value="Change" />
                        </td>
                    </tr>
                    <tr id="changePasswordForm">
                        <td colspan="2">
                            <form id="changeform" action="pages/change.php" method="post"></form>
                            <table>
                                <tr>
                                    <td>
                                        <label for="current">Current:</label>
                                    </td>
                                    <td>
                                        <input form="changeform" type="password" name="password" id="current" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="new">New:</label>
                                    </td>
                                    <td>
                                        <input form="changeform" type="password" name="new" id="new" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        <input form="changeform" type="submit" name="submit" id="current"value="Change" />
                                    </td>
                                </tr>
                            </table>
                        </td>
                    
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><?php echo $res["email"]; ?></td>
                    </tr>
                </table>
            </div>
            <?php
                mysqli_close($link);
            ?>
            <div id="botmargin20"></div>
        </main>
        <footer>
            <p>Nikola Kovačević</p>
        </footer>
    </body>
</html>

<?php 
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Clip Planet :: Register</title>
        <link rel="stylesheet" type="text/css" href="css/main.css" />
        <link rel="icon" type="image/png" href="images/favicon.png"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script>
            $("document").ready(function(){
                $("#submit").click(function(event){
                    var password=$("#password").val();
                    var cpassword=$("#cpassword").val();
                    
                    if(password!=cpassword){
                        alert("Passwords don't match");
                        event.preventDefault();
                    }
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
            <form id="user" action="pages/register.php" method="post">
                <table>
                    <tr>
                        <td>
                            <label for="username">Username:</label>
                        </td>
                        <td>
                            <input id="username" type="text" name="username" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="password">Password:</label>
                        </td>
                        <td>
                            <input id="password" type="password" name="password" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="cpassword">Confirm:</label>
                        </td>
                        <td>
                            <input id="cpassword" type="password"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="email">Email:</label>
                        </td>
                        <td>
                            <input id="email" type="email" name="email" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            
                        </td>
                        <td>
                            <input type="submit" id="submit" name="register" value="Register" />
                        </td>
                    </tr>
                </table>
            </form>
        </main>
        <footer>
            <p>Nikola Kovačević</p>
        </footer>
    </body>
</html>

<?php
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Clip Planet :: Upload</title>
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
            <h1>Upload</h1>
            <form id="upload" action="./pages/upload.php" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td><label for="title">Title</label></td>
                        <td>
                            <input type="text" id="title" name="title"/>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="description">Description</label></td>
                        <td>
                            <textarea id="description" name="description"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="video">Video</label></td>
                        <td>
                            <input form="upload" type="file" name="video" id="video" />
                        </td>
                    </tr>
                    <tr>
                        <td><label for="thumbnail">Icon</label></td>
                        <td>
                            <input form="upload" type="file" name="icon" id="thumbnail" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="upload" value="Upload" />
                        </td>
                    </tr>
                </table>
                <div id="botmargin20"></div>
            </form>
        </main>
        <footer>
            <p>Nikola Kovačević</p>
        </footer>
    </body>
</html>

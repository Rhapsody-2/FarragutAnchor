<?php

    ini_set('session.cookie_domain', '.farragutanchor.com');
    session_start();
    if (isset($_SESSION['id'])) {
        header("Location: https://www.farragutanchor.com");
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
        <link rel="icon" href="anchor.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="anchor.ico" type="image/x-icon" />
        <title>FarragutAnchor | Login</title>
        <!-- CSS  -->
        <style>
            body {
                display: flex;
                min-height: 100vh;
                flex-direction: column;
            }
            
            main {
                flex: 1 0 auto;
            }
        </style>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://www.farragutanchor.com/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
        <?php

    if (isset($_GET['registered']) && $_GET['registered']) {
        echo "    <script>" . PHP_EOL;
        echo "        function msg() {" . PHP_EOL;
        echo "          Materialize.toast('You have registered your account! You may now log in.', 5000);" . PHP_EOL;
        echo "        }" . PHP_EOL;
        echo "        window.onload = msg;" . PHP_EOL;
        echo "    </script>" . PHP_EOL;
    }
    
?>
    </head>

    <body>
        <nav>
            <div class="nav-wrapper"> <a href="https://www.farragutanchor.com" class="brand-logo center">Farragut Anchor</a> <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li id="liHome"><a href="https://www.farragutanchor.com">Home</a></li>
                    <li id="liLockers"><a href="https://lockers.farragutanchor.com">Lockers</a></li>
                    <li id="liHallpass"><a href="https://hallpass.farragutanchor.com">Hallpass</a></li>
                    <li id="liFAQ"><a href="https://www.farragutanchor.com/faq">FAQ</a></li>
                    <?php
            
            if (isset($_SESSION['id'])) {
                echo "            <li><a class=\"open-nav\" data-activates=\"slide-out\"><i class=\"material-icons\">account_circle</i></a></li>" . PHP_EOL;
            } else {
                echo "            <li id=\"liLogin\"><a href=\"https://www.farragutanchor.com/login\">Login</a></li>" . PHP_EOL;
            }
            
            ?>
                </ul>
                <ul class="side-nav" id="mobile-demo">
                    <li id="liHome"><a href="https://www.farragutanchor.com">Home</a></li>
                    <li id="liLockers"><a href="https://lockers.farragutanchor.com">Lockers</a></li>
                    <li id="liHallpass"><a href="https://hallpass.farragutanchor.com">Hallpass</a></li>
                    <li id="liFAQ"><a href="https://www.farragutanchor.com/faq">FAQ</a></li>
                    <?php
            
            if (isset($_SESSION['id'])) {
                echo "            <li><a class=\"open-nav\" data-activates=\"slide-out\">Account</a></li>" . PHP_EOL;
            } else {
                echo "            <li id=\"liLogin\"><a href=\"https://www.farragutanchor.com/login\">Login</a></li>" . PHP_EOL;
            }
            
            ?>
                </ul>
            </div></nav>
        <main>
            <h1 style="text-align: center; color: #1B2845">Login</h1>
            <form action="php/login.php" method="post">
                <fieldset style="width: 50%; margin: auto">
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="studentID" id="studentID" type="text" class="validate" required>
                            <label for="studentID">Student ID</label>
                        </div>
                        <div class="input-field col s12">
                            <input name="password" id="password" type="password" class="validate" required>
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <?php include("templates/errors.php"); ?> 
                    <a href="https://www.farragutanchor.com/register">Create an Account</a> </fieldset>
                <p style="text-align: center;">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Login</button>
                </p>
            </form>
        </main>
        <?php
    
    echo file_get_contents("https://www.farragutanchor.com/templates/footer.html");
    
    ?>
            <script>
                document.getElementById("liLogin").classList.add("active");
            </script>
    </body>

    </html>

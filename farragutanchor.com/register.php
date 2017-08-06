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
        <title>FarragutAnchor | Create an Account</title>
        <!-- CSS  -->
        <style>
            h1 {
                text-align: center;
            }
            
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
            <h1 style="text-align: center; color: #1B2845">Create an Account</h1>
            <form method="post" action="php/register.php">
                <fieldset style="width: 50%; margin: auto">
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="studentID" id="studentID" type="text" class="validate" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                            <label for="studentID">Student ID</label>
                        </div>
                        <div class="input-field col s12">
                            <input name="birthDate" id="birthDate" type="text" class="datepicker">
                            <label for="birthDate">Birthdate</label>
                        </div>
                        <div class="input-field col s12">
                            <input name="password" id="password" type="password" class="validate" required>
                            <label for="password">Password</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="confPassword" type="password" class="validate" required>
                            <label for="confPassword">Confirm Password</label>
                        </div>
                    </div>
                    <?php include("templates/errors.php"); ?>
                </fieldset>
                <p style="text-align: center; padding-bottom: 50px;">
                    <button class="btn waves-effect waves-light" name="action" type="submit">Create Account</button>
                </p>
            </form>
        </main>
        <?php
    
    echo file_get_contents("https://www.farragutanchor.com/templates/footer.html");
    
    ?>
            <script>
                var password = document.getElementById("password")
                    , confirm_password = document.getElementById("confPassword");

                function validatePassword() {
                    if (password.value != confirm_password.value) {
                        confirm_password.setCustomValidity("Passwords Don't Match");
                    }
                    else {
                        confirm_password.setCustomValidity('');
                    }
                }
                password.onchange = validatePassword;
                confirm_password.onkeyup = validatePassword;
            </script>
            <script>
                document.getElementById("liLogin").classList.add("active");
            </script>
    </body>

    </html>

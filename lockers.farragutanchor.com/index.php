<?php

    ini_set('session.cookie_domain', '.farragutanchor.com');
    session_start();
    if (!isset($_SESSION['id'])) {
        header("Location: https://www.farragutanchor.com/login");
        exit();
    }

    include("../farragutanchor.com/php/connect.php");
    include("../errors.php");

    if (isset($_POST['wing'])) {
        $locker = 0;
        $next = 0;
        $wing = $_POST['wing'];
        $area = "0";
        if ($wing === "4" || $wing === "7")
            $area = $_POST['wingOptions'];
        if ($wing === "3")
            $area = $_POST['circleOptions'];
        $user = $wing . $area . "00";
        $error = false;
        $sql = "SELECT * FROM lockers WHERE `id`='" . $user . "'";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        $locker = $result['number'];
        $next = $locker + 2;
        if ($_POST['wing'] === "1") {
            // Green down (#1000)
            // 1059-1147
            if ($next % 2 === 0) {
                if ($next > 1146)
                    $next = 1059;
            } else {
                if ($next > 1147)
                    $error = true;
            }
        } else if ($_POST['wing'] === "2") {
            // Orange down (#2000)
            // 2001-2047, 2051-2108
            if ($next % 2 === 0) {
                if ($next > 2046) {
                    if ($next < 2051)
                        $next = 2052;
                    else if ($next > 2108)
                        $next = 2001;
                }
            } else {
                if ($next > 2047) {
                    if ($next < 2051)
                        $next = 2051;
                } else if ($next > 2107)
                    $error = true;
            }
        } else if ($_POST['wing'] === "3") {
            // Circle
            // green (#3400): 3184-3261
            if ($user === "3400") {
                if ($next % 2 === 0) {
                    if ($next > 3260)
                        $next = 3185;
                } else {
                    if ($next > 3261)
                        $error = true;
                }
            // red (#3500): 3121-3183, 3262-3326
            } else if ($user === "3500") {
                if ($next % 2 === 0) {
                    if ($next > 3183) {
                        if ($next < 3262)
                            $next = 3262;
                        else if ($next > 3326)
                            $next = 3121;
                    }
                } else {
                    if ($next > 3183) {
                        if ($next < 3262)
                            $next = 3263;
                    } else if ($next > 3325)
                        $error = true;
                }
            // yellow (#3600): 3059-3120, 3327-3398
            } else if ($user === "3500") {
                if ($next % 2 === 0) {
                    if ($next > 3059) {
                        if ($next < 3327)
                            $next = 3327;
                        else if ($next > 3398)
                            $next = 3059;
                    }
                } else {
                    if ($next > 3120) {
                        if ($next < 3327)
                            $next = 3327;
                    } else if ($next > 3398)
                        $error = true;
                }
            // orange (#3700): 3001-3058, 3399-3442, 3445-3463
            } else if ($user === "3700") {
                if ($next % 2 === 0) {
                    if ($next > 3058) {
                        if ($next > 3442) {
                            if ($next < 3445)
                                $next = 3446;
                            else if ($next > 3462)
                                $next = 3001;
                        } else if ($next < 3399)
                            $next = 3400;
                    }
                } else {
                    if ($next > 3058) {
                        if ($next > 3442) {
                            if ($next > 3463)
                                $error = true;
                            else if ($next < 3445)
                                $next = 3445;
                        } else if ($next < 3399)
                            $next = 3401;
                    }
                }
            }
        } else if ($_POST['wing'] === "4") {
            // Green up
            // front (#4100): 4001-4052, 4090-4163
            if ($user === "4100") {
                if ($next % 2 === 0) {
                    if ($next > 4052) {
                        if ($next < 4090)
                            $next = 4090;
                        else if ($next > 4163)
                            $next = 4001;
                    }
                } else {
                    if ($next > 4052) {
                        if ($next > 4163) {
                            $error = true;
                        } else if ($next < 4090)
                            $next = 4091;
                    } 
                }
            } else {
                // back (#4200): 4053-4089
                if ($next % 2 === 0) {
                    if ($next > 4088)
                        $next = 4053;
                } else {
                    if ($next > 4089)
                        $error = true;
                }
            }
        } else if ($_POST['wing'] === "5") {
            // Red (#5000)
            // 5001-5104
            if ($next % 2 === 0) {
                if ($next > 5104)
                    $next = 5001;
            } else {
                if ($next > 5103)
                    $error = true;
            }
        } else if ($_POST['wing'] === "6") {
            // Yellow (#6000)
            // 6001-6098
            if ($next % 2 === 0) {
                if ($next > 6098)
                    $next = 6001;
            } else {
                if ($next > 6097)
                    $error = true;
            }
        } else if ($_POST['wing'] === "7") {
            // Orange up
            // front (#7100): 7001-7044, 7121-7168
            if ($user === "7100") {
                if ($next % 2 === 0) {
                    if ($next > 7001) {
                        if ($next > 7121)
                            $next = 7121;
                        else if ($next > 7168)
                            $next = 7001;
                    }
                } else {
                    if ($next > 7044) {
                        if ($next < 7121)
                            $next = 7121;
                    } else if ($next > 7168)
                        $error = true;
                }
            // back (#7200): 7045-7120
            } else if ($user === "7200") {
                if ($next % 2 === 0) {
                    if ($next > 7120)
                        $next = 7045;
                } else {
                    if ($next > 7120)
                        $error = true;
                }
            }
        }
        if ($error)
            sendError('Wing ' . $_POST['wing'] . ' out of lockers', 'Student #' . $_SESSION['id'] . ' attempted to claim a locker in wing ' . $_POST['wing'] . ', but it seems no lockers are available.<br><br><div style=\"margin-left: 20px\"><strong>$next</strong>=' . $next . '<br><strong>$user</strong>=' . $user . '</div>');
        $sql = "UPDATE `lockers` SET `number` = '" . $next . "' WHERE `id`=" . $user;
        mysqli_query($conn, $sql);
        $sql = "INSERT INTO `lockers` (`id`, `number`, `wing`, `area`) VALUES ('" . $_SESSION['id'] . "', " . $locker . ", " . $wing . ", " . $area . ")";
        mysqli_query($conn, $sql);
        $_SESSION['locker.number'] = $locker;
        if ($wing === "1") 
            $_SESSION['locker.wing'] = "Green Wing (Downstairs)";
        else if ($wing === "2") {
            $_SESSION['locker.wing'] = "Orange Wing (Downstairs)";
        } else if ($wing === "3") {
            $_SESSION['locker.wing'] = "The Circle (Upstairs)";
        } else if ($wing === "4") {
            $_SESSION['locker.wing'] = "Green Wing (Upstairs)";
        } else if ($wing === "5") {
            $_SESSION['locker.wing'] = "Red Wing";
        } else if ($wing === "6") {
            $_SESSION['locker.wing'] = "Yellow Wing";
        } else if ($wing === "7") {
            $_SESSION['locker.wing'] = "Orange Wing (Upstairs)";
        }
        // Locker area description
        if ($area === "0") {            
            $_SESSION['locker.area'] = "main hallway";
        } else if ($area === "1") {
            $_SESSION['locker.area'] = "front hallway";
        } else if ($area === "2") {
            $_SESSION['locker.area'] = "back hallway";
        } else if ($area === "4") {
            $_SESSION['locker.area'] = "outside Green Wing";
        } else if ($area === "5") {
            $_SESSION['locker.area'] = "outside Red Wing";
        } else if ($area === "6") {
            $_SESSION['locker.area'] = "outside Yellow Wing";
        } else if ($area === "7") {
            $_SESSION['locker.area'] = "outside Orange Wing";
        }

    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
        <link rel="icon" href="anchor.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="anchor.ico" type="image/x-icon" />
        <title>FarragutAnchor | Lockers</title>
        <script>
            function checkOther(checkBox) {
                if (checkBox.selectedIndex === 0 || checkBox.selectedIndex === 2) {
                    document.getElementById("wingsDivOut").style.display = "block";
                    document.getElementById("wingsDivOut").style.marginBottom = "0px";
                    document.getElementById("wingsDivIn").style.display = "inline";
                    document.getElementById("circleDivOut").style.display = "none";
                    document.getElementById("circleDivOut").style.marginBottom = "0";
                    document.getElementById("circleDivIn").style.display = "none";
                } else if (checkBox.selectedIndex === 6) {
                    document.getElementById("wingsDivOut").style.display = "none";
                    document.getElementById("wingsDivOut").style.marginBottom = "0";
                    document.getElementById("wingsDivIn").style.display = "none";
                    document.getElementById("circleDivOut").style.display = "block";
                    document.getElementById("circleDivOut").style.marginBottom = "0px";
                    document.getElementById("circleDivIn").style.display = "inline";
                } else {
                    document.getElementById("wingsDivOut").style.display = "none";
                    document.getElementById("wingsDivOut").style.marginBottom = "0";
                    document.getElementById("wingsDivIn").style.display = "none";
                    document.getElementById("circleDivOut").style.display = "none";
                    document.getElementById("circleDivOut").style.marginBottom = "0";
                    document.getElementById("circleDivIn").style.display = "none";
                }
            }
        </script>
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
            </div>
<?php if (isset($_SESSION['id'])) echo str_replace("(back)", $_SESSION['user.background'], str_replace("(name)", $_SESSION['user.name'], str_replace("(id)", $_SESSION['id'], file_get_contents("../farragutanchor.com/templates/sidebar.html")))); ?>
        </nav>
        <main>
<?php
            
            if (!isset($_SESSION['locker.number']))
                echo file_get_contents("form.html");
            else {
                include("view.php");
            }
            
            ?>
        </main>
        <?php
    
     echo file_get_contents("https://www.farragutanchor.com/templates/footer.html");
    
    ?>
            <script>
                document.getElementById("liLockers").classList.add("active");
            </script>
    </body>

    </html>

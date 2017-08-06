<?php
    
    ini_set('session.cookie_domain', '.farragutanchor.com');
    session_start();
    date_default_timezone_set("America/New_York");
    include("../farragutanchor.com/php/connect.php");
    if (!isset($_SESSION['id'])) {
        header("Location: https://www.farragutanchor.com/login");
        exit();
    }

    if (isset($_POST) && isset($_POST['action'])) {
        if ($_POST['action'] === "out") {
            $from = sanitize($conn, $_POST['teacher']);
            $to = sanitize($conn, $_POST['dest']);
            if (empty($from) || $from === "") {
                if (!isset($_SESSION['error']))
                    $_SESSION['error'] = array();
                $_SESSION['error'][] = "You must include the class you are leaving!";
                header("Location: https://hallpass.farragutanchor.com");
                exit();
            }
            if ($to === "Bathroom") {
                if (isset($_POST['brID'])) {
                    $to = $_POST['brID'] . " bathroom";
                } else {
                    if (!isset($_SESSION['error']))
                        $_SESSION['error'] = array();
                    $_SESSION['error'][] = "You must select the bathroom you are going to!";
                    header("Location: https://hallpass.farragutanchor.com");
                    exit();
                }
            } else if ($to === "Teacher") {
                if (isset($_POST['teacherAuto'])) {
                    $to = $_POST['teacherAuto'];
                } else {
                    if (!isset($_SESSION['error']))
                        $_SESSION['error'] = array();
                    $_SESSION['error'][] = "You must select the teacher whose room you are going to!";
                    header("Location: https://hallpass.farragutanchor.com");
                    exit();
                }
            }
            
            $sql = "INSERT INTO `hallpass.current` (`id`, `teacher`, `dest`) VALUES ('" . $_SESSION['id'] . "', '$from', '$to')";
            mysqli_query($conn, $sql);
            $_SESSION['hp.away'] = true;
            $_SESSION['hp.time'] = time();
        } else {
            $sql = "SELECT * FROM `hallpass.current` WHERE `id`='" . $_SESSION['id'] . "'";
            $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            $sql = "INSERT INTO `hallpass.history` (`id`, `name`, `teacher`, `dest`, `time.out`) VALUES ('" . $_SESSION['id'] . "', '" . $_SESSION['user.name'] . "', '" . $result['teacher'] . "', '" . $result['dest'] . "', '" . date("Y-m-d H:i:s", strtotime($result['time'])) . "')";
            mysqli_query($conn, $sql);
            $sql = "DELETE FROM `hallpass.current` WHERE `id`='" . $_SESSION['id'] . "'";
            mysqli_query($conn, $sql);
            unset($_SESSION['hp.away']);
            unset($_SESSION['hp.time']);
        }
    }

    function sanitize($link, $string) {
        $result = trim($string);
        $result = htmlspecialchars($result);
        $result = mysqli_real_escape_string($link, $result);
        return $result;
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
    <link rel="icon" href="anchor.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="anchor.ico" type="image/x-icon" />
    <title>FarragutAnchor | Hallpass</title>
    <!-- CSS  -->
     <script>
                function checkOther(selectBox) {
                    if (selectBox.selectedIndex === 0) {
                        document.getElementById("br").style.display = "inline";
                        document.getElementById("bathroom").style.display = "block";
                        document.getElementById("bathroom").style.marginBottom = "20px";
                        document.getElementById("othTeacher").style.display = "none";
                        document.getElementById("othTeacherDiv").style.display = "none";
                        document.getElementById("othTeacherDiv").style.marginBottom = "0";
                        document.getElementById("teacherAuto").required = false;
                    }
                    else if (selectBox.selectedIndex === 3) {
                        document.getElementById("othTeacher").style.display = "inline";
                        document.getElementById("othTeacherDiv").style.display = "block";
                        document.getElementById("othTeacherDiv").style.marginBottom = "0px";
                        document.getElementById("br").style.display = "none";
                        document.getElementById("bathroom").style.display = "none";
                        document.getElementById("bathroom").style.marginBottom = "0";
                        document.getElementById("teacherAuto").required = true;
                    }
                    else {
                        document.getElementById("br").style.display = "none";
                        document.getElementById("bathroom").style.display = "none";
                        document.getElementById("bathroom").style.marginBottom = "0";
                        document.getElementById("othTeacher").style.display = "none";
                        document.getElementById("othTeacherDiv").style.display = "none";
                        document.getElementById("othTeacherDiv").style.marginBottom = "0";
                        document.getElementById("teacherAuto").required = false;
                    }
                }
            </script>
    <style>
        customContainer {
            padding-bottom: 300px;
        }
        
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
                echo "                <li><a class=\"open-nav\" data-activates=\"slide-out\"><i class=\"material-icons\">account_circle</i></a></li>" . PHP_EOL;
            } else {
                echo "                <li id=\"liLogin\"><a href=\"https://www.farragutanchor.com/login\">Login</a></li>" . PHP_EOL;
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
                echo "                <li><a class=\"open-nav\" data-activates=\"slide-out\">Account</a></li>" . PHP_EOL;
            } else {
                echo "                <li id=\"liLogin\"><a href=\"https://www.farragutanchor.com/login\">Login</a></li>" . PHP_EOL;
            }
            
            ?>
            </ul>
        </div>
<?php if (isset($_SESSION['id'])) echo str_replace("(back)", $_SESSION['user.background'], str_replace("(name)", $_SESSION['user.name'], str_replace("(id)", $_SESSION['id'], file_get_contents("../farragutanchor.com/templates/sidebar.html")))); ?>
    </nav>
    <main>
<?php 
        
        if (!isset($_SESSION['hp.away']) || !$_SESSION['hp.away'])
            include("templates/signOut.php");
        else
            include("templates/signIn.html");
        
        ?>
    </main>
    <?php
    
    echo file_get_contents("../farragutanchor.com/templates/footer.html");
    
    ?>
    <script>
        document.getElementById("liHallpass").classList.add("active");
    </script>
    <script src="../js/teachers.php"></script>
<?php if (isset($_SESSION['hp.away']) && $_SESSION['hp.away']) echo "    <script src=\"templates/timer.php\"></script>" . PHP_EOL; ?>
</body>

</html>

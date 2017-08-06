<?php ini_set('session.cookie_domain', '.farragutanchor.com'); session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
    <link rel="icon" href="anchor.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="anchor.ico" type="image/x-icon" />
    <title>FarragutAnchor | Home</title>
    <!-- CSS  -->
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
<?php if (isset($_SESSION['id'])) echo str_replace("(back)", $_SESSION['user.background'], str_replace("(name)", $_SESSION['user.name'], str_replace("(id)", $_SESSION['id'], file_get_contents("templates/sidebar.html")))); ?>
    </nav>
    <main>
    
       <h1 style="color: #1B2845">Farragut Anchor</h1>
        <div style="width: 60%; margin: auto">
        <p style="font-size: 28px; text-align: center">This website functions to allow students to more easily get settled into the school year without the long lines that usually precede it.  It is here purely for students' convenience, so if there are any bugs or glitches don't hesitate to <a href="mailto:webmaster@farragutanchor.com">email us</a>. </p>
        </div>
    </main>
    <?php
    
    echo file_get_contents("https://www.farragutanchor.com/templates/footer.html");
    
    ?>
    <script>
        document.getElementById("liHome").classList.add("active");
    </script>
</body>

</html>

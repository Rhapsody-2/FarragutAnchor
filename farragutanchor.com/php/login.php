<?php 

include("connect.php");

if (isset($_POST)) {
    $id = sanitize($conn, $_POST['studentID']);
    $password = sanitize($conn, $_POST['password']);

    if ($id === "") {
        header("Location: https://www.farragutanchor.com/login");
        exit();
    }

    $sql = "SELECT * FROM `accounts` WHERE `id`='" . $id . "'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 0) {
        if (!isset($_SESSION['error']))
                $_SESSION['error'] = array();
        $_SESSION['error'][] = "No account with the ID of '" . $id . "' exists. You can register your ID <a href=\"https://www.farragutanchor.com/register\">here</a>.";
        header("Location: https://www.farragutanchor.com/login");
        exit();
    }
    $result = mysqli_fetch_assoc($result);
    if (password_verify($password, $result['password'])) {
        $_SESSION['user.background'] = $result['backgroundImg'];
        $_SESSION['id'] = $id;
        
        // Get locker num and store in session

        $sql = "SELECT * FROM `students` WHERE `id`='$id'";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));

        $nameFirst = "";
        $nameLast = "";
        
        $temp = explode(" ", $result['name.first']);
        foreach ($temp as $str)
            $nameFirst .= ucfirst($str) . " ";
        $nameFirst = trim($nameFirst);
        
        $temp = explode(" ", $result['name.last']);
        foreach ($temp as $str)
            $nameLast .= ucfirst($str) . " ";
        $nameLast = trim($nameLast);
        
        $_SESSION['user.name'] = $nameFirst . " " . $nameLast;
        $_SESSION['user.grade'] = $result['grade'];
        
        $sql = "SELECT * FROM `lockers` WHERE `id`='$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) !== 0) {
            $result = mysqli_fetch_assoc($result);
            $wing = $result['wing'];
            $area = $result['area'];
            $_SESSION['locker.number'] = $result['number'];
            // Locker wing description
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

        header("Location: https://www.farragutanchor.com");
        exit();
    } else {
        if (!isset($_SESSION['error']))
                $_SESSION['error'] = array();
        $_SESSION['error'][] = "Your student ID or password does not match. If you have forgotten your password, visit the library with your student ID card.";
    }
    
}

mysqli_close($conn);

header("Location: https://www.farragutanchor.com/login");

function sanitize($link, $string) {
  $result = trim($string);
  $result = htmlspecialchars($result);
  $result = mysqli_real_escape_string($link, $result);
  return $result;
}

?>

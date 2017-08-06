<?php 

include("connect.php");

if (isset($_POST)) {
    $id = sanitize($conn, $_POST['studentID']);
    $bd = sanitize($conn, $_POST['birthDate']);
    $password = password_hash(sanitize($conn, $_POST['password']), PASSWORD_DEFAULT);
  
    if (strlen($_POST['password']) < 6) {
        if (!isset($_SESSION['error']))
            $_SESSION['error'] = array();
        $_SESSION['error'][] = "Your password must be at least 6 characters.";
        header("Location: https://www.farragutanchor.com/register");
        exit();
    }
    
    if ($id === "") {
        header("Location: https://www.farragutanchor.com/register");
        exit();
    }
  
    $sql = "SELECT * FROM `accounts` WHERE `id`='" . $id . "'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) === 0) {
        $sql = "SELECT * FROM `students` WHERE `id`='$id'";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        if (strpos($result['birthDate'], date("n/j", strtotime($bd))) !== false) {
            $sql = "INSERT INTO `accounts` (`id`, `password`, `backgroundImg`) VALUES ('$id', '$password', " . rand(1, 10) . ")";
            mysqli_query($conn, $sql);
            header("Location: https://www.farragutanchor.com/login?registered=true");
            exit();
        } else {
            if (!isset($_SESSION['error']))
                $_SESSION['error'] = array();
            $_SESSION['error'][] = "Your student ID or birth date do not match our records. If you believe this is an error, please visit the library with your student ID card.";
        }
    } else {
        if (!isset($_SESSION['error']))
            $_SESSION['error'] = array();
        $_SESSION['error'][] = "That student ID has already been registered. If you have forgotten your password, or you believe this is an error, visit the library with your student ID card.";
    }
}

mysqli_close($conn);

header("Location: https://www.farragutanchor.com/register");

function sanitize($link, $string) {
  $result = trim($string);
  $result = htmlspecialchars($result);
  $result = mysqli_real_escape_string($link, $result);
  return $result;
}

?>

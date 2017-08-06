<?php

ini_set('session.cookie_domain', '.farragutanchor.com');
session_start();

echo "        var sec = " . (time() - $_SESSION['hp.time']) . ";" . PHP_EOL;
echo PHP_EOL;
echo "        var timer = setInterval(function () {" . PHP_EOL;
echo "            document.getElementById(\"seconds\").innerHTML = ++sec % 60;" . PHP_EOL;
echo "            document.getElementById(\"minutes\").innerHTML = parseInt(sec / 60, 10);" . PHP_EOL;
echo "            document.getElementById(\"secondsPlural\").innerHTML = (sec % 60 === 1 ? \"\" : \"s\") ;" . PHP_EOL;
echo "            document.getElementById(\"minutesPlural\").innerHTML = (parseInt(sec / 60, 10) === 1 ? \"\" : \"s\") ;" . PHP_EOL;
echo "        }, 1000);" . PHP_EOL;
echo  PHP_EOL;
echo "        setTimeout(function () {" . PHP_EOL;
echo "            clearInterval(timer);" . PHP_EOL;
echo "        }, 900000);" . PHP_EOL;

?>

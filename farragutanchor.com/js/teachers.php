<?php

include("../php/connect.php");

echo "/*global jQuery,Materialize*/" . PHP_EOL;
echo "var teachers = {" . PHP_EOL;

$sql = "SELECT * FROM teachers";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo "    \"" . $row['name.last'] . ", " . mb_substr($row['name.first'], 0, 1, 'utf-8') . ". (" . $row['area'] . ")\": null," . PHP_EOL;
}
    
echo "};" . PHP_EOL;
echo "(function ($) {" . PHP_EOL;
echo "    $(function () {});" . PHP_EOL;
echo "    $(document).ready(function () {" . PHP_EOL;
echo "        $('input.autocomplete').autocomplete({" . PHP_EOL;
echo "            data: teachers, limit: 3";
echo "        });" . PHP_EOL;
echo "    });" . PHP_EOL;
echo "})(jQuery);" . PHP_EOL;

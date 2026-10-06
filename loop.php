<?php

$count = 1;

while ($count <= 20) {

    echo "$count, ";
    $count++;

}

echo "<br>";

$week = 4;
$day = 7;

for ($i = 1; $i <= $week; $i++) {

    echo "Week $i: <br>";

    for ($k = 1; $k <= $day; $k++) {
        echo "&nbsp; &nbsp;Day $k  <br>";
    }

}

?>
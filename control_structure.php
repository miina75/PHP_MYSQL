<?php

$month = "March";

if ($month == "March")
    echo "It's Spring Time!";

echo "<br>";
$x = 5;
$y = 8;

if ($x > $y) {
    echo "$x is greater than $y";
}

if ($x < $y) {
    echo "$x is less than $y";
}

echo "<br>";
$mark = 45;

if ($mark >= 50)
echo "PASSED";
else
echo "FAILED";

echo "<br>";
$mark = 85;

if ($mark >= 90)
echo "Your grade is A";
elseif ($mark >= 80)
echo "Your grade is B";
else if ($mark >= 70)
echo "Your grade is C";
else if ($mark >= 60)
echo "Your grade is D";
else if ($mark >= 50)
echo "Your grade is E";
else
echo "Your grade is F";

echo "<br>";
$month = "jdfgkdfg";

switch ($month) {
    case "January":
    case "February":
    case "March":
        echo "It's Winter time!";
        break;
    case "April":
    case "May":
    case "June":
        echo "It's Spring time!";
        break;
    case "July":
        echo "It's Summer time!";
        break;
    default:
        echo "Invalid Month";
        break;
}

echo "<br>";


$mark = 65;

switch ($mark) {
case ($mark >= 90):
echo "Your grade is A";
break;
case ($mark >= 80):
echo "Your grade is B";
break;
case ($mark >= 70):
echo "Your grade is C";
break;
case ($mark >= 60):
echo "Your grade is D";
break;
case ($mark >= 50):
echo "Your grade is E";
break;
default:
echo "Your grade is F";

}


echo "<br>";
$fuel = 1;

echo ($fuel <= 1) ? "Fill Tank Now" : "It's Enough Fuel";

echo "<br>";

$mark = 35;
$message = ($mark >= 50) ? "PASSED" : "FAILED";

echo $message


?>
<?php
//q1

$countries = array(
	"Somalia" => array("capital" => "Mogadishu"),
	"Kenya" => array("capital" => "Nairobi"),
	"Ethiopia" => array("capital" => "Addis Ababa"),
	"Egypt" => array("capital" => "Cairo")
);

foreach ($countries as $country => $details) {
	echo "Country: $country, Capital: {$details['capital']}<br>";
}

echo "<br>";

//q2

function getCapital($countryName) {
	global $countries;
	return $countries[$countryName]["capital"] ?? null;
}

echo getCapital("Kenya");

echo "<br>";

//q3

$transcript = [
    "Semester 1" => [
        ["Course" => "python", "CW1" => 10, "MidTerm" => 25, "CW2" => 10, "Final" => 40, "Total" => 85, "Status" => "Pass"],
        ["Course" => "javascript", "CW1" => 9, "MidTerm" => 28, "CW2" => 10, "Final" => 40, "Total" => 85, "Status" => "Pass"],
        ["Course" => "oracle", "CW1" => 9, "MidTerm" => 16, "CW2" => 10, "Final" => 20, "Total" => 55, "Status" => "Pass"],
    ],
    "Semester 2" => [
        ["Course" => "networking", "CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 0,  "Total" => 45, "Status" => "Fail"],
        ["Course" => "flutter", "CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 40, "Total" => 85, "Status" => "Pass"],
        ["Course" => "php & mysql", "CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 40, "Total" => 85, "Status" => "Pass"],
    ],
];

echo "<h3>Question 5</h3>";
echo "<table border='1' cellpadding='6' cellspacing='0'>";
echo "<tr><th>Semester</th><th>Course</th><th>CW1</th><th>MidTerm</th><th>CW2</th><th>Final</th><th>Total</th><th>Status</th></tr>";
foreach ($transcript as $semester => $courses) {
    $first = true;
    foreach ($courses as $c) {
        echo "<tr>";
        if ($first) {
            echo "<td rowspan='" . count($courses) . "'>$semester</td>";
            $first = false;
        }
        foreach ($c as $value) {
            $cellStyle = "";
            if (is_numeric($value) && $value >= 50 && $value <= 60) {
                $cellStyle = "background-color:#fff3cd";
            } elseif (is_numeric($value) && $value < 50) {
                $cellStyle = "background-color:#f8d7da";
            }
            echo "<td style='$cellStyle'>$value</td>";
        }
        echo "</tr>";
    }
}
echo "</table>";


?>
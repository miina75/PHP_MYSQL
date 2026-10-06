<?php
// Q1: one-dimensional array
$numbers = [5, -7, 12, 10, -7, 11, -6, 12, 1, -7, 2, 9];

echo "<h3>Question 1</h3>";
echo "Elements: " . implode(", ", $numbers) . "<br>";

$total = 0; $evenTotal = 0; $oddTotal = 0;
foreach ($numbers as $n) {
    $total += $n;
    if ($n % 2 == 0) $evenTotal += $n;   // -7 % 2 = -1, so negatives work too
    else             $oddTotal  += $n;
}
echo "Total of all elements = $total<br>";
echo "Total of even elements = $evenTotal<br>";
echo "Total of odd elements = $oddTotal<br>";

// minimum and maximum (found manually)
$min = $numbers[0]; $max = $numbers[0];
foreach ($numbers as $n) {
    if ($n < $min) $min = $n;
    if ($n > $max) $max = $n;
}
$minPos = []; $maxPos = [];
foreach ($numbers as $i => $n) {
    if ($n == $min) $minPos[] = $i;
    if ($n == $max) $maxPos[] = $i;
}
echo "Minimum element is $min at positions: " . implode(", ", $minPos) . "<br>";
echo "Maximum element is $max at positions: " . implode(", ", $maxPos) . "<br>";

?>
<hr>
<?php
// Q2: associative array, 2 dimensions
$colors = [
    "Light"  => ["Red" => "Light Red",  "Green" => "Light Green",  "Blue" => "Light Blue"],
    "Normal" => ["Red" => "Normal Red", "Green" => "Normal Green", "Blue" => "Normal Blue"],
    "Dark"   => ["Red" => "Dark Red",   "Green" => "Dark Green",   "Blue" => "Dark Blue"],
];

// background colour for each cell (same row/column names as the array above)
$bg = [
    "Light"  => ["Red" => "#ff9999", "Green" => "#99ff99", "Blue" => "#9999ff"],
    "Normal" => ["Red" => "#ff0000", "Green" => "#00cc00", "Blue" => "#0000ff"],
    "Dark"   => ["Red" => "#800000", "Green" => "#006400", "Blue" => "#000080"],
];

echo "<h3>Question 2</h3>";
echo "<table border='1' cellpadding='6' cellspacing='0'>";
echo "<tr><th></th>";
foreach (array_keys($colors["Light"]) as $col) echo "<th>$col</th>";
echo "</tr>";
foreach ($colors as $rowName => $row) {
    echo "<tr><th>$rowName</th>";
    foreach ($row as $colName => $value) {
        $textColor = ($rowName == "Light") ? "black" : "white";  // keep text readable
        echo "<td style='background:{$bg[$rowName][$colName]}; color:$textColor'>$value</td>";
    }
    echo "</tr>";
}
echo "</table>";

?>
<hr>
<?php
// Q3: 3x3 square array
$a = [
    [2, -6, 8],
    [-6, 1, 6],
    [7, 8, -6],
];
$size = count($a);

$odd = 0; $even = 0; $all = 0;
$rowTotals = array_fill(0, $size, 0);
$colTotals = array_fill(0, $size, 0);
$diag1 = 0; $diag2 = 0;           // main diagonal, anti-diagonal
$min = $a[0][0]; $max = $a[0][0];

for ($i = 0; $i < $size; $i++) {
    for ($j = 0; $j < $size; $j++) {
        $v = $a[$i][$j];
        $all += $v;
        if ($v % 2 == 0) $even += $v; else $odd += $v;
        $rowTotals[$i] += $v;
        $colTotals[$j] += $v;
        if ($i == $j)             $diag1 += $v;
        if ($i + $j == $size - 1) $diag2 += $v;
        if ($v < $min) $min = $v;
        if ($v > $max) $max = $v;
    }
}
$minPos = ""; $maxPos = "";
for ($i = 0; $i < $size; $i++)
    for ($j = 0; $j < $size; $j++) {
        if ($a[$i][$j] == $min) $minPos .= "[$i,$j], ";
        if ($a[$i][$j] == $max) $maxPos .= "[$i,$j], ";
    }
$minCount = substr_count($minPos, "[");
$maxCount = substr_count($maxPos, "[");

$span = $size + 2;
$gray = "style='background:#bbb'";
echo "<h3>Question 3</h3>";
echo "<table border='1' cellpadding='6' cellspacing='0' style='text-align:center'>";
echo "<tr><td colspan='$span'>Total odd elements = $odd</td></tr>";
echo "<tr><td colspan='$span'>Total even elements = $even</td></tr>";

// top line: main diagonal (left), column totals, anti-diagonal (right)
echo "<tr $gray><td>$diag1</td>";
foreach ($colTotals as $c) echo "<td>$c</td>";
echo "<td>$diag2</td></tr>";

// middle: row total | elements | row total
for ($i = 0; $i < $size; $i++) {
    echo "<tr><td>{$rowTotals[$i]}</td>";
    for ($j = 0; $j < $size; $j++) echo "<td>{$a[$i][$j]}</td>";
    echo "<td>{$rowTotals[$i]}</td></tr>";
}

// bottom line: anti-diagonal (left), column totals, main diagonal (right)
echo "<tr $gray><td>$diag2</td>";
foreach ($colTotals as $c) echo "<td>$c</td>";
echo "<td>$diag1</td></tr>";

echo "<tr><td colspan='$span'>Total all elements = $all</td></tr>";
echo "<tr><td colspan='$span'>Min element is: $min in $minCount positions:<br>$minPos</td></tr>";
echo "<tr><td colspan='$span'>Maximum element is: $max in $maxCount positions:<br>$maxPos</td></tr>";
echo "</table>";

?>
<hr>
<?php
// Q4: student records. CA221 appears twice, so duplicate keys would overwrite
// each other. Each record therefore stores its ID as a column value.
$students = [
    ["ID" => "CA221", "Name" => "Mohamed Ahmed Ali", "Phone" => "0648440403", "Address" => "Laba Dhagax, Wardhiigley"],
    ["ID" => "CA223", "Name" => "Ahmed Abdi Jama",   "Phone" => "0647223201", "Address" => "Taleex, Hodan"],
    ["ID" => "CA221", "Name" => "Amina Nur Adan",    "Phone" => "0646990276", "Address" => "Macmacaanka, Dharkeynley"],
];

echo "<h3>Question 4</h3>";
echo "<table border='1' cellpadding='6' cellspacing='0'>";
echo "<tr style='background:#ddd'><th></th><th>Name</th><th>Phone</th><th>Address</th></tr>";
foreach ($students as $s) {
    echo "<tr>";
    echo "<td style='background:#ddd'>{$s['ID']}</td>";
    echo "<td>{$s['Name']}</td><td>{$s['Phone']}</td><td>{$s['Address']}</td>";
    echo "</tr>";
}
echo "</table>";

?>
<hr>
<?php
// Q5: transcript grouped by semester
$transcript = [
    "Semester 1" => [
        ["Course" => "subject1", "CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 40, "Total" => 85, "Status" => "Pass"],
        ["Course" => "subject2", "CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 40, "Total" => 85, "Status" => "Pass"],
        ["Course" => "subject3", "CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 40, "Total" => 85, "Status" => "Pass"],
    ],
    "Semester 2" => [
        ["Course" => "subject1", "CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 0,  "Total" => 45, "Status" => "Fail"],
        ["Course" => "subject2", "CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 40, "Total" => 85, "Status" => "Pass"],
        ["Course" => "subject3", "CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 40, "Total" => 85, "Status" => "Pass"],
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
        foreach ($c as $value) echo "<td>$value</td>";
        echo "</tr>";
    }
}
echo "</table>";

?>
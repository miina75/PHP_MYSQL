<!DOCTYPE html>
<html>
<head>
    <title>My First PHP Page</title>
</head>
<body>

<h1><?php echo "Hello, world!"; ?></h1>

<?php
// Variables
$name = "Amina";
$year = date("Y");

echo "<p>Welcome, $name. The year is $year.</p>";

// A loop
for ($i = 1; $i <= 10; $i++) {
    echo "<p>This is line number  $i</p>";
}

// A condition
$hour = (int) date("H");
if ($hour < 12) {
    echo "<p>Good morning!</p>";
} else {
    echo "<p>Good afternoon!</p>";
}
?>

</body>
</html>
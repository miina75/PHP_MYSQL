<?php

// Question 1: program to find the greatest and smallest number among three numbers.
$number1 = 15;
$number2 = 8;
$number3 = 23;

$greatest = $number1;
$smallest = $number1;

if ($number2 > $greatest) {
	$greatest = $number2;
}
if ($number3 > $greatest) {
	$greatest = $number3;
}

if ($number2 < $smallest) {
	$smallest = $number2;
}
if ($number3 < $smallest) {
	$smallest = $number3;
}

echo "Numbers: $number1, $number2, $number3<br>";
echo "Greatest: $greatest<br>";
echo "Smallest: $smallest";

echo "<br>";

echo "------------------------------------------------------------------------------------";


// Question 2: program to check if a number is divisible by 3 and 5.

$numberToCheck = 15;

if ($numberToCheck % 3 === 0 && $numberToCheck % 5 === 0) {
	echo "<br>$numberToCheck is divisible by both 3 and 5.";
} elseif ($numberToCheck % 3 === 0) {
	echo "<br>$numberToCheck is divisible by 3.";
} elseif ($numberToCheck % 5 === 0) {
	echo "<br>$numberToCheck is divisible by 5.";
} else {
	echo "<br>$numberToCheck is divisible by neither 3 nor 5.";
}

echo "<br>";

echo "------------------------------------------------------------------------------------";


// Question 3: odd numbers from 2-20 and even numbers from 35-7.

echo "<br>Odd numbers from 2 to 20: ";
for ($number = 2; $number <= 20; $number++) {
	if ($number % 2 !== 0) {
		echo "$number ";
	}
}

echo "<br>Even numbers from 35 to 7: ";
for ($number = 35; $number >= 7; $number--) {
	if ($number % 2 === 0) {
		echo "$number ";
	}
}

echo "<br>";

echo "------------------------------------------------------------------------------------";


// Question 4: numbers divisible by both 2 and 5 from 50-2.

echo "<br>Numbers divisible by both 2 and 5 from 50 to 2: ";
for ($number = 50; $number >= 2; $number--) {
	if ($number % 2 === 0 && $number % 5 === 0) {
		echo "$number ";
	}
}

echo "<br>";

echo "------------------------------------------------------------------------------------";


// Question 5: Reverse number,

$numberToReverse = 12345;
$originalNumber = $numberToReverse;
$reversedNumber = 0;

while ($numberToReverse !== 0) {
	$lastDigit = $numberToReverse % 10;
	$reversedNumber = $reversedNumber * 10 + $lastDigit;
	$numberToReverse = (int) ($numberToReverse / 10);
}

echo "<br>Reverse of $originalNumber: $reversedNumber";

echo "<br>";

echo "------------------------------------------------------------------------------------";


// Question 6: Find the LCM of two numbers

$firstNumber = 8;
$secondNumber = 12;
$candidateLcm = $firstNumber;

if ($secondNumber > $candidateLcm) {
	$candidateLcm = $secondNumber;
}

while ($candidateLcm % $firstNumber !== 0 || $candidateLcm % $secondNumber !== 0) {
	$candidateLcm++;
}

echo "<br>LCM of $firstNumber and $secondNumber: $candidateLcm";

echo "<br>";

echo "------------------------------------------------------------------------------------";


// Question 7: Find the HCF of two numbers
    
$hcfFirstNumber = 18;
$hcfSecondNumber = 24;
$firstRemainder = abs($hcfFirstNumber);
$secondRemainder = abs($hcfSecondNumber);

if ($firstRemainder === 0 && $secondRemainder === 0) {
	echo "<br>HCF is undefined for 0 and 0.";
} else {
	while ($secondRemainder !== 0) {
		$remainder = $firstRemainder % $secondRemainder;
		$firstRemainder = $secondRemainder;
		$secondRemainder = $remainder;
	}

	echo "<br>HCF of $hcfFirstNumber and $hcfSecondNumber: $firstRemainder";
}

echo "<br>";

echo "------------------------------------------------------------------------------------";


//question 9: Check if a number is prime or not

$numberToTest = 29;
$isPrime = $numberToTest >= 2;

for ($divisor = 2; $isPrime && $divisor * $divisor <= $numberToTest; $divisor++) {
	if ($numberToTest % $divisor === 0) {
		$isPrime = false;
	}
}

if ($isPrime) {
	echo "<br>$numberToTest is prime.";
} else {
	echo "<br>$numberToTest is non-prime.";
}


echo "<br>";

echo "------------------------------------------------------------------------------------";


// Question 10:  prime numbers from 10-50.

echo "<br>Prime numbers from 10 to 50: ";
for ($candidate = 10; $candidate <= 50; $candidate++) {
	$isPrime = true;
	for ($divisor = 2; $divisor * $divisor <= $candidate; $divisor++) {
		if ($candidate % $divisor === 0) {
			$isPrime = false;
			break;
		}
	}

	if ($isPrime) {
		echo "$candidate ";
	}
}

echo "<br>";

echo "------------------------------------------------------------------------------------";


//question 8: multiplation table

echo "<h4>Multiplication Table</h4>";

$limit = 12;

echo "<table border='1' cellpadding='5' cellspacing='0'>";

for ($row = 1; $row <= $limit; $row++) {
    echo "<tr>";

    for ($column = 1; $column <= $limit; $column++) {
        echo "<td>" . ($row * $column) . "</td>";
    }

    echo "</tr>";
}

echo "</table>";

?>
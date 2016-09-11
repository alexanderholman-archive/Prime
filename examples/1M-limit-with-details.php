<?php

require_once '../prime.class.php';

use \alexanderholman\prime as prime;

print "<h1>Prime example</h1>";

prime::setTestLimit( 1000000 );

$prime = new prime( prime::BUILD_PRIME_NUMBERS );

print "<p><b>A total of " . $prime->getPrimeNumberCount() . " prime numbers have been found up to " . prime::getTestLimit() . " in " . number_format( $prime->getLastBuildPrimeNumbersTime(), 3 ) . " seconds (" . $prime->getCheckCount() . " checks)</b></p>";
print "<p>The first prime number found is " . $prime->getPrimeNumbers()[0] . "</p>";
print "<p>The 2nd prime number is " . $prime->getNthPrimeNumber( 2 ) . "</p>";
print "<p>The 3rd prime number is " . $prime->getNthPrimeNumber( 3 ) . "</p>";
print "<p>The 10th prime number is " . $prime->getNthPrimeNumber( 10 ) . "</p>";
print "<p>The 25th prime number is " . $prime->getNthPrimeNumber( 25 ) . "</p>";
print "<p>The 50th prime number is " . $prime->getNthPrimeNumber( 50 ) . "</p>";
print "<p>The 100th prime number is " . $prime->getNthPrimeNumber( 100 ) . "</p>";
print "<p>The 1000th prime number is " . $prime->getNthPrimeNumber( 1000 ) . "</p>";
print "<p>The last prime number found is " . $prime->getPrimeNumbers()[ $prime->getPrimeNumberCount() - 1 ] . "</p>";
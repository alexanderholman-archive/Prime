<?php

require_once 'prime.class.php';

use \alexanderholman\prime as prime;

print "<h1>Prime example</h1>";

prime::setTestLimit( 100000 );

$prime = new prime( prime::BUILD_PRIME_NUMBERS );

print "<p><b>A total of " . $prime->getPrimeNumberCount() . " prime numbers have been found up to " . prime::getTestLimit() . " in " . $prime->getLastBuildPrimeNumbersTime() . " seconds</b></p>";
print "<p>The 1st prime number is " . $prime->getNthPrimeNumber( 1 ) . "</p>";
print "<p>The 2nd prime number is " . $prime->getNthPrimeNumber( 2 ) . "</p>";
print "<p>The 3rd prime number is " . $prime->getNthPrimeNumber( 3 ) . "</p>";
print "<p>The 10th prime number is " . $prime->getNthPrimeNumber( 10 ) . "</p>";
print "<p>The 25th prime number is " . $prime->getNthPrimeNumber( 25 ) . "</p>";
print "<p>The 50th prime number is " . $prime->getNthPrimeNumber( 50 ) . "</p>";
print "<p>The 100th prime number is " . $prime->getNthPrimeNumber( 100 ) . "</p>";
print "<p>The 1000th prime number is " . $prime->getNthPrimeNumber( 1000 ) . "</p>";
print "<h2>Found prime numbers:</h2>";
print "<p>";
foreach ( $prime->getPrimeNumbers() as $i => $primeNumber )
{
    if ( $i > 0 ) print ", ";
    print $primeNumber;
}
print "</p>";
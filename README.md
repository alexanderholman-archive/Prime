# Prime
A PHP class for building an array of prime numbers that allows you to then check if a number is prime or to find an nth prime number

## Getting started
Start by including the class `prime.class.php`, however you choose. In the example found in `./examples/1M-limit-with-details.php`:
```
require_once 'path/to/prime.class.php'
```
Start by initializing the class and building the array, you can do that by either:
```
$prime = new \alexanderholman\prime();
$prime->buildPrimeNumbers();
```
Or you can autocomplete on `__construct()`:
```
$prime = new \alexanderholman\prime( prime::BUILD_PRIME_NUMBERS );
```
From there you can call an nth prime number:
```
$prime->getNthPrimeNumber( $nth-term ) // where $nth-term in an integer
```

## Contributing
Contributions are more that welcome by anyone! Just fork it and make your suggestions, I'll run some benchmarks, and ANY improvements will be accepted

## Issues
Please create a new issue [here](https://github.com/alexanderholman/prime/issues), vulnerabilities too, the best way to get me to fix an issue is to let me know about it!
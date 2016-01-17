<?php

function odd( $n ){
    return ( $n%2 ) ? true : false;
}

$t = 3600;
$p = []; //prime numbers found
$np = [];
$d = [ 1 ]; //dividers
$l = 10000; //limit
$f = 2; //first
$c = 0; //prime count
$ce = isset( $_REQUEST[ 'ce' ] ) && ( strtolower( $_REQUEST[ 'ce' ] ) == 'true' || strtolower( $_REQUEST[ 'ce' ] ) == '1' ) ? $_REQUEST[ 'ce' ] : false; //check evens
$st = 0; //start time
$et = 0; //end time
$dnp = false;

set_time_limit( $t );

$st = microtime( 1 );

for ( $i = $f; $i <= $l; $i++ ) {
    $dva = false;
    if ( !$ce && $i <= 2 ) {
        //is 1 or 2 and prime
    } else if ( odd( $i ) === true || $ce ) {
        foreach ( ( $c > 50000 ? array_slice( $d, 0, ( count( $d ) * 0.001 ) ) :
            ( $c > 10000 ? array_slice( $d, 0, ( count( $d ) * 0.005 ) ) :
                ( $c > 1000 ? array_slice( $d, 0, ( count( $d ) * 0.1 ) ) :
                    ( $c > 100 ? array_slice( $d, 0, ( count( $d ) * 0.3 ) ) :
                        ( $c > 10 ? array_slice( $d, 0, ( count( $d ) * 0.5 ) ) : $d )
                    )
                )
            )
        ) as $dv ) {
        //foreach ( $d as $dv ) {
            if ( $dv > 1 && $dv !== $i ) {
                $dvd = $i / $dv;
                if ( floor( $dvd ) == $dvd ) {
                    $dva = true;
                    if ( $dnp ) $np[ $i ][] = $dv;
                }
            }
        }
    } else if ( odd( $i ) === false || $ce ) {
        $dva = true;
    }
    if ( $dva === false ) {
        $c++;
        if ( !in_array( $i, $d ) ) $d[] = $i;
        if ( !in_array( $i, $p ) ) $p[] = $i;
        if ( isset( $_REQUEST[ 'n' ] ) && $_REQUEST[ 'n' ] == $c && $n = $_REQUEST[ 'n' ] ) die( "the nth primer number when n is $n is $i" );
    }
}

$et = microtime( 1 );

$output = "There are $c prime numbers bewteen $f and $l. They are:\n\r";
foreach( $p as $k => $pn ) {
    if ( $k > 0 ) $output .= ", ";
    $output .= $pn;
}
$output .= "\n\rFinding these numbers took " . ( $et - $st ) . " seconds";
$output .= "\n\rEven numbers were" . ( !$ce ? "n't" : "" ) . " checked";
print "<h1>Prime Numbers</h1>" . nl2br( $output );

if ( $dnp ) {

    $snp = [];
    $doutput = "";
    foreach ( $np as $key => $npfs ) {
        if ( count( $npfs ) === 1 && !in_array( $npfs[ 0 ], $snp ) ) {
            $snp[] = $npfs [ 0 ];
            if ( $doutput != "" ) $doutput .= ", ";
            $doutput .= $npfs[0];
        }
    }
    print "<h1>Primes used as divisors</h1>";
    print nl2br( "The are " . ( $ce ? count( $snp ) : count( $snp ) + 1 ) . " prime numbers used as divisors between $f and $l. They are:\n\r$doutput" );

}
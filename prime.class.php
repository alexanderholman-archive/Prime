<?php

namespace alexanderholman;

class prime {

    const DO_NOTHING = 0;

    const BUILD_PRIME_NUMBERS = 1;

    private $ConstructionJobs = [
        self::DO_NOTHING => '',
        self::BUILD_PRIME_NUMBERS => 'buildPrimeNumbers'
    ];

    private $PrimeNumbers = [ 2 ];
    
    private $PrimeNumberCount = 1;

    private $NonePrimeNumbers = [];

    private $NonePrimeNumberCount = 0;

    private $DividerNumbers = [];
    
    private $StartTime = null;
    
    private $EndTime = null;
    
    private static $Workers = [];
    
    private static $TimeLimit = 3600;
    
    private static $TestLimit = 10000;
    
    private static $StartingFrom = 3;

    private function NumberIsDivisibleByDivider( int $Number, int $Divider ) : bool
    {
        return !( $Number%$Divider );
    }

    /**
     * @param int $Number
     * @return bool
     */
    private function isEven( int $Number ) : bool
    {
        return $this->NumberIsDivisibleByDivider( $Number, 2 );
    }

    /**
     * @param int $Number
     * @return bool
     */
    private function isOdd( int $Number ) : bool
    {
        return !$this->isEven( $Number );
    }

    private function getDividersFormNumber( int $Number ) : array
    {
        return $this->DividerNumbers;
    }
    
    public function __construct( int $ConstructionJob = self::DO_NOTHING )
    {
        if ( isset( $this->ConstructionJobs[ $ConstructionJob ] ) && method_exists( $this, $this->ConstructionJobs[ $ConstructionJob ] ) ) call_user_func( array( $this, $this->ConstructionJobs[ $ConstructionJob ] ) );
    }

    public function isPrime( int $Number, bool $CheckKnown = false ) : bool
    {

        $TotalCount = $this->PrimeNumberCount + $this->NonePrimeNumberCount;
        if ( $CheckKnown || $Number <= $TotalCount )
        {
            foreach ( $this->PrimeNumbers as $PrimeNumber )
            {
                if ( $PrimeNumber === $Number ) return true;
            }
            if ( $Number <= $this->PrimeNumberCount + $this->NonePrimeNumberCount ) return false;
        }
        if ( $Number < 1 ) return false;
        if ( $Number > 2 && $this->isEven( $Number ) ) return false; # If $Number is even: Then $Number is divisible by 2 and therefore is not prime
        $Dividers = $this->getDividersFormNumber( $Number );
        if ( count( $Dividers ) )
        {
            foreach ( $Dividers as $Divider )
            {
                if ( $this->NumberIsDivisibleByDivider( $Number, $Divider ) ) return false;
            }
        }
        return true;
    }

    public function buildPrimeNumbers()
    {
        set_time_limit( static::$TimeLimit );
        $this->StartTime = microtime( true );
        for ($Number = static::$StartingFrom; $Number <= static::$TestLimit; $Number++ )
        {
            if ( $this->isPrime( $Number ) )
            {
                $this->PrimeNumberCount++;
                $this->PrimeNumbers[] = $Number;
                $this->DividerNumbers[] = $Number;
            }
            else
            {
                $this->NonePrimeNumberCount++;
                $this->NonePrimeNumbers = $Number;
            }
        }
        $this->EndTime = microtime( true );
    }

    public function getPrimeNumbers() : array
    {
        return $this->PrimeNumbers;
    }

    public function getNthPrimeNumber( $N ) : int
    {
        $i = $N - 1;
        return isset( $this->PrimeNumbers[ $i ] ) ? $this->PrimeNumbers[ $i ] : 0;
    }

    public function getPrimeNumberCount() : int
    {
        return $this->PrimeNumberCount;
    }

    public function getLastBuildPrimeNumbersTime() : float
    {
        return $this->EndTime - $this->StartTime;
    }

    public static function getWorkers()
    {
        return static::$Workers;
    }

    public static function setWorkers( $Workers )
    {
        static::$Workers = $Workers;
    }

    public static function getTimeLimit()
    {
        return static::$TimeLimit;
    }

    public static function setTimeLimit( $TimeLimit )
    {
        static::$TimeLimit = $TimeLimit;
    }

    public static function getTestLimit()
    {
        return static::$TestLimit;
    }

    public static function setTestLimit( $TestLimit )
    {
        static::$TestLimit = $TestLimit;
    }

    public static function getStartingFrom()
    {
        return static::$StartingFrom;
    }

    public static function setStartingFrom( $StartingFrom )
    {
        static::$StartingFrom = $StartingFrom;
    }

}
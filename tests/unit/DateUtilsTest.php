<?php

class DateUtilsTest extends \Codeception\Test\Unit
{
    use \App\DateUtils;

    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected $dateUtils;

    /**
     * @expectedException TypeError
     */
    public function testIfNullIsPassedIsATypeErrorExceptionIsRaised()
    {
        $isLeapYear = $this->isLeapYear();        
    }

    /**
     * @expectedException TypeError
     */
    public function testIfStringIsPassedATypeErrorExceptionIsRaised()
    {
        $isLeapYear = $this->isLeapYear( 'aa' );        
    }

    public function testIfYearIsALeapYear()
    {
        $isLeapYear = $this->isLeapYear( 2000 );
        $this->assertTrue( $isLeapYear );
    }

    public function testIfYearIsNotALeapYear()
    {
        $isLeapYear = $this->isLeapYear( 2001 );
        $this->assertTrue( !$isLeapYear );
    }

    /**
     * @expectedException TypeError
     */
    public function testTypeErrorIsThrownIfNullIsPassedToMethod()
    {
        $this->getDaysForMonth( null );
    }

    /**
     * @expectedException TypeError
     */
    public function testTypeErrorIsThrownIfNonBooleanValueIsPassedToMethod()
    {
        $this->getDaysForMonth( 1, null );
    }

    public function testNumberOfDaysInMayEqualThirtyOne()
    {
        $this->assertEquals( 31, $this->getDaysForMonth( 4 ) );
    }

    public function testNumberOfDaysInFebruaryForNonLeapYearEqualTwentyEight()
    {
        $this->assertEquals( 28, $this->getDaysForMonth( 1 ) );
    }

    public function testNumberOfDaysInFebruaryLeapYearEqualTwentyNine()
    {
        $this->assertEquals( 29, $this->getDaysForMonth( 1, true ) );
    }
}
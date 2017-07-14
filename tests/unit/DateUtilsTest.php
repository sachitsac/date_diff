<?php

use App\DateUtils;

class DateUtilsTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected $dateUtils;

    protected function _before()
    {
        $this->dateUtils = new DateUtils;
    }

    /**
     * @expectedException TypeError
     */
    public function testIfNullIsPassedIsATypeErrorExceptionIsRaised()
    {
        $isLeapYear = $this->dateUtils->isLeapYear();        
    }

    /**
     * @expectedException TypeError
     */
    public function testIfStringIsPassedATypeErrorExceptionIsRaised()
    {
        $isLeapYear = $this->dateUtils->isLeapYear( 'aa' );        
    }

    public function testIfYearIsALeapYear()
    {
        $isLeapYear = $this->dateUtils->isLeapYear( 2000 );
        $this->assertTrue( $isLeapYear );
    }

    public function testIfYearIsNotALeapYear()
    {
        $isLeapYear = $this->dateUtils->isLeapYear( 2001 );
        $this->assertTrue( !$isLeapYear );
    }

    /**
     * @expectedException TypeError
     */
    public function testTypeErrorIsThrownIfNullIsPassedToMethod()
    {
        $this->dateUtils->getDaysForMonth( null );
    }

    /**
     * @expectedException TypeError
     */
    public function testTypeErrorIsThrownIfNonBooleanValueIsPassedToMethod()
    {
        $this->dateUtils->getDaysForMonth( 1, null );
    }

    public function testNumberOfDaysInMayEqualThirtyOne()
    {
        $this->assertEquals( 31, $this->dateUtils->getDaysForMonth( 4 ) );
    }

    public function testNumberOfDaysInFebruaryForNonLeapYearEqualTwentyEight()
    {
        $this->assertEquals( 28, $this->dateUtils->getDaysForMonth( 1 ) );
    }

    public function testNumberOfDaysInFebruaryLeapYearEqualTwentyNine()
    {
        $this->assertEquals( 29, $this->dateUtils->getDaysForMonth( 1, true ) );
    }
}
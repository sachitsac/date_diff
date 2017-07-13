<?php


class DateHelperTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testUserHasPassedAValidDate()
    {
        $isValiDate = \App\DateHelper::isValidDate( '12 01 1900' );
        $this->assertTrue( $isValiDate );
    }

    public function testUserHasPassedAnInValidDate()
    {
        $isValiDate = \App\DateHelper::isValidDate( '00  00   0000' );
        $this->assertTrue( !$isValiDate );
    }

    public function testUserHasPassedAnValidFormatButInvalidDate()
    {
        $isValiDate = \App\DateHelper::isValidDate( '--  -- ----' );
        $this->assertTrue( !$isValiDate );
    }

    public function testUserHasPassedAnInValidMonth()
    {
        $isValiDate = \App\DateHelper::isValidDate( '12 13 1990' );
        $this->assertTrue( !$isValiDate );
    }

    public function testUserHasPassedAnInValidDay()
    {
        $isValiDate = \App\DateHelper::isValidDate( '00 01 1990' );
        $this->assertTrue( !$isValiDate );
    }

    public function testUserHasPassedAnInValidYear()
    {
        $isValiDate = \App\DateHelper::isValidDate( '01 01 1880' );
        $this->assertTrue( !$isValiDate );
    }

    public function testProvidedYearIsLeapYear()
    {
        $isLeapYear = \App\DateHelper::isLeapYear( 2016 );
        $this->assertTrue( $isLeapYear );
    }

    public function testProvidedYearIsNotALeapYear()
    {
        $isLeapYear = \App\DateHelper::isLeapYear( 2015 );
        $this->assertTrue( !$isLeapYear );
    }

    public function testProvidedDateIsSplitCorrectlyIntoThreeParts()
    {
        $date       = '12 10 1990';
        $dateParts  = \App\DateHelper::getDateParts( $date );

        $this->assertTrue( count($dateParts) === 3 );
    }

    public function testProvidedDateIsSplitCorrectlyIntoThreePartsAndPartsAreValid()
    {
        $date = '12 10 1990';
        $dateParts = \App\DateHelper::getDateParts( $date );
        list( $day, $month, $year ) = $dateParts;

        $this->assertTrue( count($dateParts) === 3 && $day == 12 && $month == 10 && $year == 1990 );
    }

    public function testValidateNoOfDaysInLeapYearIsValid()
    {
        $leapYear = 2000;
        $days     = \App\DateHelper::getDaysInYearRange( $leapYear, $leapYear );

        $this->assertEquals( $days, 366);
    }

    public function testValidateNoOfDaysInNonLeapYearIsValid()
    {
        $leapYear = 2001;
        $days     = \App\DateHelper::getDaysInYearRange( $leapYear, $leapYear );

        $this->assertEquals( $days, 365);
    }

    public function testCheckDaysInYearRangeIsValid()
    {
        $year1 = 2000;
        $year2 = 2010;
        $days  = \App\DateHelper::getDaysInYearRange( $year1, $year2 );

        $this->assertEquals( $days, 4018);
    }

    public function testProvided2DatesWithLowerDateAsDate2IsReturnedCorrectly()
    {
        $dates = ['12 10 2000', '19 09 1999'];
        $validLowerUpper = ['19 09 1999', '12 10 2000'];

        $this->assertEquals( $validLowerUpper, \App\DateHelper::getDateSorted( $dates ) );    
    }

    public function testProvided2DatesWithLowerDateAsDate1IsReturnedCorrectly()
    {
        $dates = ['19 11 1990', '12 10 2001'];        
        $this->assertEquals( $dates, \App\DateHelper::getDateSorted( $dates ) );    
    }

    public function testProvided2DatesWithLowerDateAndUpperDateAreEqualShowTheCorrectResult()
    {
        $dates = ['19 11 1990', '19 11 1990'];        
        $this->assertEquals( $dates, \App\DateHelper::getDateSorted( $dates ) );    
    }

    public function testProvided2DatesWithLowerDateAndUpperDateAreOneDayApartTheCorrectResult()
    {
        $dates = ['19 11 1990', '20 11 1990'];        
        $this->assertEquals( $dates, \App\DateHelper::getDateSorted( $dates ) );    
    }

    public function testProvided2DatesWithLowerDateAsDate2AndUpperDateAreOneDayApartTheCorrectResult()
    {
        $dates = ['19 11 1990', '18 11 1990'];
        $expected = ['18 11 1990', '19 11 1990'];
        $this->assertEquals( $expected, \App\DateHelper::getDateSorted( $dates ) );    
    }
}
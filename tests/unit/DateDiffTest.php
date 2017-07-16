<?php

use App\{DateDiff,DateInput};

class DateDiffTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    // public function testValidateDaysForProvidedDateRange5()
    // {
    //     $inputs = new DateInput;

    //     $inputs->date1 = '12 10 2010';
    //     $inputs->date2 = '13 10 2010';

    //     $this->assertTrue( $inputs->valid() );

    //     $diff = new DateDiff( $inputs );
    //     $this->assertEquals( 1, $diff->getDays() );
    // }

    // public function testValidateDaysForProvidedDateRange4()
    // {
    //     $inputs = new DateInput;

    //     $inputs->date1 = '12 10 2010';
    //     $inputs->date2 = '13 10 2007';

    //     $this->assertTrue( $inputs->valid() );

    //     $diff = new DateDiff( $inputs );
    //     $this->assertEquals( 1095, $diff->getDays() );
    // }

    // tests
    public function testValidateDaysForProvidedDateRange1()
    {
        $inputs = new DateInput;
        $inputs->date1 = '08 01 1995';
        $inputs->date2 = '24 12 2005';

        $this->assertTrue( $inputs->valid() );

        $diff = new DateDiff( $inputs );
        $this->assertEquals( 4003, $diff->getDays() );
    }

    public function testValidateDaysForProvidedDateRange2()
    {
        $inputs = new DateInput;

        $inputs->date1 = '15 04 1969';
        $inputs->date2 = '12 09 1945';

        $this->assertTrue( $inputs->valid() );

        $diff = new DateDiff( $inputs );
        $this->assertEquals( 8616, $diff->getDays() );
    }

    public function testValidateDaysForProvidedDateRange3()
    {
        $inputs = new DateInput;
        $inputs->date1 = '30 04 1982';
        $inputs->date2 = '12 09 1945';

        $this->assertTrue( $inputs->valid() );

        $diff = new DateDiff( $inputs );
        $this->assertEquals( 13379, $diff->getDays() );
    }

    /**
     * @todo Move the sorting of the dates tests to DateDiff class
     */

    public function testProvided2DatesWithLowerDateAsDate2IsReturnedCorrectly()
    {
        $dates = ['12 10 2000', '19 09 1999'];
        $validLowerUpper = ['19 09 1999', '12 10 2000'];

        $this->assertEquals( $validLowerUpper, (new DateDiff(new DateInput))->sortDateAsc( $dates ) );    
    }

    public function testProvided2DatesWithLowerDateAsDate1IsReturnedCorrectly()
    {
        $dates = ['19 11 1990', '12 10 2001'];        
        $this->assertEquals( $dates, (new DateDiff(new DateInput))->sortDateAsc( $dates ) );    
    }

    public function testProvided2DatesWithLowerDateAndUpperDateAreEqualShowTheCorrectResult()
    {
        $dates = ['19 11 1990', '19 11 1990'];        
        $this->assertEquals( $dates, (new DateDiff(new DateInput))->sortDateAsc( $dates ) );    
    }

    public function testProvided2DatesWithLowerDateAndUpperDateAreOneDayApartTheCorrectResult()
    {
        $dates = ['19 11 1990', '20 11 1990'];        
        $this->assertEquals( $dates, (new DateDiff(new DateInput))->sortDateAsc( $dates ) );    
    }

    public function testProvided2DatesWithLowerDateAsDate2AndUpperDateAreOneDayApartTheCorrectResult()
    {
        $dates = ['19 11 1990', '18 11 1990'];
        $expected = ['18 11 1990', '19 11 1990'];
        $this->assertEquals( $expected, (new DateDiff(new DateInput))->sortDateAsc( $dates ) );    
    }
}
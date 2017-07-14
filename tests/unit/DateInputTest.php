<?php

use App\DateInput;

class DateInputTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $input;

    protected function _before()
    {
        $this->input = new DateInput;
    }

    public function testEmptyDateInputsAreReportedAsInvalid()
    {
        $inputs = new DateInput;
        
        $inputs->date1 = '';
        $inputs->date2 = '';

        $this->assertTrue( !$inputs->valid() );
    }

    public function testInvalidDateInputsAreReported()
    {
        $inputs = new DateInput;
        
        $inputs->date1 = '12 13 2010';
        $inputs->date2 = '12 1 2000';
        
        $this->assertTrue( !$inputs->valid() );
    }

    public function testDateInputsOutOfRangeAreReported()
    {
        $inputs = new DateInput;

        $inputs->date1 = '12 12 2015';
        $inputs->date2 = '12 12 1880';

        $this->assertTrue( !$inputs->valid() );
    }

    public function testDateInputsInvalidDayIsReported()
    {
        $inputs = new DateInput;

        $inputs->date1 = '33 12 2000';
        $inputs->date2 = '99 12 2001';

        $this->assertTrue( !$inputs->valid() );
    }


    public function testDateInputsInvalidMonthIsReported()
    {
        $inputs = new DateInput;

        $inputs->date1 = '12 19 2000';
        $inputs->date2 = '12 00 2001';

        $this->assertTrue( !$inputs->valid() );
    }

    // tests
    public function testValidDateInputsAreAllowed()
    {
        $inputs = new DateInput;
        
        $inputs->date1 = '12 12 2010';
        $inputs->date2 = '12 12 2010';

        $this->assertTrue( $inputs->valid() );
    }

    public function testUserHasPassedAValidDate()
    {
        $isValiDate = $this->input->isValidDate( '12 01 1900' );
        $this->assertTrue( $isValiDate );
    }

    public function testUserHasPassedAnInValidDate()
    {
        $isValiDate = $this->input->isValidDate( '00  00   0000' );
        $this->assertTrue( !$isValiDate );
    }

    public function testUserHasPassedAnValidFormatButInvalidDate()
    {
        $isValiDate = $this->input->isValidDate( '--  -- ----' );
        $this->assertTrue( !$isValiDate );
    }

    public function testUserHasPassedAnInValidMonth()
    {
        $isValiDate = $this->input->isValidDate( '12 13 1990' );
        $this->assertTrue( !$isValiDate );
    }

    public function testUserHasPassedAnInValidDay()
    {
        $isValiDate = $this->input->isValidDate( '00 01 1990' );
        $this->assertTrue( !$isValiDate );
    }

    public function testUserHasPassedAnInValidYear()
    {
        $isValiDate = $this->input->isValidDate( '01 01 1880' );
        $this->assertTrue( !$isValiDate );
    }
}
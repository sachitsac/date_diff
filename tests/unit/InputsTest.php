<?php


class InputsTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;


    public function testEmptyDateInputsAreReportedAsInvalid()
    {
        $inputs = new \App\Inputs;
        $inputs
            ->setDate1( '' )
            ->setDate2( '' );

        $this->assertTrue( !$inputs->valid() );
    }

    public function testInvalidDateInputsAreReported()
    {
        $inputs = new \App\Inputs;
        $inputs
            ->setDate1( '12 13 2010' )
            ->setDate2( '12 1 2000' );

        $this->assertTrue( !$inputs->valid() );
    }

    public function testDateInputsOutOfRangeAreReported()
    {
        $inputs = new \App\Inputs;
        $inputs
            ->setDate1( '12 12 2015' )
            ->setDate2( '12 12 1880' );

        $this->assertTrue( !$inputs->valid() );
    }

    public function testDateInputsInvalidDayIsReported()
    {
        $inputs = new \App\Inputs;
        $inputs
            ->setDate1( '33 12 2000' )
            ->setDate2( '99 12 2001' );

        $this->assertTrue( !$inputs->valid() );
    }


    public function testDateInputsInvalidMonthIsReported()
    {
        $inputs = new \App\Inputs;
        $inputs
            ->setDate1( '12 19 2000' )
            ->setDate2( '12 00 2001' );

        $this->assertTrue( !$inputs->valid() );
    }

    // tests
    public function testValidDateInputsAreAllowed()
    {
        $inputs = new \App\Inputs;
        $inputs
            ->setDate1( '12 12 2010' )
            ->setDate2( '12 12 2010' );

        $this->assertTrue( $inputs->valid() );
    }
}
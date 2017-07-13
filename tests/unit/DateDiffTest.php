<?php


class DateDiffTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    public function testValidateDaysForProvidedDateRange5()
    {
        $inputs = new \App\Inputs;
        $inputs
            ->setDate1( '12 10 2010' )
            ->setDate2( '13 10 2010' );

        $this->assertTrue( $inputs->valid() );

        $diff = new \App\DateDiff( $inputs );
        $this->assertEquals( 1, $diff->getDays() );
    }

    public function testValidateDaysForProvidedDateRange4()
    {
        $inputs = new \App\Inputs;
        $inputs
            ->setDate1( '12 10 2010' )
            ->setDate2( '13 10 2007' );

        $this->assertTrue( $inputs->valid() );

        $diff = new \App\DateDiff( $inputs );
        $this->assertEquals( 1095, $diff->getDays() );
    }

    // tests
    public function testValidateDaysForProvidedDateRange1()
    {
        $inputs = new \App\Inputs;
        $inputs
            ->setDate1( '08 01 1995' )
            ->setDate2( '24 12 2005' );

        $this->assertTrue( $inputs->valid() );

        $diff = new \App\DateDiff( $inputs );
        $this->assertEquals( 4003, $diff->getDays() );
    }

    public function testValidateDaysForProvidedDateRange2()
    {
        $inputs = new \App\Inputs;
        $inputs
            ->setDate1( '15 04 1969' )
            ->setDate2( '12 09 1945' );

        $this->assertTrue( $inputs->valid() );

        $diff = new \App\DateDiff( $inputs );
        $this->assertEquals( 8616, $diff->getDays() );
    }

    public function testValidateDaysForProvidedDateRange3()
    {
        $inputs = new \App\Inputs;
        $inputs
            ->setDate1( '30 04 1982' )
            ->setDate2( '12 09 1945' );

        $this->assertTrue( $inputs->valid() );

        $diff = new \App\DateDiff( $inputs );
        $this->assertEquals( 13379, $diff->getDays() );
    }
}
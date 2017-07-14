<?php

namespace App;

use \App\DateInput;

/**
 * Provide two dates, this call will return the difference between the two in days
 *
 * @package App
 * @author Sachit Malhotra <sachitsac@gmail.com>
 * @since 1.0.0
 **/
class DateDiff
{
    use \App\DateUtils;

    /**
     * Input class instance that provides the inputted dates
     *
     * @var App\Input
     * @since 1.0.0
     */
    private $inputs;

    /**
     * Earliest date from the provided set
     *
     * @var string
     * @since 1.0.0
     */
    private $lowerDate;

    /**
     * Highest date from the provided set
     *
     * @var string
     * @since 1.0.0
     */
    private $upperDate;

    /**
     * Constructor accepts an input instance
     *
     * @param Inputs $inputs
     * @since 1.0.0
     */
    public function __construct( DateInput $inputs )
    {
        $this->inputs = $inputs;      
    }

    /**
     * Getter for Lower date
     *
     * @return array
     * @since 1.0.0
     */
    public function getLowerDate() : string
    {
        return $this->lowerDate;
    }

    /**
     * Getter for upper date
     *
     * @return array
     * @since 1.0.0
     */
    public function getUpperDate() : string
    {
        return $this->upperDate;
    }

    /**
     * Return the number of days between provided 2 dates
     *
     * @return [type] [description]
     * @since 1.0.0
     */
    public function getDays() : int
    {
        $this->setupDates();

        $date1Parts = explode( ' ', $this->lowerDate );
        $date2Parts = explode( ' ', $this->upperDate );

        list( $day1, $month1, $year1 ) = $date1Parts;
        list( $day2, $month2, $year2 ) = $date2Parts;

        $startMonth     = (int) $month1;
        $endMonth       = (int) $month2;
        $startYear      = (int) $year1;
        $endYear        = (int) $year2;
        $yearTracker    = $startYear;
        $monthTracker   = $startMonth;
        $dayTracker     = (int) $day1;
        $noOfDays       = 0;
        $endDay         = (int) $day2;

        $noOfDaysInMonth = $this->getMonthDays( $startMonth - 1, $startYear );

        while (!($yearTracker === $endYear && $monthTracker === $endMonth && $endDay === $dayTracker)) {
            
            $noOfDays++;
            $dayTracker++;

            $needToIncrimentYear = ( $monthTracker === 12 && $dayTracker > $noOfDaysInMonth );
            if ( $needToIncrimentYear ) {
                $yearTracker++;
                $monthTracker = 1;
                $dayTracker = 1;
                $noOfDaysInMonth = $this->getMonthDays($monthTracker - 1, $yearTracker);
            }

            $needToIncrimentMonth = ( $dayTracker > $noOfDaysInMonth );
            if ( $needToIncrimentMonth ) {
                $dayTracker = 1;
                $monthTracker++;
                $noOfDaysInMonth = $this->getMonthDays( $monthTracker - 1, $yearTracker );
            }
        }

        return $noOfDays;
    }

    /**
     * Sort date Asc
     *
     * @param  array  $dates
     * @return array
     * @since 1.0.0
     */
    public function sortDateAsc( array $dates ) : array
    {
        $date1Parts = explode( ' ', $dates[0] );
        $date2Parts = explode( ' ', $dates[1] );

        list( $day1, $month1, $year1 ) = $date1Parts;
        list( $day2, $month2, $year2 ) = $date2Parts;

        $yearsAreSame = (int) $year1 === (int) $year2;
        $monthsAreEqual = (int) $month1 === (int) $month2;
        $daysAreEqual   = (int) $day1 === (int) $day2;

        if (((int) $year1 > (int) $year2) ||
            ($yearsAreSame && !$monthsAreEqual && (int) $month1 > (int) $month2) ||
            ($yearsAreSame && $monthsAreEqual && !$daysAreEqual && (int) $day1 > (int) $day2)) {
            $swap = true;
        } else {
            $swap = false;
        }

        return ( $swap ) ? array_reverse( $dates ) : $dates;
    }

    /**
     * Setup dates by sorting it asc and setting the lower and higher dates
     * 
     * @return void 
     * @since 1.0.0
     */
    private function setupDates()
    {
        $dates = $this->sortDateAsc( [ $this->inputs->date1, $this->inputs->date2 ] );
        $this->lowerDate = $dates[0];
        $this->upperDate = $dates[1];        
    }

    /**
     * Helper function the returns the no of days in a month including leap year check
     *
     * @param  int    $month
     * @param  int    $year
     * @return array
     * @since 1.0.0
     */
    private function getMonthDays( int $month, int $year ) : int
    {
        return ( $this->isLeapYear( $year ) ) ?
            $this->getLeapYearDayForMonth( $month ) : $this->getDayForMonth( $month );
    }
}

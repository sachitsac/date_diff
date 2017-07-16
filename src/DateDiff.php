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

        $endMonth       = (int) $month2;
        $yearTracker    = (int) $year1;
        $monthTracker   = (int) $month1;
        $endDay         = (int) $day2;

        // Start date days
        $noOfDays = $this->getMonthDays( $month1, $year1 ) - (int) $day1;
        $monthTracker++;

        while ( !($yearTracker === (int) $year2 && $monthTracker === ($endMonth + 1) ) ) {
            if ( $monthTracker > 12 ) {
                $yearTracker++;
                $monthTracker = 1;
            }
            $noOfDays += $this->getMonthDays( $monthTracker, $yearTracker );
            $monthTracker++;
        }

        // End Date days
        $noOfDays -= ( $this->getMonthDays( $endMonth, $yearTracker ) - $endDay );
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
            $this->getLeapYearDayForMonth( $month - 1 ) : $this->getDayForMonth( $month - 1 );
    }
}

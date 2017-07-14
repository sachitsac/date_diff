<?php

namespace App;

/**
 * Date Helper class contains useful function to help with date manipulation
 *
 * @package App
 * @author Sachit Malhotra <sachitsac@gmail.com>
 * @since 1.0.0
 **/
trait DateUtils
{
    /**
     * Validate if provided year is leap year or not
     *
     * @param  int     $year
     * @return boolean
     * @since 1.0.0
     */
    public function isLeapYear( int $year ) : bool
    {
        return ( ( $year % 4 == 0 ) && ( $year % 100 != 0 ) ) || ( $year % 400 == 0 );
    }

    /**
     * Get Number of days in a month
     * 
     * @param  int          $monthNo    
     * @param  boolean $isLeapYear 
     * @return int
     */
    public function getDaysForMonth( int $monthNo, bool $isLeapYear = false ) : int
    {
        $days = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        $noOfDays = $days[$monthNo] ?? 0;
        return ($isLeapYear && $monthNo === 1) ? 29 : $days[$monthNo];
    }

    /**
     * Return no of days in a given month number for a leap year
     *
     * @param  int    $monthNo
     * @return int
     * @since 1.0.0
     */
    public function getLeapYearDayForMonth( int $monthNo ) : int
    {
        return $this->getDaysForMonth($monthNo, true);
    }

    /**
     * Return no of days in a given month number for a non leap year
     *
     * @param  int    $monthNo
     * @return int
     * @since 1.0.0
     */
    public function getDayForMonth( int $monthNo ) : int
    {
        return $this->getDaysForMonth($monthNo);
    }
}

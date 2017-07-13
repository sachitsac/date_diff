<?php

namespace App;

/**
 * Date Helper class contains useful function to help with date manipulation
 *
 * @package App
 * @author Sachit Malhotra <sachitsac@gmail.com>
 * @since 1.0.0
 **/
class DateHelper
{
	/**
	 * No Of days in a leap year
	 *
	 * @var int
	 **/
	const LEAP_YEAR_DAYS = 366;

	/**
	 * No Of days in a non leap year
	 *
	 * @var int
	 **/
	const NORMAL_YEAR_DAYS = 365;

	/**
	 * Validate date is of the format DD MM YYYY
	 * Validate date year is between 1990 - 2010
	 * 
	 * @param  string  $date   Date in format DD MM YYYY	 
	 * @return boolean 
	 * @author Sachit Malhotra <sachitsac@gmail.com>
	 * @since 1.0.0
	 */
	public static function isValidDate( string $date ) : bool
	{
		$valid = (preg_match( "/^(0[1-9]|[1-2][0-9]|3[0-1]) (0[0-9]|1[0-2]) (19[0-9][0-9]|20(0[0-9]|10))$/", $date ));
		return $valid !== 0 ? true : false;
	}

	/**
	 * Validate if provided year is leap year or not
	 * 
	 * @param  int     $year
	 * @return boolean
	 * @author Sachit Malhotra <sachitsac@gmail.com>
	 * @since 1.0.0	 
	 */
	public static function isLeapYear( int $year ) : bool
	{
		return (($year % 4 == 0) && ($year % 100 != 0)) || ($year % 400 == 0);
	}

	/**
	 * Split date into 3 parts ( day, month and year )
	 * @param  string $date Date in format DD MM YYYY
	 * @return array
	 * @author Sachit Malhotra <sachitsac@gmail.com>
	 * @since 1.0.0		
	 */
	public static function getDateParts( string $date ) : array
	{
		return explode( ' ', $date );
	}

	/**
	 * Get number of days in a month for normal year and leap leapYea
	 * @param  boolean $leapYear
	 * @return float
	 * @author Sachit Malhotra <sachitsac@gmail.com>
	 * @since 1.0.0	
	 */
	public static function getDaysInOneMonth( bool $leapYear = false ) : float
	{
		$daysInYear = $leapYear ? self::LEAP_YEAR_DAYS : self::NORMAL_YEAR_DAYS;
		return round ( $daysInYear / 12, 4, PHP_ROUND_HALF_UP );
	}

	/**
	 * Get number of days in a given year range.
	 * Note: Make sure leap years are factored correctly
	 * 
	 * @param  int    $year1 
	 * @param  int    $year2 
	 * @return int    No of days
	 * @author Sachit Malhotra <sachitsac@gmail.com>
	 * @since 1.0.0	
	 */
	public static function getDaysInYearRange( int $year1, int $year2 ) : int
	{
		$noOfyears = abs( $year1 - $year2 );
		$startYear = ( $year1 > $year2 ) ? $year2 : $year1;
		$noOfDays  = 0;

		for ( $i = 0; $i <= $noOfyears; $i++ ) { 		
			$year 		= $startYear + $i;
			$isLeapYear = self::isLeapYear( $year );
			$noOfDays 	= $noOfDays + ( $isLeapYear ? self::LEAP_YEAR_DAYS : self::NORMAL_YEAR_DAYS );
		}

		return $noOfDays;		
	}

	/**
	 * Sort date Asc
	 * 
	 * @param  array  $dates 
	 * @return array 
	 * @author Sachit Malhotra <sachitsac@gmail.com>
	 * @since 1.0.0	
	 */
	public static function getDateSorted( array $dates ) : array
	{
		$date1Parts = self::getDateParts( $dates[0] );
		$date2Parts = self::getDateParts( $dates[1] );

		list ( $day1, $month1, $year1 ) = $date1Parts;
		list ( $day2, $month2, $year2 ) = $date2Parts;

		$yearsAreSame = (int) $year1 === (int) $year2;
		$monthIsEqual = (int) $month1 === (int) $month2;
		$dayIsEqual   = (int) $day1 === (int) $day2;

		if ( ( (int) $year1 > (int) $year2 ) || 
			($yearsAreSame && !$monthIsEqual && (int) $month1 > (int) $month2 ) || 
			($yearsAreSame && $monthIsEqual && !$dayIsEqual && (int) $day1 > (int) $day2 )) {
			$swap = true;
		} else {
			$swap = false;
		}

		return ($swap) ? array_reverse( $dates ) : $dates;
	}

	/**
	 * Return no of days in a given month number for a leap year
	 * 
	 * @param  int    $monthNo
	 * @return int
	 * @author Sachit Malhotra <sachitsac@gmail.com>
	 * @since 1.0.0			 
	 */
	public static function getLeapYearDayForMonth( int $monthNo )
	{
		if ( $monthNo > -1 && $monthNo < 12) {
			$days = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
			return $days[$monthNo];	
		}
		return null;
	}

	/**
	 * Return no of days in a given month number for a non leap year
	 * 
	 * @param  int    $monthNo
	 * @return int
	 * @author Sachit Malhotra <sachitsac@gmail.com>
	 * @since 1.0.0			 
	 */
	public static function getDayForMonth( int $monthNo )
	{
		if ( $monthNo > -1 && $monthNo < 12) {
			$days = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
			return $days[$monthNo];	
		}
		return null;
	}
}
<?php

namespace App;

use \App\Inputs;
use \App\DateHelper;

/**
 * Provide two dates, this call will return the difference between the two in days
 *
 * @package App
 * @author Sachit Malhotra <sachitsac@gmail.com>
 * @since 1.0.0
 **/
class DateDiff
{
	/**
	 * Input class instance that provides the inputted dates
	 * 
	 * @var App\Input
	 * @author Sachit Malhotra <sachitsac@gmail.com>
	 * @since 1.0.0	
	 */
	private $inputs;

	/**
	 * Earliest date from the provided set
	 * 
	 * @var string
	 * @author Sachit Malhotra <sachitsac@gmail.com>
	 * @since 1.0.0	
	 */
	private $lowerDate;

	/**
	 * Highest date from the provided set
	 * 
	 * @var string
	 * @author Sachit Malhotra <sachitsac@gmail.com>
	 * @since 1.0.0	
	 */
	private $upperDate;

	/**
	 * Constructor accepts an input instance
	 * 
	 * @param Inputs $inputs 
	 * @author Sachit Malhotra <sachitsac@gmail.com>
	 * @since 1.0.0	
	 */
	public function __construct( Inputs $inputs )
	{
		$this->inputs = $inputs;
		$this->init();
	}

	/**
	 * Return the number of days between provided 2 dates
	 * 
	 * @return [type] [description]
	 * @author Sachit Malhotra <sachitsac@gmail.com>
	 * @since 1.0.0	
	 */
	public function getDays() : int
	{	
		$date1Parts = DateHelper::getDateParts( $this->lowerDate );
		$date2Parts = DateHelper::getDateParts( $this->upperDate );

		list( $day1, $month1, $year1 ) = $date1Parts;
		list( $day2, $month2, $year2 ) = $date2Parts;

		$startMonth = (int) $month1;
		$endMonth   = (int) $month2;

		$startYear  = (int) $year1;
		$endYear    = (int) $year2;

		$yearTracker  = $startYear;
		$monthTracker = $startMonth;

		$dayTracker   = (int) $day1;
		$noOfDays 	  = 0;
		$endDay 	  = (int) $day2;

		$noOfDaysInMonth = $this->getMonthDays( $startMonth - 1, $startYear );

		while (!($yearTracker === $endYear && $monthTracker === $endMonth && $endDay === $dayTracker)) {		
			
			$noOfDays++;
			$dayTracker++;

			if ( $monthTracker === 12 && $dayTracker > $noOfDaysInMonth ) {
				$yearTracker++;
				$monthTracker = 1;
				$dayTracker = 1;
				$noOfDaysInMonth = $this->getMonthDays( $monthTracker - 1, $yearTracker );				
			}

			if ( $dayTracker > $noOfDaysInMonth ) {
				$dayTracker = 1;
				$monthTracker++;
				$noOfDaysInMonth = $this->getMonthDays( $monthTracker - 1, $yearTracker );				
			}
		};

		return $noOfDays;
	}

	/**
	 * Sort dates ASC
	 * 
	 * @return void
	 * @author Sachit Malhotra <sachitsac@gmail.com>
	 * @since 1.0.0		 
	 */
	private function init()
	{
		$date1 = $this->inputs->getDate1();
		$date2 = $this->inputs->getDate2();
		$dates = DateHelper::getDateSorted( [ $date1, $date2 ] );

		$this->lowerDate = $dates[0];
		$this->upperDate = $dates[1];
	}

	/**
	 * Helper function the returns the no of days in a month including leap year check
	 * 
	 * @param  int    $month 
	 * @param  int    $year  
	 * @return array
	 * @author Sachit Malhotra <sachitsac@gmail.com>
	 * @since 1.0.0		 
	 */
	private function getMonthDays( int $month, int $year ) : int
	{
		return ( DateHelper::isLeapYear( $year ) ) ? 
			DateHelper::getLeapYearDayForMonth( $month ) : DateHelper::getDayForMonth( $month );
	}

    /**
     * Getter for Lower date
     * 
     * @return array
     * @author Sachit Malhotra <sachitsac@gmail.com>
	 * @since 1.0.0		 
	 */
    public function getLowerDate() : array
    {
        return $this->lowerDate;
    }

    /**
     * Setter for lower date
     * 
     * @param  array $lowerDate
     * @return self
     * @author Sachit Malhotra <sachitsac@gmail.com>
	 * @since 1.0.0		
	 */
    public function setLowerDate( array $lowerDate )
    {
        $this->lowerDate = $lowerDate;

        return $this;
    }

    /**
     * Getter for upper date
     * 
     * @return array     
     * @author Sachit Malhotra <sachitsac@gmail.com>
	 * @since 1.0.0	
     */
    public function getUpperDate() : array
    {
        return $this->upperDate;
    }

    /**
     * Setter for upper date
     *
     * @return self
     * @author Sachit Malhotra <sachitsac@gmail.com>
	 * @since 1.0.0	
     */
    public function setUpperDate($upperDate)
    {
        $this->upperDate = $upperDate;

        return $this;
    }
}
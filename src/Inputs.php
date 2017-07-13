<?php

namespace App;

/**
 * Input class to handle user input and validation
 * 
 * @author Sachit Malhotra <sachitsac@gmail.com>
 * @since 1.0.0     
 */
class Inputs
{
    /**
     * Date in format DD MM YYYY
     * 
     * @var string
     * @author Sachit Malhotra <sachitsac@gmail.com>
     * @since 1.0.0     
     */
	private $date1;

    /**
     * Date in format DD MM YYYY
     * 
     * @var string
     * @author Sachit Malhotra <sachitsac@gmail.com>
     * @since 1.0.0     
     */
	private $date2;

    /**
     * Getter for date 1
     * 
     * @return string
     * @author Sachit Malhotra <sachitsac@gmail.com>
     * @since 1.0.0     
     */
    public function getDate1() : string
    {
        return $this->date1;
    }

    /**
     * Setter for date 1
     * 
     * @param string $date1
     * @return self
     * @author Sachit Malhotra <sachitsac@gmail.com>
     * @since 1.0.0     
     */
    public function setDate1( string $date1 )
    {
        $this->date1 = $date1;

        return $this;
    }

    /**
     * Getter for date 2
     * 
     * @return string
     * @author Sachit Malhotra <sachitsac@gmail.com>
     * @since 1.0.0     
     */
    public function getDate2() : string
    {
        return $this->date2;
    }

    /**
     * Setter for date 2
     * 
     * @param string $date2
     * @return self
     * @author Sachit Malhotra <sachitsac@gmail.com>
     * @since 1.0.0     
     */
    public function setDate2($date2)
    {
        $this->date2 = $date2;

        return $this;
    }

    /**
     * Validate dates
     * 
     * @return boolean
     * @author Sachit Malhotra <sachitsac@gmail.com>
     * @since 1.0.0          
     */
    public function valid() : bool
    {
    	$date1IsValid = \App\DateHelper::isValidDate( $this->getDate1() );
    	$date2IsValid = \App\DateHelper::isValidDate( $this->getDate2() );
    	return ( $date1IsValid && $date2IsValid );
    }
}
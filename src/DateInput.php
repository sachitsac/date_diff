<?php

namespace App;

/**
 * Input class to handle user input and validation
 *
 * @author Sachit Malhotra <sachitsac@gmail.com>
 * @since 1.0.0
 */
class DateInput
{
    /**
     * Date in format DD MM YYYY
     *
     * @var string
     * @since 1.0.0
     */
    public $date1;

    /**
     * Date in format DD MM YYYY
     *
     * @var string
     * @since 1.0.0
     */
    public $date2;

    /**
     * Validate dates
     *
     * @return boolean
     * @since 1.0.0
     */
    public function valid() : bool
    {
        $date1IsValid = $this->isValidDate( $this->date1 );
        $date2IsValid = $this->isValidDate( $this->date2 );

        return ( $date1IsValid && $date2IsValid );
    }

    /**
     * Validate date is of the format DD MM YYYY
     * Validate date year is between 1990 - 2010
     *
     * @param  string  $date   Date in format DD MM YYYY
     * @return boolean
     * @since 1.0.0
     */
    public function isValidDate( string $date ) : bool
    {
        $valid = ( preg_match( "/^(0[1-9]|[1-2][0-9]|3[0-1]) (0[0-9]|1[0-2]) (19[0-9][0-9]|20(0[0-9]|10))$/", $date ) );
        return $valid !== 0 ? true : false;
    }
    
}

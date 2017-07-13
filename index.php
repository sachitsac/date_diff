<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\{DateHelper,DateDiff,Inputs};

greeting();

$date1 = getValidDate( 1 );
$date2 = getValidDate( 2 );

if ( $date1 && $date2 ) {
	run( $date1, $date2 );	
}

function run( $date1, $date2 )
{
	$inputs = new Inputs;
	$inputs
		->setDate1( $date1 )
		->setDate2( $date2 );

	$diff = new DateDiff( $inputs );
	$daysDiff = $diff->getDays();

	echo "\n# -----------------------------------------------------------------------\n";
	echo "#\t Result: \n";
	echo "#\t Input>\t\t $date1, $date2\n";
	echo "#\t Output>\t {$diff->getLowerDate()}, {$diff->getUpperDate()}, $daysDiff\n";
	echo "#\t Thankyou! Have a nice day\n";
	echo "# -----------------------------------------------------------------------\n";
}

function greeting()
{
	echo "# -----------------------------------------------------------------------\n";
	echo "#\tWelcome! \n";
	echo "#\tProvided 2 dates, this program will compute the difference between \n";
	echo "#\tthose 2 dates without using any helper sdk or library function / class.\n";
	echo "#\tInstructions: You will be prompted to provide 2 dates in the following \n";
	echo "#\tformat: DD MM YYYY. For example 12 10 2000.\n";
	echo "#\tYou need to enter a date with year range from 1900 to 2010.\n";
	echo "# -----------------------------------------------------------------------\n\n";
	$continue = prompt('Do you wish to continue? (Yes|No): ');
	if ( strtolower($continue) === 'no' ) {
		echo "\n#\tThankyou! Have a nice day\n";
		exit;
	}
}

function getValidDate( $num )
{
	$date = prompt( "Enter date $num: ");
	$date1IsValid = DateHelper::isValidDate( $date );

	if ( !$date1IsValid ) {
		showError(
			sprintf(
				'Invalid date %d. Enter date in format "DD MM YYYY" and year ( YYYY ) is between 1900 - 2010"',
				$num
			)
		);
		$date = getValidDate( $num );
	}

	return $date;
}

function showError( $msg )
{
	echo '### ERROR: ' . $msg . "\n";
}

function showResult()
{

}

function prompt( $msg )
{
	return readline( $msg );
}
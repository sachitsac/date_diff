# Date Difference

###Description:

Create an application that can read in pairs of dates in the following format -

> DD MM YYYY, DD MM YYYY

Validate the input data, and compute the difference between the two dates in days.

Output of the application should be of the form -

> DD MM YYYY, DD MM YYYY, difference

Where the first date is the earliest, the second date is the latest and the difference is the number of days.

Input can be from a file, or from standard input, as the developer chooses.

###Constraints:

The application may not make use of the platform / SDK libraries for date manipulation (for example Date, Calendar classes).

The application can limit calculation on an input range of dates from 1900 to 2010.

Sample I/O

> Input> 08 01 1995, 24 12 2005

> Output> 08 01 1995, 24 12 2005, 4003

> Input> 15 04 1969, 12 09 1945

> Output> 12 09 1945, 15 04 1969, 8616

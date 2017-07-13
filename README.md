# Instructions

### Prerequisite
- Command line access
- Php 7.0.17 or greater
- Git ( optional )
- tar program

### Before running

Download this program or clone this repository onto your system.
Once the program is download or cloned on your system, then go to this program root folder and uncompress a file
```
tar -xvzf vendor.tar.gz
```
Or run the following command
```
php composer.phar install
```

PS: Both the above commands need to be run from this program root folder

### Runing the program
Assuming you are in the root directory of this program.
To run the program type the following command in a terminal window:

```
php index.php
```

### Running the tests
Assuming you are in the root directory of this program.
To run the test suite, type the following command in a terminal window:

```
vendor/bin/codecept run unit
```

Thank you. Any feedback is welcome.
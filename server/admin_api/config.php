<?php

ini_set( "display_errors", true );

date_default_timezone_set( "Asia/Manila" );  // http://www.php.net/manual/en/timezones.php

define( "timezone", "SET @@session.time_zone='+08:00';" );

define( "DB_DSN", "mysql:host=localhost;dbname=bini1010_ched_test" );

define( "DB_HOST", "localhost" );

define( "DB_NAME", "bini1010_ched_bot" );

define( "DB_USERNAME", "bini1010_admin" );

define( "DB_PASSWORD", "{}+u@#xvguT." );

define( "secretKey", "password123456789" );

define( "algorithm", "HS512" );

define( "serverName", "tatay.com" );

function handleException( $exception ) {

  echo "Sorry, a problem occurred. Please try later.";

  error_log( $exception->getMessage() );

}

 

set_exception_handler( 'handleException' );



?>
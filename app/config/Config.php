<?php
//echo "<pre>";
//print_r($_ENV);
//exit();
//    exit();
    define('dbhost', 'localhost');
    define('dbuser', 'root');
    define('dbpass', '');
    define('dbname', 'ezVote');
    

    define('approot', dirname(dirname(__FILE__)));
    define('urlroot', 'http://localhost/ezvote');
    define('siteroot', 'EzVote');

//    API configuration

      define('API_KEY',$_ENV['ZOOM_API_KEY']);
      define('API_SECRET',$_ENV['ZOOM_API_SECRET']);
      define('EMAIL_ID',$_ENV['ZOOM_EMAIL_ID']);

      //Encryption configuration
      define('ENCRYPTION_KEY',$_ENV['ENCRYPTION_KEY']);
      define('ENCRYPTION_IV',$_ENV['ENCRYPTION_IV']);
      define('ENCRYPTION_ALGORITHM',$_ENV['ENCRYPTION_ALGORITHM']);
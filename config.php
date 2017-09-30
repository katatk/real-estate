<?php
   define('DB_SERVER', '66.147.244.216:3306');
   define('DB_USERNAME', 'beautzo8_rl');
   define('DB_PASSWORD', '!r85[b4STZSC');
   define('DB_DATABASE', 'beautzo8_richlist');

   $db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

    // check connection
    if ($db->connect_errno) {
        die("Connection failed: " . $db->connect_errno);
    }
?>
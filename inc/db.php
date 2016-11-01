<?php
/**
 * Created By: Hisham Shawky
 * Email: me@heshamshawky.com
 */

$db = array(
    'dsn'       => 'mysql:host=localhost;dbname=answers',
    'user'      => 'root',
    'pass'      => ''
);

foreach ($db as $key => $database) {
    define(strtoupper($key), $database);
}

try {

    $con = new PDO (DSN, USER, PASS);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->exec('SET NAMES utf8');

} catch ( Exception $e ) {
    echo 'ERROR! ' . $e->getMessage() . "<br>";
    die();
}
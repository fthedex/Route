<?php
session_start();

/**
 * Created by PhpStorm.
 * User: Khalil
 * Date: 12/10/2016
 * Time: 02:28 م
 */


//check if they are set and unset them
try {
    if (isset($_COOKIE['routeUsername']) && isset($_COOKIE['routePassword'])) { //means he is logging-in for the first time

        unset($_COOKIE['routeUsername']);
        unset($_COOKIE['routePassword']);
        setcookie('routeUsername', null, -1, '/');
        setcookie('routePassword', null, -1, '/');


echo "UNSET COOKIES";
    }

    session_unset();
    session_destroy();
}
catch (Exception $e){
    echo $e;
}

header("location:/Route/");
exit();
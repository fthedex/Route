<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Khalil
 * Date: 14/10/2016
 * Time: 02:15 م
 */

echo $_SESSION['routeFullName'] . " <br> ". $_SESSION['routeUserType']. " <br> ". $_SESSION['routeUsername']. " <br> ". $_SESSION['routePassword'];

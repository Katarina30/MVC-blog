<?php
session_start();
require_once 'bootstrap.php';

$conn = new Database();
$route = new Route();


if (Session::exists('validation_err')){

    $GLOBALS['session'] = Session::get('validation_err');

	unset($_SESSION['validation_err']);

}


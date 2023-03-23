<?php
include ("sqlcom/FunctionWebservice.php");

$oci = new Webservice43 ();

$user='jodiazed';
$pwd='te1234st';
$ip=$_SERVER['SERVER_ADDR'];

$toke=$oci->XisamToken($user, $pwd, $ip)

print_r($toke);
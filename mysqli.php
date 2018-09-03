<?php 

$mysqli['hostname'] = '';
$mysqli['username'] = '';
$mysqli['password'] = '';
$mysqli['database'] = '';

$mysqli['connect'] = mysqli_connect(
	$mysqli['hostname'],
	$mysqli['username'],
	$mysqli['password'],
	$mysqli['database']
);
mysqli_set_charset($mysqli['connect'],"utf8");

?>
<?php
require './lib/dibi.min.php';

// DB
try {
	$dsn = new PDO("mysql:host=mysql1.alwaysdata.com;dbname=toto_logs", 'toto_logs', 'N-z@<S4#33;!58h', array(
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
	));

	dibi::connect(array(
		'driver' => 'pdo',
		'pdo' => $dsn,
		'lazy' => true,
		'profiler' => array(
        	'run' => TRUE,
    	),
	));

	// $dibi = true;

} catch (Exception $e) {
	echo $e->getMessage();
	exit();
}
?>
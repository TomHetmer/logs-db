<?php
// th 2014
require './db.php';
require './func.php';

//  /api/new
if($path == 'new')
{
	$json = file_get_contents('php://input');
	$array = json_decode($json);
}

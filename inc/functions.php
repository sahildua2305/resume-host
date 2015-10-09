<?php

function connect_server(){
	require 'database.php';
	$connection = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DATABASE);
	return $connection;
}

function checkFileExtensionForImage($extension) {
	if($extension == 'pdf')
		return 1;
	return 0;
}
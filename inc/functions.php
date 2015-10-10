<?php

function connect_server(){
	require 'database.php';
	return mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DATABASE);
}

function checkFileExtensionForImage($extension) {
	if($extension == 'pdf')
		return 1;
	return 0;
}
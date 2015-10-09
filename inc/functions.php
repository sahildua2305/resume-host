<?php

function connect_server(){
	require 'database.php';
	$connection = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DATABASE);
	return $connection;
}


<?php

include 'database.php';

function connect_server(){
	$connection = mysqli_connect($SERVER,$USERNAME,$PASSWORD,$DATABASE);
	return $connection;
}

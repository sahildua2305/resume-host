<?php
	ob_start();
	
	require 'inc/functions.php';
	
	if(!isset($_GET['username'])){
		header('Location: index.php');
	}

	$username = strip_tags($_GET['username']);
	$name = "";

	$connection = connect_server();
	$results = mysqli_query($connection, "SELECT firstname, lastname FROM user_details WHERE username = '$username'");
	while($row = mysqli_fetch_array($results)){
		$name = $row['firstname'] . " " . $row['lastname'];
	}
?>

<!DOCTYPE html>
<html>
	<head>

		<title><?php echo $name; ?> - Resume</title>
		<style>
			body {
				margin: 0;
			}
			iframe {
				display: block;
				background: #000;
				border: none;
				height: 100vh;
				width: 100vw;
			}
		</style>
	</head>

	<body>
		<iframe src="/uploaded-resumes/<?php echo $username;?>.pdf"> </iframe>
	</body>
</html>
<?php
	if(!isset($_POST['key']) || !isset($_POST['username'])){
		die("Something went terribly wrong!");
	}
	$con = mysqli_connect("69.65.10.232","mkstin_resume","+o{6Q,sJUgW^","mkstin_resume_host");
	
	$username = strip_tags($_POST['username']);
	$key = strip_tags($_POST['key']);
	$user = mysqli_query($con, "SELECT id, passkey FROM initial WHERE username='$username'");
	if(mysqli_num_rows($user) == 1){
		$user = mysqli_fetch_array($user);
		if($key == $user['passkey']){
			$id = $user['id'];
			$q = mysqli_query($con, "SELECT * FROM profile WHERE id='$id'");
			$r = mysqli_fetch_array($q);
			$output = '';
			foreach($r as $key=>$value){
				if(!is_numeric($key) && $key!='id'){
					$output .= $value."<br>";
				}
			}
			echo json_encode(array("success"=>"true", "msg"=>$output));
		}
		else{
			//wrong key
			echo json_encode(array("success"=>"false", "msg"=>"Invalid PassKey"));
		}
	}
	else{
		//illegal username
		echo json_encode(array("success"=>"false", "msg"=>"Invalid Username"));
	}
?>
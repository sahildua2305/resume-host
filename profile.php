<?php include 'inc/header.php';
	session_start();
	if(!isset($_GET['name'])){
		$username = isset($_SESSION['username'])? $_SESSION['username'] : '';
	}
	else{
		$username = $_GET['name'];
	}
	
	if($username == '')
		header('Location: index.php');
	
	$connection= mysqli_connect("69.65.10.232","mkstin_resume","+o{6Q,sJUgW^","mkstin_resume_host");
	$array=mysqli_query($connection, "select * from initial where username='$username'");
	if(!mysqli_num_rows($array)){
		header('Location:index.php');
	}
	$row = mysqli_fetch_array($array);
	$id = $row['id'];
	$array2 = mysqli_query($connection, "SELECT * FROM hidden WHERE id = '$id'");
	$row2 = mysqli_fetch_array($array2);
	$show_items = array();
	$i=0;
	foreach($row2 as $key=>$val){
		if($val==0 && !is_numeric($key) && $key!='emailid'){
			$show_items[$i] = $key;
			$i+=1;
		}
	}
	$showItems = implode(",", $show_items);
	
	$array1 = mysqli_query($connection, "SELECT $showItems FROM profile WHERE id='$id'");
	$row1 = mysqli_fetch_array($array1);
	$len = count($show_items);
?>
	<body>
		<section class="intro">
			<div class="intro-body">
				<div class="container text-center">
					<div class="row">
						<h1><a href="index.php">Pass.Me</a></h1>
						<h2>Your Profile</h2>
					</div>
					<?php if(isset($_GET['name']) && isset($_SESSION['username']) && $_SESSION['username'] == $_GET['name']) : ?>
						<div class="row">
							<a href="edit.php" class="btn btn-lg btn-danger">Edit profile</a>
						</div>
					<?php endif; ?>
					<div class="row" id="after_hidden">
						<?php
							for($i=0;$i<$len;$i++){
								echo $row1[$show_items[$i]]."<br>";
							}
						?>
						<br><br>
						<div class="col-lg-4"></div>
						<div class="col-lg-4">
							<input type="hidden" value="<?php echo $_GET['name'];?>" id="username"/>
							<input type="text" class="form-control" id="passkey" name="passkey" placeholder="Enter passkey to see complete details"/><br>
							<button class="btn btn-primary" onclick="" id="passkeyEnter">Enter</button>
							<p id="error_log"></p>
						</div>
						<div class="col-lg-4"></div>
					</div>
					
					<script>
						document.getElementById('passkeyEnter').onclick =  function () {
							var key = document.getElementById('passkey').value;
							var username = document.getElementById('username').value;
							var data = "key="+key+"&username="+username;
							$.ajax({
								url : 'process.php',
								type : 'post',
								data : data,
								success : function(r){
									var data = JSON.parse(r);
									//console.log(data.success);
									if(data.success=="true"){
										document.getElementById('after_hidden').innerHTML = data.msg;
									}
									else{
										document.getElementById('error_log').innerHTML = data.msg;
									}
								},
								error : function(e){
									console.log('Error occured while communication with backend');
								}
							});
						};
					</script>
					
				</div>
			</div>
		</section>
	</body>
</html>
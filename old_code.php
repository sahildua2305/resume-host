
<div style="float:right;padding-top:15px;padding-right:30px;">
<form method="POST" action="">
<table border="0">
	<tr><td colspan="5" style="text-align:center;"><h2>Login</h2></td></tr>
	<tr>
		<td>Username:</td>
		<td><input type="text" name="username"></td>
	
		<td>Password:</td>
		<td><input type="password" name="password"></td>
	
		<td>&nbsp;</td>
		<td><input type="submit" value="Sign in" name="login" /></td>
	</tr>
</table>
</form>
</div>
<div>
<form method="POST" action="">
<table border="0">
	<tr><td colspan="2" style="text-align:center;"><h2>Register for the website</h2></td></tr>
	<tr>
		<td>First name</td>
		<td><input type="text" name="firstname"></td>
	</tr>
	<tr>
		<td>Last name</td>
		<td><input type="text" name="lastname"></td>
	</tr>
	<tr>
		<td>Username</td>
		<td><input type="text" name="username"></td>
	</tr>
	<tr>
		<td>Email ID</td>
		<td><input type="email" name="emailid"></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="password" name="password"></td>
	</tr>
	<tr>
		<td>Confirm Password</td>
		<td><input type="password" name="cpassword"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><img src="captcha.php"/></td>
	</tr>
	<tr>
		<td>Enter Security Code:</td>
		<td><input type="text" name="code" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="Sign up" name="registration" /></td>
	</tr>
</table>
</form>
</div>
<?php
session_start();
$connection = mysqli_connect("localhost","root","","passme");
if (isset($_POST['registration']))
{
$username= strip_tags($_POST['username']);
$emailid= strip_tags($_POST['emailid']);
$firstname= ucfirst(strip_tags($_POST['firstname']));
$lastname= ucfirst(strip_tags($_POST['lastname']));
$password= md5(strip_tags($_POST['password']));
$cpassword= md5(strip_tags($_POST['cpassword']));
if($password!=$cpassword)
echo "Password not matching<br>";
if($_POST['code'] != $_SESSION['captcha'])
echo "Please check that you have entered the correct security code!<br>";
$insert2="insert into initial(username,firstname,lastname,password) values('$username','$firstname','$lastname' ,'$password')";
if(mysqli_query($connection, $insert2)) echo "Registration Successful";
else echo "Couldn't Register, Please Try Again!";
}

if(isset($_POST['login']))
{
$username= strip_tags($_POST['username']);
$password= md5(strip_tags($_POST['password']));
$query="select * from initial WHERE username='$username' and password='$password'";
$result=mysqli_query($connection, $query);
$num=mysqli_num_rows($result);
if($num==1)
{
$_SESSION['username']=$_POST['username'];
?>
<script>window.location='session.php'</script>
<?php
}
else
{
?>
<script>
window.location='index.php';
</script>
<?php
echo "Username/Password not matching!!";
}
}
?>
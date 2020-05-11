<?php
	require_once "pdo.php";
// p' OR '1' = '1
	if(isset($_POST['email'])){
$ar=$_POST['email'];
$len=strlen($ar);
$f=0;
for($r=0;$r<$len;$r++){
	if($ar[$r]=='@' || $ar[$r]=='.')
		$f=1;
}
}
if ( isset($_POST['email']) && isset($_POST['password']) ) {
	$var_value=$_POST['email'];
    $sql = "SELECT * FROM users 
        WHERE email = :em AND password = :pw";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':em' => $_POST['email'], 
        ':pw' => $_POST['password']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($row);
   if ( $row === FALSE ) {
      echo "<h1 style=color:red;>Login incorrect.</h1>\n";
      error_log("Login fail ".$_POST['password']);
   } else { 
      echo "<p style=color:green;>Login success.</p>\n";
      error_log("Login success ".$_POST['email']);
      header("Location: autos.php?var=".urlencode($_POST['email']));
   }
}
	if(isset($_POST['email']) && isset($_POST['password'])){
		if($_POST['email']=="" && $_POST['password']==""){
			echo "<p>E-mail and Password must be required</p>";
		}
		if($_POST['password']==""){
			echo "<p>password is empty</p>";
		}
		if($_POST['email']==""){
			echo "<p>E-mail is empty</p>";
		}
	if($_POST['email']!="" && $_POST['password']!=""){
		if($f==0){
		echo "<p style=color:red;>Email must have a @(at) sign.</p>";
			}
	}
	}
	
?>
<html>
<head>
	<title>Karthikeyan A</title>
</head>
<body>
	<div>
		<h1>Please Login</h1>
		<form method="POST">
			email:<input type="text" name="email" ><br>
			<!-- asd@gmail.com -->
			Password:<input type="password" name="password"><br>
			<!-- asd -->
			<input type="submit" value="login">
			<button><a href="index.php">cancel</a></button>
		</form>
		<p>Hint : for email and password, view the source code html comments.</p>
	</div>
</body>
</html>
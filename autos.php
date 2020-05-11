<html>
<head>
	<title>Karthikeyan A</title>
	<?php
require_once "pdo.php";
$vn=$_GET['var'];
if($vn==NULL){
	die("Name parameter missing");
}
if(isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])){
		$f=1;
		if($_POST['year']=="" && $_POST['mileage']==""){
			echo "<p style=color:red;>Mileage and year must be numeric</p>";
			$f=2;
		}
		if($_POST['make']==""){
		echo "<p style=color:red;>Make is required</p>";
		$f=2;
	}
	if($_POST['year']==""){
		echo "<p style=color:red;>year is required</p>";
		$f=2;
	}
	if($_POST['mileage']==""){
		echo "<p style=color:red;>mileage is required</p>";
		$f=2;
	}
	if($_POST['year']!=null || $_POST['mileage']!=null){
	if(is_numeric($_POST['year'])==0){
		echo "<p style=color:red;>year must be numeric</p>";
		$f=2;
	}
	if(is_numeric($_POST['mileage'])==0){
		echo "<p style=color:red;>mileage must be numeric</p>";
		$f=2;
	}
}
	if($f!=2){
		$stmt = $pdo->prepare('INSERT INTO autos
        (make, year, mileage) VALUES ( :mk, :yr, :mi)');
    $stmt->execute(array(
        ':mk' => $_POST['make'],
        ':yr' => $_POST['year'],
        ':mi' => $_POST['mileage'])
    );
    echo "<p style=color:green;>Record inserted</p>";
	}
}
$stmt = $pdo->query("SELECT make, year, mileage, auto_id FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
if ( isset($_POST['delete']) && isset($_POST['auto_id']) ) {
    $sql = "DELETE FROM autos WHERE auto_id = :a";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':a' => $_POST['auto_id']));
}
if ( isset($_POST['button']) ) {
		header('Location: index.php');
    }

?>

</head>
<body>
	<div>
		<h1>Tracking autos for the <span style="color: green;"><?php echo $vn;?></span></h1>
		<form method="POST">
			Make:<input type="text" name="make"><br><br>
			Year:<input type="text" name="year"><br><br>
			Mileage:<input type="text" name="mileage"><br><br>
			<input type="submit" value="Add">
			<input type="submit" name="button" value="Logout"><br>
		</form>
	</div>
	<div><table border="1">
		<tr>
			<th>Name</th>
			<th>Year</th>
			<th>Mileage</th>
			<th>Delete</th>
		</tr>
<?php
foreach ( $rows as $row ) {
    echo "<tr><td>";
    echo($row['make']);
    echo("</td><td>");
    echo($row['year']);
    echo("</td><td>");
    echo($row['mileage']);
    echo("</td><td>");
    echo('<form method="post"><input type="hidden" ');
    echo('name="auto_id" value="'.$row['auto_id'].'">'."\n");
    echo('<input type="submit" value="Del" name="delete">');
    echo("\n</form>\n");
    echo("</td></tr>\n");
}
?>
</table></div>
</body>
</html>

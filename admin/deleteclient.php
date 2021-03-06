<?php include_once "../scripts/connector.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/admin.css" />
    <title>Admin Area | Delete client</title>
</head>
<body>
    

    <?php 

//get value of id in address bar
	$id = $_GET["id"];

	//if there is no id in the url, go back
	if($id < 1){
		header("location: admin-client.php");
	}

	//delete corresponding data from database
	$sql = "DELETE FROM clients WHERE id = '$id'";
	$result = mysqli_query($dbconnect, $sql);

	//if successful
	if($result){
		echo "<div class='admin-container'>
    		<h2>Client successfully deleted!</h2>
		<a href='admin-clients.php'>
			<p><i class='fa fa-arrow-left'></i> Back</p>";
	} else {
		//if not
		echo "Error when deleting client.";
		die(mysqli_error($dbconnect));
	}

?>
</body>
</html>
<?php
	mysqli_close($dbconnect);
?>
<?php
	require_once("support.php");	

	$host = "localhost";
	$user = "dbuser";
	$password = "goodbyeWorld";
	$database = "wall_information";
	$table = "climbs";
	$db = connectToDB($host, $user, $password, $database);
	
	$display = array_values($_POST["display"]);
	$sort = trim($_POST["sort"]);
	$condition = $_POST["condition"];
	
	$sqlQuery = sprintf("select * from %s WHERE $condition ORDER BY " .  $sort, $table);
	$result = mysqli_query($db, $sqlQuery);
	if ($result) {
		$numberOfRows = mysqli_num_rows($result);
 	 	if ($numberOfRows == 0) {
			$body = "<h2>No entries exists in the table</h2>";
		} else {
			$body = "<h2>Maps</h2>";
			$body .= "<table class=table table-bordered>";
			foreach($display as $key){
				$body .= "<th style = border:double;>$key</th>";
			}
			while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$body .= "<tr>";
				foreach ($_POST["display"] as $key){
					$body .= "<td style = border:double;> $recordArray[$key]</td>";
				}

				$body .= "</tr>";
			}
			$body .= "</table>";
			$body .= "<input type=button name=back value = 'Return to Main Menu' onclick = \"location.href = 'main.html';\" /><br>";
     	}	
		mysqli_free_result($result);
	}  else {
		$body = "Retrieving records failed.".mysqli_error($db);
	}
		
	/* Closing */
	mysqli_close($db);
	
	echo generatePage($body);

function connectToDB($host, $user, $password, $database) {
	$db = mysqli_connect($host, $user, $password, $database);
	if (mysqli_connect_errno()) {
		echo "Connect failed.\n".mysqli_connect_error();
		exit();
	}
	return $db;
}
?>
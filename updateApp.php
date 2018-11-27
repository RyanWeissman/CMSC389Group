<?php
	require_once("support.php");

	$body = "";
	if (isset($_POST["submitInfo"])) {
		require_once("support.php");	

		$host = "localhost";
		$user = "dbuser";
		$password = "goodbyeWorld";
		$database = "wall_information";
		$table = "climbs";
		$db = mysqli_connect($host, $user, $password, $database);
			if (mysqli_connect_errno()) {
				echo "Connect failed.\n".mysqli_connect_error();
				exit();
			}

		$name = "";
		$grade = "";
		$color = "";
		$setter = "";
		$date = "";
		$location = "";
		
		$sqlQuery = sprintf("select * from %s", $table); 
		$result = mysqli_query($db, $sqlQuery);
		$body = "";
		while($row = $result->fetch_assoc()){
			if($_POST["name"] == $row["name"]){
			$body .= "right";
			$name = trim($row["name"]);
			$grade = $row["grade"];
			$color = $row["color"];
			$setter = $row["setter"];
			$date = $row["date"];
			$location = $row["location"];
			}
		}
		
		$topPart = <<<EOBODY
		<form action="{$_SERVER["PHP_SELF"]}" method="post">
			<strong>Climb Name: </strong><input type= "text" name= "name" id = "name" value = "$name" ><br><br>
			<strong>Grade: </strong><input type = "text" name = "grade" id = "grade" value = $grade> <br><br>
			<strong>Color: </strong><input type= "text" name = "color" id = "color" value = "$color" /><br><br>
			<strong>Setter: </strong><input type= "text" name = "setter" id = "setter" value = "$setter" /><br><br>
			<strong>Date:</strong><input type= "text" name = "date" id = "date" value = "$date" /><br><br>
			<strong>Location: </strong><input type= "text" name= "location" id = "location" value = $location /><br><br>

			<input type='submit' name=submitInfoButton2 value = "Submit Data"/><br>
		</form>
		<input onclick="location.href= 'map.php';"" type='button' name='back' value= 'Return to Main Menu'/><br>
EOBODY;
	$body = $topPart;
		mysqli_close($db);
		echo generatePage($body);
	}
		if (isset($_POST["submitInfoButton2"])) {
			require_once("support.php");	

			$host = "localhost";
			$user = "dbuser";
			$password = "goodbyeWorld";
			$database = "wall_information";
			$table = "climbs";
			$db = mysqli_connect($host, $user, $password, $database);
			if (mysqli_connect_errno()) {
				echo "Connect failed.\n".mysqli_connect_error();
				exit();
			}

			$name = trim($_POST["name"]);
			$grade = intval($_POST["grade"]);
			$color = trim($_POST["color"]);
			$setter = trim($_POST["setter"]);
			$date = $_POST["date"];
			$location = intval($_POST["location"]);
			

			$sqlQuery = "update climbs set grade = '".$grade."'".", color = '".$color."'".", setter = '".$setter."'".", date = '".$date."'".", location = '".$location."'"." where name='".$name."'"; 
			$result = mysqli_query($db, $sqlQuery);
	
			if ($result) {
				$body = <<<EOFDATA
						<h3>The entry has been updated</h3>
						<p>
						Name: $name <br>
						Grade: $grade <br>
						Color: $color <br>
						Setter: $setter <br>
						Date: $date <br>
						Location: $location <br>
						<input type=button name=back value = "Return to Main Menu" onclick = "location.href = 'map.php';" /><br>
						</p>
EOFDATA;
			} else { 				   ;
				$body = "Inserting records failed.".mysqli_error($db);
			}
		
			/* Closing */
			mysqli_close($db);
	
			echo generatePage($body);
		}
?>
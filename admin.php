<?php
	require_once("support.php");

		$body = <<<EOFDATA
			<h1>Maps</h1>
			<form action = "adminDisplay.php" method = "post">
			<strong>Select fields to display</strong><br>
			<select name = "display[]" multiple=multiple>
				<option value = "name"> name </option>
				<option value = "grade"> grade </option>
				<option value = "color"> color </option>
				<option value = "setter"> setter </option>
				<option value = "date"> date </option>
				<option value = "location"> location </option>
			</select><br>
			<strong> Select field to sort applications </strong>
			<select name = "sort">
				<option value = "name"> name </option>
				<option value = "grade"> grade </option>
				<option value = "color"> color </option>
				<option value = "setter"> setter </option>
				<option value = "date"> date </option>
				<option value = "location"> location </option>
			</select><br><br>
			<strong>Filter Condition:</strong>
			<input type = "text" name = "condition" size="60"/><br><br>

			<input type=submit name=submitInfo value = "Display Maps" onclick = "location.href = 'adminDisplay.php';"/><br><br>
			<input type=button name=back value = "Return to Main Menu" onclick = "location.href = 'map.php';" /><br>
			</form>
EOFDATA;

		$page = generatePage($body);
		echo $page;		
?>
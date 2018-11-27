<?php session_start(); ?>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Map</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="map.css">
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <?php
              if(!isset($_SESSION['user'])){
                echo "<a class='nav-link' href='main.php'>Login</a>";
              } else {
                echo "<a class='nav-link' href='logout.php'>Logout</a>" ;
              }
            ?>
          </li>
          <li class='nav-item'>
            <?php
            if(isset($_SESSION['admin'])){
              if(($_SESSION['admin']) == 1){ 
                echo "<a class='nav-link' href='admin.php''>Admin</a>";
              }
            } 
            ?> 
          </li>
        </ul>
      </div>
    </nav>
    <?php echo isset($_SESSION['admin']); ?>
  	<canvas id="mapCanvas" width="960" height="700"></canvas>

    <div id="popup" class="popup" 
      <?php 
        if(isset($_GET["location"])){
          echo "style='display:block'";
        }else{

          echo "style='display:none'";
        }
      ?>>  
      <div class="popup-content">
        <span class="close">&times;</span>
        <div id="location-info">
          <table id='table' class='table'>
              <?php
                echo "<thead><tr>
                  <th scope\"col\">Name</th>
                  <th scope\"col\">Grade (Rating)</th>
                  <th scope\"col\">Color</th>
                  <th scope\"col\">Setter</th>
                  <th scope\"col\">Date</th>";
                  if(isset($_SESSION["user"])){
                    echo "<th scope\"col\">Review</th>";
                  }
                  echo "</tr></thead>";

                $user = 'dbuser';
                $password = 'goodbyeWorld';
                $db = 'wall_information';
                $host = 'localhost';

                $conn = new mysqli(
                  $host,
                  $user,
                  $password,
                  $db
                );
                if($conn->connect_error) {
                  die('Could not connect: ' . $conn->connect_error);
                }

                $sql = "SELECT c.name, c.grade, c.color, c.setter, c.date FROM `climbs` AS c WHERE c.location = " . $_GET["location"];

                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_row($result);
                while($row != null){
                  $ratingSql = "SELECT AVG(grade) FROM `reviews` WHERE name = \"" . $row[0] . "\"";
                  $ratingResult = mysqli_query($conn, $ratingSql);
                  $rating = mysqli_fetch_row($ratingResult)[0];
                  if(!isset($rating)){
                    $rating = $row[1];
                  }
                  echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "  (". number_format((float)$rating, 1, '.', '') . ")</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td>";
                  if(isset($_SESSION["user"])){
                    echo "<td> <select> 
                        <option value=''>--</option>
                        <option value='0'>0</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                        <option value='5'>5</option>
                        <option value='6'>6</option>
                        <option value='7'>7</option>
                        <option value='8'>8</option>
                        <option value='9'>9</option>
                        <option value='10'>10</option>
                        <option value='11'>11</option>
                        <option value='12'>12</option>
                        </select></td>"; //TODO on change, update the logged in users review for this climb
                  }
                  echo "</tr>";
                  $row = mysqli_fetch_row($result);
              }
              mysqli_close($conn);
              ?>
          </table>
        </div>
      </div>
    </div>
          
  	<script>
      var popup = document.getElementById('popup');
      var close = document.getElementsByClassName("close")[0];
      var info = document.getElementById("location-info");
      close.onclick = function() {
        popup.style.display = "none";
      }
      window.onclick = function(event) {
        if (event.target == popup) {
          popup.style.display = "none";
        }
      }

  		var cx = document.querySelector("canvas").getContext("2d");
  		var img = document.createElement("img");
  		img.src = "map.jpg";
  		img.addEventListener("load", function() { 
  			cx.drawImage(img, 0, 0);
  		});

  		var mapCanvas = document.getElementById("mapCanvas");
  		mapCanvas.addEventListener("mousedown", function(event){
  			console.log("canvas clicked at (" + event.pageX + ", " + event.pageY + ")")
  			let x = event.pageX
  			let y = event.pageY
  			for(let i = 0; i < coordinates.length; i++){
  				coord = coordinates[i];
  				if(x >= coord[0] && x < coord[1] && y >= coord[2] && y < coord[3]){
  					
  					// cx.fillStyle="lightgreen"
  					// cx.fillRect(coord[0], coord[2], coord[1]-coord[0], coord[3]-coord[2]);
            // popup.style.display = "block";
            // info.innerHTML = "Location is section " + i;
  					//TODO fill popup with database info
            window.location='map.php?location=' + i
  					return i;
  				}
  			}
  			
  		});

  		let coordinates = [
  			[80, 325, 20, 175],
  			[80, 325, 175, 520],
  			[80, 325, 520, 670],
  			[325, 915, 20, 175],
  			[325, 710, 175, 340],
  			[325, 500, 340, 670],
  			[500, 710, 340, 670],
  			[710, 915, 175, 670]
  		];
  				
  	</script>
  </body>
</html>
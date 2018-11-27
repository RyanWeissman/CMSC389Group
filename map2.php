<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Map</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="stylesheet.css">
  </head>
  <body >
  	<!-- TODO BOOTSTRAP Nav bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <?php
        if((isset($_SESSION['name']))){
        echo "<a class='nav-link' href='main.html'>Login</a>";
      } else {
         echo "<a class='nav-link' href='logout.php'>Logout</a>";
      }
        ?>
      </li>
      <li class="nav-item">
        <?php
        if((isset($_SESSION['admin']))){
          if(($_SESSION['admin']) == 1){ 
        echo "<a class='nav-link' href='adminDisplay.php''>Admin</a>";
      }
    } else {
        echo "<a class='nav-link' href='adminDisplay.php''>Admin</a>";
      }
        ?>
      </li>
    </ul>
  </div>
</nav>

  	<!-- TODO scale with screen size -->
  	<canvas id="mapCanvas" width="960" height="700"></canvas>

    <div id="popup" class="popup" <?php 
      if(isset(_GET["location"])){
        echo "style='display:none'";
      }else{

        echo "style='display:block'";
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
                  <th scope\"col\">Date</th>
                  <th scope\"col\">Review</th></tr></thead>";
                //TODO make connectection and fill data. 
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

                $sql = "SELECT c.name, c.grade, c.color, c.setter, c.date, AVG(r.grade) FROM `climbs` AS c, `reviews` AS r WHERE c.location = " . $_GET["location"] . " and c.name = r.name GROUP BY r.name";
                
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_row($result);
                while($row != null){
                  echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "  (". $row[5] . ")</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" .  "</td></tr>";
                  $row = mysqli_fetch_row($result);
              }
              echo "</table>";              
              mysqli_close($conn);
              ?>
            </thead>

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
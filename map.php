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
                $sql = "SELECT c.name, c.grade, c.color, c.setter, c.date, AVG(r.grade) FROM climbs AS c, reviews AS r WHERE c.location == " . location . "and c.name = r.name";
                echo "<tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td></tr>";


                echo "</table>";              
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
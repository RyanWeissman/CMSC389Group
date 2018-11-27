<?php
session_start();

$var1     = $_POST['grade'];
$var2     = $_POST['name'];
$user     = 'dbuser';
$password = 'goodbyeWorld';
$db       = 'wall_information';
$host     = 'localhost';



if(isset($_SESSION["user"])){
$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die('Could not connect: ' . $conn->connect_error);
}
$u =  $_SESSION["user"];
$sql = "Insert into reviews  values('$var2','$u',$var1)";
$result = mysqli_query($conn, $sql);

mysqli_close($conn);
}



?>
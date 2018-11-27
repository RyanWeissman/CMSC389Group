<?php
  session_start();
  require_once("support.php");

  if (!isset($_SESSION['login']) && !isset($_SESSION['signup'])) {
    $_SESSION['login'] = false;
    $_SESSION['signup'] = false;
  }

  $host = "localhost";
  $user = "dbuser";
  $password = "goodbyeWorld";
  $database = "wall_information";
  $table = "users";

  if (!isset($_POST["login"])) {
    if ($_SESSION['signup'] == false) {
      $_SESSION['signup'] = true;
      $_SESSION['login'] = false;

      $body = <<<EOFBODY


      <div class="wrapper">
        <div id="formContent">
          <div>
            <h1>Sign Up</h1>
          </div>

          <form action = "{$_SERVER["PHP_SELF"]}" method = "post">
            <input required type="text" name= "name" placeholder="name"/>
            <input required type = "text" name = "email" placeholder="email"/>
            <strong>Admin: &nbsp; </strong>
            <input type = "radio" required name = "admin" value = "1" />&nbsp; Yes
            &nbsp; <input type = "radio" required name = "admin" value = "0" />&nbsp; No
            <input required type= "password" name= "password" id = "password" placeholder="password"/>
            <input required type= "password" name= "verifypassword" id = "verifypassword" placeholder="verify password"/>
            <br></br>
            <input type="submit" name="submitUser" value= "Sign up" />
          </form>
          <form action="{$_SERVER["PHP_SELF"]}" method = "post">
            <input type="submit" name="login" value = "Login"/>
          </form>
        </div>
      </div>
EOFBODY;
      echo generatePage($body);
    }
    else{
      if ($_POST["password"] != $_POST["verifypassword"]) {
        echo "<h2>Passwords do not match!</h2>";
      }
      else {
        $_SESSION['signup'] = false;
        $_SESSION['login'] = false;

        $db_connection = new mysqli($host, $user, $password, $database);
        if ($db_connection->connect_error) {
          die($db_connection->connect_error);
        }
        else {
          $name = trim($_POST["name"]);
          $email = trim($_POST["email"]);
          $admin = intval($_POST["admin"]);
          $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
          $query = "Insert into users (name, email, admin, password) values ('$name', '$email', '$admin', '$password')";
          $result = $db_connection->query($query);
          if ($result) {
            $_SESSION['user'] = $email;
            $_SESSION['admin'] = $admin;
            header('Location: map.php');
          } 
          else {           
            $body = "Insertion failed: ".$db_connection->error;
            echo "<h2>Sign up failed!</h2>";
          }
          $db_connection->close();
        }
      }
    }
    
  }
  else if (isset($_POST["login"])) {
    if ($_SESSION['login'] == false) {
      $_SESSION['login'] = true;
      $_SESSION['signup'] = false;
      $body = <<<EOFBODY
        <div class="wrapper">
        <div id="formContent">
          <div>
            <h1>Login</h1>
          </div>

          <form action = "{$_SERVER["PHP_SELF"]}" method = "post">
            <input required type = "text" name = "email" placeholder="email"/>
            <input required type= "password" name= "password" id = "password" placeholder="password"/>
            <br></br>
            <input type="submit" name="login" value = "Login"/>
          </form>
          <form action="{$_SERVER["PHP_SELF"]}" method = "post">
            <input type="submit" name="submitUser" value= "Sign up" />
          </form>
        </div>
      </div>
EOFBODY;
      echo generatePage($body);
    }
    else {
      $_SESSION['login'] = false;
      $_SESSION['signup'] = false;
      $db_connection = new mysqli($host, $user, $password, $database);

      if ($db_connection->connect_error) {
        die($db_connection->connect_error);
      } 
      else {
        $email = trim($_POST["email"]);
        $query = "SELECT name, email, password, admin FROM users WHERE users.email='".$email."'";
        $result = $db_connection->query($query);
        if ($result->num_rows > 0) {
          $result = $result->fetch_assoc();
          if (password_verify($_POST["password"], $result["password"])) {
            $_SESSION['user'] = $email;
            $_SESSION['admin'] = $admin;
            header('Location: map.php');
          }
          else {
            $body = "Passwords do not match!";
          }
        }
        else {
          $body = "Wrong email!".$db_connection->error;
        }
        $db_connection->close();
        echo generatePage($body);
      }
    }
  }
  
?>
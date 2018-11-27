<?php
function generatePage($body, $title="Example") {
    $page = <<<EOPAGE
<!doctype html>
<html>
    <head> 
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
	    <meta charset="utf-8">
	    <title>Login</title>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous"> 
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">	
	    <link rel="stylesheet" href="main.css" type="text/css">
    </head>
            
    <body">
            $body
    </body>
</html>
EOPAGE;
    return $page;
}
function generateResult($name, $email, $gpa, $year, $gender) {
	$body = <<<EOFBODY
		<p>
			Name: $name <br>
			Email: $email <br>
			Gpa: $gpa <br>
			Year: $year <br>
			Gender: $gender <br>
			<input type=button name=back value = "Return to Main Menu" onclick = "location.href = 'main.html';" /><br>
		</p>
EOFBODY;
	return $body;
}
?>
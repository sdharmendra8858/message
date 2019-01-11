<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width,initial-scale=1">
	    <title>Contact form</title>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	    <style>
	    	h1{
	    		color: Purple;
	    	}
	    	.contactForm{
	    		border: 1px solid #7c73f6;
	    		margin-top: 50px;
	    		border-radius: 15px;
	    	}
	    </style>
    </head>
    <body>
    	<div class="container-fluid">
    		<div class="row">
    			<div class="col-sm-offset-1 col-sm-10 contactForm">
    				<h1>Contact Us:</h1>
 <?php
 $errors=$resultMessage=$headers="";
 //geting user input
 if(isset($_POST["name"])){
 $name = $_POST["name"];}
 if(isset($_POST["email"])){
 $email = $_POST["email"];}
 if(isset($_POST["message"])){
 $message=$_POST["message"];}
 //error messages
 $missingName='<p><strong>Please enter your name!</strong></p>';
 $missingEmail='<p><strong>Please enter your Email!</strong></p>';
 $invalidEmail='<p><strong>Please enter a valid Email!</strong></p>';
 $missingMessage='<p><strong>Please enter your Message!</strong></p>';
//if the user has submitted the form
if(isset($_POST["submit"])){
	//check for errors
	if(!$name){
		$errors .= $missingName;
	}else{
		$name=filter_var($name,FILTER_SANITIZE_STRING);
	}
	if(!$email){
		$errors .=$missingEmail;
	}else{
		$email=filter_var($email,FILTER_SANITIZE_EMAIL);
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$errors .=$invalidEmail;
		}
	}
	if(!$message){
		$errors .=$missingMessage;
	}else{
		$message=filter_var($message,FILTER_SANITIZE_STRING);
	}
		//if there are any errors
		if($errors){
			//print error message
			$resultMessage = '<div class="alert alert-danger" >'. $errors .'</div>';
		}else{
			$to = $email;
			$subject = "Contact";
			$message="<p>Name: $name..</p>
					<p>Email: $email.</p>
					<p>Message:</p>
					<p><strong>$message</strong></p>";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: <webmaster@example.com>';
			if(mail($to,$subject, $message, $headers)){
			//	$resultMessage='<div class="alert alert-success">Thanks for your message we will get back to as soon as possible</div>';
				header("Location:thanksformessage.php");
			}else{
				$resultMessage='<div class="alert alert-warning">unable to send email.</div>';

			}
		}
	echo $resultMessage;
}

    				?>
    				<form action="index.php" method="post">
    					<div class="form-group">
    						<label for="name">Name:</label>
    						<input type="text" name="name" id="name" placeholder="Name" class="form-control" value="<?php if(isset($_POST["name"])){echo $_POST["name"];}?>">
    					</div>
    					<div class="form-group">
    						<label for="email">Email:</label>
    						<input type="text" name="email" id="email" placeholder="Email" class="form-control" value="<?php if(isset($_POST["email"])){echo $_POST["email"];}?>">
    					</div>
    					<div class="form-group">
    						<label for="message">Message:</label>
    						<textarea  name="message" id="message" class="form-control" rows="5"><?php if(isset($_POST["message"])){echo $_POST["message"];}?></textarea>
    					</div>
    					<input type="submit" name="submit" class="btn btn-success btn-lg" value="Send Message">
    				</form>
    			</div>
    		</div>
    	</div>
		
        
    </body>
</html>
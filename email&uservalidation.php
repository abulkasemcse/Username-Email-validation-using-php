<!DOCTYPE html>
<html>
<head>
	<title>Email and User Validation</title>
	<style type="text/css">		
		.error
		{
			color: red;
		}
		fieldset {
    font: 1em Verdana, Geneva, sans-serif;
    text-transform: none;
    color: whitesmoke;
    background: black;
    border: thin solid #333;
    }
		body{
			text-align: center;
			font-weight: bolder;
			color: greenyellow;
		}
		

	</style>
</head>
<body>
	<fieldset>

	<?php 

	$nameErr=$emailErr="";

	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$name=$_POST['name'];
		$length=strlen($name);
		if(empty($_POST['name']))
		{
			$nameErr="Name is required!";
		}

		else if(!preg_match("/^[a-zA-Z]*$/",$name))
		{
			$nameErr="Only alphabet character are allowed";
		}

		else if($length <4 || $length >8)
		{
			$nameErr="Username must be within 8 characters";
		}

		if(empty($_POST['email']))
		{
			$emailErr="Email is required!";

		}
		else
		{
			$email=$_POST['email'];
			if(!filter_var($email,FILTER_VALIDATE_EMAIL))
			{
				$emailErr="Invalid Email Address!";
			}
		}
		

	}

	?>

	<h2>Type any Username and Email to Display Validation Form</h2>

	<span class="error">* Required Field</span>
	<br><br>
	<form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		Name:
		<input type="text" name="name">
		<span class="error">* <?php echo $nameErr; ?></span>
		<br><br>
		E_mail:
		<input type="text" name="email">
		<span class="error">* <?php echo $emailErr; ?></span>

		<br><br>
		<input type="submit" name="submit" value="Login">
		<input type="reset" name="reset" value="Cancel">
	</form>

</body>
</html>
</fieldset>
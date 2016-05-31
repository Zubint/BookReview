<?php 

?>

<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- <script src="/assets/js/jquery.min.js" type="text/javascript" charset="utf-8" async defer></script> -->
	<link rel="stylesheet" href="/assets/css/style.css">
	<title>Welcome to the Book Review App</title>
</head>
<body>
	<div class="wrapper">
		<div class="container">
			<h1>Welcome!</h1>	
			<?php echo validation_errors() ?>
			<form method="POST" action='/users/new' class="register">
				<h4 class="register"> Register an Account</h4>
					<label class="register">Name:</label> 

					<input class="register" type="text" id="name" name="name" placeholder="Enter fullname">

					<label class="register">Alias</label>

					<input name ="alias" class="register" type="text" id="alias" placeholder="Enter an Alias">

					<label class="register">Email:</label>

					<input name="email" class="register" type="text" id="email" placeholder="Enter your email address">

					<label class="register">Password:</label>

					<input name="password" class="register" type="password" id="password" placeholder="Enter a password - at least 8 characters long">

					<label class="register">Confirm password:</label>

					<input name="conf_password" class="register" type="password" id="conf_password" placeholder="Re-enter your password exactly as above">

					<button class="register primary" type="submit">Register</button>
					
			</form>

			<form method="post" action="/users/login" id="users_login" class="register">
			<h4 class="register"> <a href="/books">Login to your account</a></h4>
				<label class="register">Email:</label>
				<input class="register" type="text" id="login_email" name="login_email" placeholder="Enter your email address">

				<label class="register">Password:</label>

				<input class="register"type="password" name="login_password" id="login_password" placeholder="Enter a password - at least 8 characters long">
				<button class="register primary" type="submit" value="Login">Login</button>
				<?php if(null!= $this->session->flashdata('login_error')){ echo($this->session->flashdata('login_error'));} ?>
			</form>
		</div>
	</div>
</body>
</html>
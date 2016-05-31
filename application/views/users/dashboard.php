<?php
?>

<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<script src="/assets/js/jquery.min.js" type="text/javascript" charset="utf-8" async defer></script>
		<link rel="stylesheet" href="/assets/css/style.css">
		<title>Book Review App</title>
	</head>
	<body>
		<div class="wrapper">
			<div class="nav">
				<h1 class="nav">Welcome!</h1>
				<ul id="nav" class="nav-links">
					<li class="nav-links" id="1" class="visible"><a href="/books/add">Add Book & review</a></li>
					<li class="nav-links" id="2" class="visible"><a href="/books">Home</a></li>
					<li class="nav-links" id="3" class="visible"><a href="/users/logout">Logout</a></li>
				</ul>
			</div>

			<div class="container">
				<div class="user_info">
					<!-- <?php // var_dump($user_data); ?> -->

					<h4 class="user_info">User Alias: <?=$user_data['alias'] ?> </h4>
					<h5 class="user_info"> Name: <?=$user_data['name'] ?></h5>
					<h4 class="user_info">Email: <?=$user_data['email'] ?> </h4>
					<h4 class="user_info">Reviews: <?= count($user_data['user_reviews']) ?> </h4>
				</div>
				<div class="user_info">
					
					<h3 class="border-bottom">Posted Reviews on the following books</h3> 
					<div id="sroll">
						<ul class="no-list-style">
							<?php 

								foreach($user_data['user_reviews'] as $review)
								{
									echo (

											"<li><a href='/books/show/" . $review['book_id'] . "'>" . $review['title'] . "</a></li>"
										);
								}
							?>
						</ul>
					</div>
				</div>
			</div>
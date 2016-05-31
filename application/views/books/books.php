<!DOCTYPE html>
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
				<h1 class="nav">Welcome, <?= $this->session->userdata('name') ?>!</h1>
				<ul id="nav" class="nav-links">
					<li class="nav-links" id="1" class="visible"><a href="/books/add">Add Book & review</a></li>
					<!-- <li class="nav-links" id="2" class="visible"><a href=""><Home</a></li>-->
					<li class="nav-links" id="3" class="visible"><a href="/users/logout">Logout</a></li>
				</ul>
			</div>

			<div class="container">
				<div class="recentReviews">
				<h2> Recent Reviews </h2>
				<?php 

				// var_dump($all_reviews);
					$this->load->helper('date');

					foreach($latest_reviews as $review)
					{
							$postedDate = mysql_to_unix($review['created_at']);
							$postedDate = mdate('%M %d %Y', $postedDate);
							$starString = "<p class='review-body'> Rating: ";

							for ($i=0; $i<$review['rating']; $i++)
								{
									$starString .= "<img class='star' src='/assets/img/star.jpeg'>";
								}

							$starString .= "</p>";

						echo("<div class='review'>
							<p class='title'><a href='/books/show/" . $review['book_id'] . "''>" .
							$review['title'] . "</a></p>" . $starString .
							"<p class='review-body'> 
							<a href='/users/show/" . $review['id'] . "'>" . $review['alias'] . "</a>" . " says: " . $review['review'] .
							"</p>" .
							"<p class='post-date review-body'> Posted on " . $postedDate . " </p>" .
							"</div>"
							);
					}

				?>
				</div>



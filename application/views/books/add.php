

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
				<h1 class="nav">Welcome!</h1>
				<ul id="nav" class="nav-links">
					<!-- <li class="nav-links" id="1" class="visible"><a href="/something">Add Book & review</a></li> -->
					<li class="nav-links" id="2" class="visible"><a href="/books">Home</a></li>
					<li class="nav-links" id="3" class="visible"><a href="/users/logout">Logout</a></li>
				</ul>
			</div>

			<div class="container">
			<form method="POST" action="/books/newTitle" name="addtitle" class="books">

			<h4 class="register"> Add a new book title and a Review</h4>
				<p>
					<?= validation_errors(); ?>
				</p>
				<p>
					<label class="books">Book Title:</label> 
					<input name= "books" class="books" type="text" id="book_title">
				</p>
				<p>

				<label class="books">Author Choose one:</label>
					<select name = "author_id" id="author_id">

										<?php 

						if ($authors != null)
						{
							// var_dump($authors);
							// die();
							echo ("<option value=0> Select an author </option>");
							foreach($authors as $author)
							{
								echo (
									"<option" . " value=" . $author['id'] .">" . $author['name'] . "</option>"
									);
							}
						}
						else
						{
							echo (
									"<option value=0> No Authors On File </option>"
									);	
						}

						?>

					</select>
				</p>
				<p>
				<label>OR Enter a new Name Below:</label>
					<input name = "author_name" class="books" type="text" id="author">
					<?php if (null!==($this->session->flashdata('author_error')))
					 { echo ($this->session->flashdata('author_error'));
					 } ?>
				</p>
				<label class="books">Review:</label>
				<textarea name="review" class="books" id="review">
				</textarea> 
				<label class="books">Rating:</label>
				<input name="rating" class="books" type="number" min=1 max=5 id="rating" value=1>
				<button class="primary books" type="submit" name = "add_book_and_review"> Add book and review</button>

			</form>
			
		</div>
	</div>
</body>
</html>
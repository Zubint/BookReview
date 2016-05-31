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
				<div class="recentReviews">

				<?php 

					// var_dump ($reviews);

					$this->load->helper('date');

					$htmlHeader = "<h2>" . 
								$reviews[0]['title'] . "</h2>" .
								"<p> Author:" . $reviews[0]['name'] ."</p>" .
								"<h4> Reviews: </h4>";
					$htmlString = "";
					foreach($reviews as $review)
						{
						
								$postedDate = mysql_to_unix($review['created_at']);
								$postedDate = mdate('%M %d, %Y', $postedDate);
								// $postedDateDiff =timespan(mysql_to_unix($review['created_at']),time());
								$postedDateDiff = (time() - mysql_to_unix($review['created_at']));
								// $postedDateDiff = mdate('%d %h %m');

								//now choose a case and provide an abridged time:

								$days = ($postedDateDiff/60/60/24);
								$hours = ($days - intval($days))*24;
								$minutes = ($hours*60)%60;

								$timeSpan = null;

								if (intval($days) > 0){
									$timeSpan = "About " . intval($days) . " days ";
								}else if (intval($hours) > 0 ){
									$timeSpan .= intval($hours) . " hours";
								}else if (intval($minutes) > 0){
									$timeSpan .= intval($minutes) . " minutes";
								}

								if ($timeSpan !=null )
								{
									$timeSpan.=" ago.";
								}
								else
								{
									$timeSpan = "A few seconds ago...";
								}

								$starString = "<p class='review-body'> Rating: ";

								for($i=0; $i<$review['rating']; $i++)
								{
									$starString .= "<img class='star' src='/assets/img/star.jpeg'>";
								}

								if ($review['user_id'] == $this->session->userdata['id'])
								{
									$deleteURL = "<a href='/reviews/delete/" . $review['review_id'] . "/" . $review['book_id'] . "'> Delete this review</a>";
								}
								else
								{
									$deleteURL = "";
								}

								$starString .="</p>";

								$htmlString .= "<div class='review top-border'>" .
								$starString .
								"<p class='review-body'>" .
								"<a href='/users/show/" . $review['user_id'] . "'>" . $review['alias'] . "</a> says: " .
								$review['review'] .
								"</p>" .
								 "<p class='post-date review-body'> Posted " . $timeSpan  . "</p>"
								 .
								"</div>";

								// "<p class='post-date review-body'> Posted on " . $postedDate . " " . "(" . $postedDateDiff . " ago) " . $days . " days " . $hours . " hours " . $minutes  . " minutes "  . " " . $deleteURL . "</p>"
						}
						echo ($htmlHeader . $htmlString);


					?><!-- 
					<h2> The greates salesman in the world </h2>
					<p> Author's Name</p>
					<h4> Reviews:</h4>
					<div class="review top-border">
						<p class="review-body "> Rating:
						<img class="star" src="/assets/img/star.jpeg">
						<img class="star" src="/assets/img/star.jpeg">
						<img class="star" src="/assets/img/star.jpeg">
						<img class="star" src="/assets/img/star.jpeg">
						<img class="star" src="/assets/img/star.jpeg">
						</p>
						<p class="review-body">
						<a href="/users">Jerry</a> says:  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</p>
						<p class="post-date review-body"> Posted on November 23, 2014
							<a class="post-date" href="/books/deleteReview/id">Delete this review</a> *ONLY IF USER WROTE IT
						</p>
					</div> -->
				</div>

				<div class="otherReviews">
					<h2> Add your review </h2>
					<form method="POST" action="/books/addReviewToBook">
						<textarea name="review" id="book_review" value="books list"></textarea>
						<label class="books">Rating:</label>
							<input  name="rating" type="number" min=1 max=5 id="rating" value=1>
							<?= "<input type='hidden' name='book_id' value=" . $review['book_id'] . ">" ?>
						<p>
							<input type="submit" value="Submit Review" class="primary">
						</p>
						<?= validation_errors() ?>
					</form>
				</div>
		</div>
	</div>
</body>
</html>

		

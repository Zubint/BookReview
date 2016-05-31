				<div class="otherReviews" id='scroll'>
					<h2> Other Books with reviews </h2>

					<?php 
						$htmlStr="";
						foreach($all_reviewed as $review)
						{
							$htmlStr .= "<a class='otherReviews' href='/books/show/" . $review['book_id'] . "'>" .
									  $review['title'] . "</a>";

						} 
						
					echo( "<div class='otherReviews'>
						  ".$htmlStr . "</div>");
					?>
				</div>
			</div>
		</div>
	</body>
</html>	
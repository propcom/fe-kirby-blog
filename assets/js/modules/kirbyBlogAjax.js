;(function() {
	'use strict';

	window.ready = {
		// Run all teh things below.
		init: function() {
			for(var funcs in ready) {
				if(funcs == 'init') continue;
				ready[funcs]();
			}
		},

		// Ajax Kirby 'blog' API
		ajaxCall: function() {

			// Do we REALLY need to fire this...?
			var object = $('.isotope-container');
			if (object) {

				//Define first page to load; Note - Page 1 is hardcoded in blog.php
				var page = 2;

				// Look for click... Scroll fires this click in scroll.js
				$('.js-blog__loadMore').on('click', function(){

					// Change Text to loading and stop more calls by removing the class
					$('.js-blog__loadMore').html('Loading...');
					$('.blog__loadMore').removeClass('js-blog__loadMore');

					// Actual Ajax call
					$.ajax({
						url: 'blog-api/page:' + page,
						type: 'GET',
						dataType: 'json'
					})
					.success(function(feed) {
						// Check is we've loaded the last page to resolve loading from the start again
						if(page > feed.pages) {
							$('.blog__loadMore').html('No More Posts To Load');
						} else {
							// Add to the page var so we can count... 1, ah ah ah. 2, ah ah ah. 3, ah ah ah.
							page++;

							// Loop through the posts
							for(var i = 0; i < 10; i++) {
								var postData = feed.data[i];
								var postNum = i + 1;

								// render the boxes
								var newItem = '<article class="blog__post blog__post--' + postNum + ' blog__post--' + postData.tag + '"><div class="blog__post--tags">' +
								postData.tag + '</div>';

								if(postData.images) {
									newItem += '<div class="blog__post--img">' +
									'<img src="'+postData.images+'"></div>';
								}

								newItem += postData.date;
								newItem += '<h1>' + postData.title + '</h1>';
								newItem += '<p>' + postData.text + '</p>';
								newItem += '<a class="blog__post--readMore" href="' + postData.url + '">Continue Reading</a>';

								newItem += '</article>';

								// Insert into the container and run isotope
								$('.isotope-container').append(newItem).isotope('reloadItems').isotope({sortBy: 'original-order' });

								// Return the class so we can load more and change the text for UI good-ness
								$('.blog__loadMore').addClass('js-blog__loadMore');
								$('.js-blog__loadMore').html('Load More Posts');
							}
						}
						// PLL... This actually does... Nothing. Need to fix... ヘ(°◇、°)ノ
						procedural.core_funcs['init']();
					})
					.error(function() {
						// Yay Errors! (Least descriptive error message in history)
						$('.blog__loadMore').html('Error Loading Posts');
					})
				});
			}
		},
	}

	$(function() {
		ready.init();
	});

})();
function wipe() {
	var homeBlog = document.getElementsByClassName("home-blog fix");
	homeBlog[0].innerHTML = "";
	var frontPageLeft = document.getElementById("episodeMedia");
	frontPageLeft = frontPageLeft.innerHTML;
	frontPageLeft = JSON.parse(frontPageLeft);

	for (i=0; i<frontPageLeft.length; i++) {
		var homeHTML = '';
		homeHTML += '<div class="container-960"><div class="row"><div class="column column-6">';
		homeHTML += '<h1>Featured Podcast</h1>';
		homeHTML += '<div class="column column-12 front-episode-box" id="episode-' + frontPageLeft[i].number + '" style="background-image: url(' + frontPageLeft[i].bgImgUrl + ')">';
		homeHTML += '<div class="front-episode-content">';
		homeHTML += '<div class="front-episode-content-filter hover-inactive"></div>';
		homeHTML += '<h2>' + frontPageLeft[i].fp_title + '</h2>';
		homeHTML += '<p class="hover-inactive">' + frontPageLeft[i].desc + '</p></div>';
		homeHTML += '<div class="front-episode-footer"><h2>EPISODE ' + frontPageLeft[i].number + '</h2></div></div>';
		homeHTML += '</div>';
	}
	
	homeBlog[0].innerHTML = homeHTML;
};

wipe();

//Show episode description and box filter on hover
$('.front-episode-box').hover(function(){
	$episodeContentP = $(this).find('.front-episode-content p');
	$episodeContentFilter = $(this).find('.front-episode-content-filter');
	$($episodeContentP).toggleClass('hover-inactive');
	$($episodeContentP).toggleClass('hover-active');
	$($episodeContentFilter).toggleClass('hover-inactive');
	$($episodeContentFilter).toggleClass('hover-active');
});

$('.front-episode-box').click(function(){
	window.location = "http://cobe.wpengine.com/podcast";
	return false;
});


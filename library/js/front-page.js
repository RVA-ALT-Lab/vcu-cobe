jQuery(document).ready(function($){

//use the instafeed script to load instagram widget
var userFeed = new Instafeed({
	get: 'user',
	userId: 1961856070,
	accessToken : '1961856070.1677ed0.fd464c0df99a4bb3b816a4dd21ee2ba0',
	limit: 1,
	resolution: 'standard_resolution',
	template: '<div class="ig-box"><a href="{{link}}"><div class="ig-filter hover-inactive"><p class="hover-inactive">{{caption}}</p></div><img src="{{image}}" alt="Caption reads {{caption}}" /></a></div>'
});
userFeed.run();

//Show image description and box filter on hover
$('#instafeed').hover(function(){
	$igP = $(this).find('p');
	$igFilter = $(this).find('.ig-filter');
	$($igP).toggleClass('hover-inactive');
	$($igP).toggleClass('hover-active');
	$($igFilter).toggleClass('hover-inactive');
	$($igFilter).toggleClass('hover-active');
});

//Show podcast episode description and box filter on hover
$('.pc-episode-box').hover(function(){
	$episodeContentP = $(this).find('.pc-episode-content p');
	$episodeContentFilter = $(this).find('.pc-episode-content-filter');
	$($episodeContentP).toggleClass('hover-inactive');
	$($episodeContentP).toggleClass('hover-active');
	$($episodeContentFilter).toggleClass('hover-inactive');
	$($episodeContentFilter).toggleClass('hover-active');
});

//Standardize widget box height
setTimeout(function() {
$height = $('#twitter-widget').css('height');
$('#calendar-widget').css('height', $height);
}, 3000);


//Initialize slideshow
makeBSS('.slideshow-photos');

//Submit form through AJAX and display success or fail message
$form = $('#ajax-contact');
$formMessages = $("#form-messages");

$($form).submit(function(e){
	e.preventDefault();
	$formData = $($form).serialize();
	$.ajax({
		type: 'POST',
		url: $($form).attr('action'),
		data: $formData
	})
	.done(function(response){
		$($formMessages).removeClass('error');
		$($formMessages).addClass('success');
		$($formMessages).text(response);
		$('#contactinfo').val('');
	})
	.fail(function(data){
		$($formMessages).removeClass('success');
		$($formMessages).addClass('error');
		if (data.responseText !== '') {
			$($formMessages).text(data.responseText);
		} else {
			$($formMessages).text('Oops! An error occured and your message could not be sent.');
		}
	});
});

//play videos

$("a.fp-video").click(function() {
	$.fancybox({
			'padding'		: 0,
			'autoScale'		: false,
			'transitionIn'	: 'none',
			'transitionOut'	: 'none',
			'title'			: this.title,
			'width'			: 680,
			'height'		: 495,
			'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
			'type'			: 'swf',
			'swf'			: {
			   	 'wmode'		: 'transparent',
				'allowfullscreen'	: 'true'
			}
		});

	return false;
});

});




jQuery(document).ready(function($){

//Show episode description and box filter on hover
$('.pc-episode-box').hover(function(){
	$episodeContentP = $(this).find('.pc-episode-content p');
	$episodeContentFilter = $(this).find('.pc-episode-content-filter');
	$($episodeContentP).toggleClass('hover-inactive');
	$($episodeContentP).toggleClass('hover-active');
	$($episodeContentFilter).toggleClass('hover-inactive');
	$($episodeContentFilter).toggleClass('hover-active');
});

//Load episode audio file into player on box click
$('.pc-episode-box').click(function(){
	$('.pc-player-wrapper').addClass('pc-player-hidden');
	$audioSource = $(this).find('span').html();
	$('.pc-player audio source').attr('src', $audioSource);
	$('.pc-player audio').load();
	$episodeNum = $(this).find('.pc-episode-footer h2').html();
	$('#audio-episode-number').html($episodeNum + ":");
	$episodeTitle = $(this).find('.pc-episode-content h2').html();
	$('#audio-episode-title').html($episodeTitle);
});

//Load featured episode audio file into player on play button click
$('#featured-play').click(function(){
	$('.pc-player-wrapper').addClass('pc-player-hidden');
	$audioSource = $('#featured-audio').html();
	$('.pc-player audio source').attr('src', $audioSource);
	$('.pc-player audio').load();
	$episodeNum = $('#featured-number').html();
	$('#audio-episode-number').html("EPISODE " + $episodeNum + ":");
	$episodeTitle = $('#featured-title').html();
	$('#audio-episode-title').html($episodeTitle);
});

//Transition staff background image and display name/bio on hover
$('.pc-staff-box').hover(
	function(){
		$staffBg = $(this).css('background-image');
		$staffBg = $(this).find('.staff-c').html();
		$(this).css('background-image', 'url(' + $staffBg + ')');
		$staffName = $(this).find('h2');
		$staffText = $(this).find('p');
		$($staffName).removeClass('hover-inactive');
		$($staffName).addClass('hover-active');
		$($staffText).removeClass('hover-inactive');
		$($staffText).addClass('hover-active');
	},
	function(){
		$staffBg = $(this).css('background-image');
		$staffBg = $(this).find('.staff-d').html();
		$(this).css('background-image', 'url(' + $staffBg + ')');
		$staffName = $(this).find('h2');
		$staffText = $(this).find('p');
		$($staffName).addClass('hover-inactive');
		$($staffName).removeClass('hover-active');
		$($staffText).addClass('hover-inactive');
		$($staffText).removeClass('hover-active');
	}
);

//Set download button href to loaded audio file
$('#audio-download').click(function(e){
	$('#audio-download-link').attr('href', $audioSource);
});

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
		$('#yourname').val('');
		$('#inquiry').val('');
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

//Close audio player and kill audio on close button click
$('#audio-close-player').click(function(){
	$('.pc-player-wrapper').removeClass('pc-player-hidden');
	$('.pc-player audio').trigger('pause');
});

});
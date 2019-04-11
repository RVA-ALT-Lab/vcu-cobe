jQuery(document).ready(function(){

	jQuery('.course-cat').click(function(){
		$val = $(this).text();
		$val = $val.toLowerCase();
		$val = $val.replace(/ /g, '');
		$val = '.' + $val;
		console.log($val);
		if ($('.course-box').hasClass('visible')) {
			$('.course-box').addClass('invisible').removeClass('visible bounceIn');
			$($val).removeClass('invisible').addClass('visible bounceIn');
		} else {
			jQuery($val).removeClass('invisible').addClass('visible bounceIn');
		}
	});

	$('.course-box').click(function(){
		window.open($(this).find('a.course-link').attr('href'), '_blank');
	});



});


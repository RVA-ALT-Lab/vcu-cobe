jQuery(document).ready(function($){

$('.resource-cat').click(function(){
	$val = $(this).text();
	$valText = $val;
	$val = $val.toLowerCase();
	$val = $val.replace(/ /g, '');
	$val = $val.replace(/[()]/g, '');
	$val = '.' + $val;
	$('#resource-selected h2').addClass('transparent');
	window.setTimeout(function(){
      $('#resource-selected h2').html($valText);
      $('#resource-selected h2').removeClass('transparent');
    }, 500);
	if ($('.new-resource').hasClass('visible')) {
		$('.new-resource').addClass('invisible').removeClass('visible fadeIn');
		$($val).removeClass('invisible').addClass('visible fadeIn');
	} else {
		$($val).removeClass('invisible').addClass('visible fadeIn');
	}
});

$('.resource-name').click(function(){
	$(this).find('.arrow').toggleClass('rotate');
	$resourceID = $(this).attr('id');
	$resourceID = $resourceID.replace(/ /g, '');
	$contentID = '#content-' + $resourceID;
	$($contentID).toggleClass('visible-slide');
});

$('#resource-selected h2').html('Emergency');
$('.emergency').addClass('visible fadeIn');

});
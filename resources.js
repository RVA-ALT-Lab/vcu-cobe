$(document).ready(function(){

$resource_data = $('.dummy-holder').html();
$resource_data = JSON.parse($resource_data);
for (i=0; i < $resource_data.length; i++) {
	$resource_html = '<div class="new-resource">';
	$resource_html += '<div class="resource-name ' + $resource_data[i].level + '" id="' + $resource_data[i].titleID + '">';
	$resource_html += '<h3>' + $resource_data[i].title + '</h3>';
	$resource_html += '<span class="arrow">&#8635;</span></div>';
	$resource_html += '<div class="resource-content" id="content-' + $resource_data[i].titleID + '">';
	$resource_html += '<p><a href="' + $resource_data[i].url + '" target="_blank">' + $resource_data[i].url + '</a></p>';
	$resource_html += '<p>' + $resource_data[i].phone + '</p>';
	$resource_html += '<p>' + $resource_data[i].desc + '</p>';
	$resource_html += '</div></div>';

	$resource_group = '#' + $resource_data[i].category;

	$($resource_group).append($resource_html);
}

$('.resource-name').click(function(){
	$(this).find('.arrow').toggleClass('rotate');
	$resourceID = $(this).attr('id');
	$resourceID = $resourceID.replace(/ /g, '');
	$contentID = '#content-' + $resourceID;
	console.log($contentID);
	$($contentID).toggleClass('visible-slide');
});

});
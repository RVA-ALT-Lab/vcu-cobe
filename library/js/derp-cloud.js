jQuery(document).ready(function($){

//handles click event to go to relevant link for each box
$('.course-box').click(function(){
	window.open($(this).find('a.course-link').attr('href'), '_blank');
});

//build html for cloud - sometimes the dumbest way is the only one that works...
$cloudHtml = '<span class="cloudWord" style="font-size: 48px; left: 43%; top: 1%;">stress</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 36px; left: 40%; top: 10%;">fitness</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 18px; left: 33%; top: 18%;">trauma</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 20px; left: 35%; top: 13%;">pets</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 22px; left: 53%; top: 13%;">social media</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 18px; left: 40%; top: 19%;">public relations</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 22px; left: 53%; top: 19%;">health communication</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 28px; left: 25%; top: 22%;">mindfulness</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 23px; left: 41%; top: 24%;">consciousness</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 19px; left: 56%; top: 25%;">interpersonal violence</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 24px; left: 54%; top: 30%;">self-concept</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 22px; left: 69%; top: 31%;">spirituality</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 48px; left: 22%; top: 28%;">substance use</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 32px; left: 18%; top: 38%;">risk reduction</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 20px; left: 39%; top: 40%;">child health psychology</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 19px; left: 53%; top: 35%;">internalizing disorders</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 30px; left: 73%; top: 35%;">bias</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 24px; left: 17%; top: 44%;">social inequality</span>';
$cloudHtml += '<span id="init" class="cloudWord" style="font-size: 48px; left: 35%; top: 44%;">addiction</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 21px; left: 61%; top: 40%;">bereavement</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 34px; left: 55%; top: 44%;">sexual health</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 18px; left: 73%; top: 41%;">asthma</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 22px; left: 18%; top: 50%;">eating disorders</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 20px; left: 19%; top: 56%;">coping</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 42px; left: 25%; top: 53%;">personality</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 28px; left: 20%; top: 61%;">nutrition</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 20px; left: 32%; top: 62%;">social networks</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 20px; left: 47%; top: 55%;">body image</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 22px; left: 55%; top: 51%;">depression</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 44px; left: 57%; top: 54%;">impulsivity</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 20px; left: 66%; top: 51%;">weight management</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 24px; left: 76%; top: 46%;">work</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 22px; left: 48%; top: 60%;">obesity</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 22px; left: 22%; top: 66%;">social work</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 26px; left: 34%; top: 66%;">pharmacology</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 20px; left: 55%; top: 63%;">aggression</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 22px; left: 65%; top: 63%;">anthropology</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 24px; left: 50%; top: 65%;">ADHD</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 24px; left: 28%; top: 71%;">evolution</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 32px; left: 39%; top: 71%;">social interaction</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 22px; left: 56%; top: 67%;">emotion</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 22px; left: 64%; top: 67%;">forgiveness</span>';
$cloudHtml += '<span class="cloudWord" style="font-size: 23px; left: 65%; top: 71%;">PTSD</span>';

//set html of main large cloud
$('#cloud-wrapper').html($cloudHtml);

//set up constructor to scale text for different cloud sizes
function cloudSizeHtml(wrapperName, fontScale, vShift) {
	this.wrapperName = wrapperName;
	this.fontScale = fontScale;
	this.vShift = vShift;
}

//scale text size & vertical shift of each cloud
cloudSizeHtml.prototype.fillCloudHtml = function() {
	var thisCloudHtml = $($cloudHtml).toArray();
	for (i=0;i<thisCloudHtml.length;i++) {
		$thisFont = thisCloudHtml[i].style.fontSize;
		$thisFont = $thisFont.replace(/px/g, '');
		$thisFont = $thisFont * this.fontScale;
		thisCloudHtml[i].style.fontSize = $thisFont + "px";
		$vShift = thisCloudHtml[i].style.top;
		$vShift = $vShift.replace(/%/g, '');
		$vShift = parseInt($vShift);
		$vShift = $vShift * this.vShift;
		thisCloudHtml[i].style.top = $vShift + "%";
		$(thisCloudHtml[i]).removeClass('cloudWord');
		$(thisCloudHtml[i]).addClass(this.wrapperName);
	}
	$('#cloud-wrapper-' + this.wrapperName).html(thisCloudHtml);
}

//set html of each cloud container to the proper size
function setHtml() {
	var fiveHtml = new cloudSizeHtml('five', 0.9, 1);
	var fourHtml = new cloudSizeHtml('four', 0.70, 0.9);
	var threeHtml = new cloudSizeHtml('three', 0.60, 0.95);
	var twoHtml = new cloudSizeHtml('two', 0.40, 0.9);
	var oneHtml = new cloudSizeHtml('one', 0.28, 0.8);
	//var medHtml = new cloudSizeHtml('med', 0.69, 1);
	//var smallHtml = new cloudSizeHtml('small', 0.42, 0.87);
	//var xsHtml = new cloudSizeHtml('xs', 0.30, 0.80);
	fiveHtml.fillCloudHtml();
	fourHtml.fillCloudHtml();
	threeHtml.fillCloudHtml();
	twoHtml.fillCloudHtml();
	oneHtml.fillCloudHtml();
}

setHtml();

//start drawing clouds after html for each has been set
drawClouds();

//event handler for showing relevant boxes when words are clicked
function boxToggle() {
	//get color of word clicked to set color of label
	$textColor = $(this).css('color');
	//hide all boxes currently showing
	$('.course-box').addClass('invisible').removeClass('visible');
	//hide label
	$('#course-select h2').addClass('transparent');
	//get value of word clicked
	$val = $(this).html();
	//set color to color of word clicked
	$('#course-select h2').css('color', $textColor);
	//save text value to set label
	$valText = $val;
	//set label after delay with fade in/out
	window.setTimeout(function(){
      $('#course-select h2').html($valText);
      $('#course-select h2').removeClass('transparent');
    }, 500);
    //turn value of clicked into class
	$val = $val.toLowerCase();
	$val = $val.replace(/ /g, '');
	$val = '.' + $val;
	//hide/show relevant boxes based on class, with delay to match label display
	window.setTimeout(function(){
		if ($('.course-box').hasClass('visible')) {
			$('.course-box').addClass('invisible').removeClass('visible bounceIn');
			$($val).removeClass('invisible').addClass('visible bounceIn');
		} else {
			$($val).removeClass('invisible').addClass('visible bounceIn');
		}
	}, 500);
}

//bind words in all clouds to event handler
$('.cloudWord, .five, .four, .three, .two, .one').click(boxToggle);

});

//vcu extra colors from brand guide
//var colors = ['#E57200', '#C4D600', '#6BCABA', '#69B3E7', '#768692','#006341'];
var colors = ['tomato', 'steelblue', 'seagreen', 'darkorchid', 'midnightblue', 'darkorange', 'darkkhaki']

//simple rng
function getRandomNumber(min, max) {
	return Math.floor(Math.random() * (max - min) + min);
}

//create a new object for each cloud size
function Cloud(size) {
	this.size = size;
}

//render clouds
Cloud.prototype.colorCloud = function() {
	//create array of all the words in each cloud size
	var cloudWords = $('span.' + this.size).toArray();
	//randomize color of each word every time cloud is drawn
	for (i=0; i<cloudWords.length;i++) {
		cloudWords[i].style.color = colors[getRandomNumber(0, colors.length)];
	}
	//make words visible with bounce in animation one at a time
	for (i=0; i<cloudWords.length; i++){
		(function(i){
			setTimeout(function(){
				cloudWords[i].style.display = "block";
				cloudWords[i].className = "cloudWord animated bounceIn";
			}, i * 100);
		})(i);
	}
	//remove cloud size setup classes and restore generic cloudWord class
	for (i=0; i<cloudWords.length; i++){
		(function(i){
			setTimeout(function(){
				cloudWords[i].className = "cloudWord";
			}, 5000);
		})(i);
	}
}

//each cloud size
var sixCloud = new Cloud('cloudWord');
var fiveCloud = new Cloud('five');
var fourCloud = new Cloud('four');
var threeCloud = new Cloud('three');
var twoCloud = new Cloud('two');
var oneCloud = new Cloud('one');
//var bigCloud = new Cloud('cloudWord');
//var medCloud = new Cloud('med');
//var smallCloud = new Cloud('small');
//var xsCloud = new Cloud('xs');

//draw all of the clouds - this way worked better than looping over an array of sizes, for whatever reason
function drawClouds() {
	sixCloud.colorCloud();
	fiveCloud.colorCloud();
	fourCloud.colorCloud();
	threeCloud.colorCloud();
	twoCloud.colorCloud();
	oneCloud.colorCloud();
	//bigCloud.colorCloud();
	//medCloud.colorCloud();
	//smallCloud.colorCloud();
	//xsCloud.colorCloud();
}

setTimeout(function(){
	$('#course-select h2').removeClass('transparent');
	$('#course-select h2').html('Addiction');
	var initColor = $('#init').css('color');
	$('#course-select h2').css('color', initColor);
	$('.addiction').addClass('visible');
}, 300 );


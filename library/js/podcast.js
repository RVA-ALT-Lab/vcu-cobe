jQuery(document).ready(function($){

//Include the Soundcloud Widget API here for convenience
var SC=SC||{};SC.Widget=function(n){function t(r){if(e[r])return e[r].exports;var o=e[r]={exports:{},id:r,loaded:!1};return n[r].call(o.exports,o,o.exports,t),o.loaded=!0,o.exports}var e={};return t.m=n,t.c=e,t.p="",t(0)}([function(n,t,e){function r(n){return!!(""===n||n&&n.charCodeAt&&n.substr)}function o(n){return!!(n&&n.constructor&&n.call&&n.apply)}function i(n){return!(!n||1!==n.nodeType||"IFRAME"!==n.nodeName.toUpperCase())}function a(n){var t,e=!1;for(t in b)if(b.hasOwnProperty(t)&&b[t]===n){e=!0;break}return e}function s(n){var t,e,r;for(t=0,e=I.length;t<e&&(r=n(I[t]),r!==!1);t++);}function u(n){var t,e,r,o="";for("//"===n.substr(0,2)&&(n=window.location.protocol+n),r=n.split("/"),t=0,e=r.length;t<e&&t<3;t++)o+=r[t],t<2&&(o+="/");return o}function c(n){return n.contentWindow?n.contentWindow:n.contentDocument&&"parentWindow"in n.contentDocument?n.contentDocument.parentWindow:null}function l(n){var t,e=[];for(t in n)n.hasOwnProperty(t)&&e.push(n[t]);return e}function d(n,t,e){e.callbacks[n]=e.callbacks[n]||[],e.callbacks[n].push(t)}function E(n,t){var e,r=!0;return t.callbacks[n]=[],s(function(t){if(e=t.callbacks[n]||[],e.length)return r=!1,!1}),r}function f(n,t,e){var r,o,i=c(e);return!!i.postMessage&&(r=e.getAttribute("src").split("?")[0],o=JSON.stringify({method:n,value:t}),"//"===r.substr(0,2)&&(r=window.location.protocol+r),r=r.replace(/http:\/\/(w|wt).soundcloud.com/,"https://$1.soundcloud.com"),void i.postMessage(o,r))}function p(n){var t;return s(function(e){if(e.instance===n)return t=e,!1}),t}function h(n){var t;return s(function(e){if(c(e.element)===n)return t=e,!1}),t}function v(n,t){return function(e){var r=o(e),i=p(this),a=!r&&t?e:null,s=r&&!t?e:null;return s&&d(n,s,i),f(n,a,i.element),this}}function S(n,t,e){var r,o,i;for(r=0,o=t.length;r<o;r++)i=t[r],n[i]=v(i,e)}function R(n,t,e){return n+"?url="+t+"&"+g(e)}function g(n){var t,e,r=[];for(t in n)n.hasOwnProperty(t)&&(e=n[t],r.push(t+"="+("start_track"===t?parseInt(e,10):e?"true":"false")));return r.join("&")}function m(n,t,e){var r,o,i=n.callbacks[t]||[];for(r=0,o=i.length;r<o;r++)i[r].apply(n.instance,e);(a(t)||t===L.READY)&&(n.callbacks[t]=[])}function w(n){var t,e,r,o,i;try{e=JSON.parse(n.data)}catch(a){return!1}return t=h(n.source),r=e.method,o=e.value,(!t||A(n.origin)===A(t.domain))&&(t?(r===L.READY&&(t.isReady=!0,m(t,C),E(C,t)),r!==L.PLAY||t.playEventFired||(t.playEventFired=!0),r!==L.PLAY_PROGRESS||t.playEventFired||(t.playEventFired=!0,m(t,L.PLAY,[o])),i=[],void 0!==o&&i.push(o),void m(t,r,i)):(r===L.READY&&T.push(n.source),!1))}function A(n){return n.replace(Y,"")}var _,y,O,D=e(1),b=e(2),P=e(3),L=D.api,N=D.bridge,T=[],I=[],C="__LATE_BINDING__",k="http://wt.soundcloud.dev:9200/",Y=/^http(?:s?)/;window.addEventListener?window.addEventListener("message",w,!1):window.attachEvent("onmessage",w),n.exports=O=function(n,t,e){if(r(n)&&(n=document.getElementById(n)),!i(n))throw new Error("SC.Widget function should be given either iframe element or a string specifying id attribute of iframe element.");t&&(e=e||{},n.src=R(k,t,e));var o,a,s=h(c(n));return s&&s.instance?s.instance:(o=T.indexOf(c(n))>-1,a=new _(n),I.push(new y(a,n,o)),a)},O.Events=L,window.SC=window.SC||{},window.SC.Widget=O,y=function(n,t,e){this.instance=n,this.element=t,this.domain=u(t.getAttribute("src")),this.isReady=!!e,this.callbacks={}},_=function(){},_.prototype={constructor:_,load:function(n,t){if(n){t=t||{};var e=this,r=p(this),o=r.element,i=o.src,a=i.substr(0,i.indexOf("?"));r.isReady=!1,r.playEventFired=!1,o.onload=function(){e.bind(L.READY,function(){var n,e=r.callbacks;for(n in e)e.hasOwnProperty(n)&&n!==L.READY&&f(N.ADD_LISTENER,n,r.element);t.callback&&t.callback()})},o.src=R(a,n,t)}},bind:function(n,t){var e=this,r=p(this);return r&&r.element&&(n===L.READY&&r.isReady?setTimeout(t,1):r.isReady?(d(n,t,r),f(N.ADD_LISTENER,n,r.element)):d(C,function(){e.bind(n,t)},r)),this},unbind:function(n){var t,e=p(this);e&&e.element&&(t=E(n,e),n!==L.READY&&t&&f(N.REMOVE_LISTENER,n,e.element))}},S(_.prototype,l(b)),S(_.prototype,l(P),!0)},function(n,t){t.api={LOAD_PROGRESS:"loadProgress",PLAY_PROGRESS:"playProgress",PLAY:"play",PAUSE:"pause",FINISH:"finish",SEEK:"seek",READY:"ready",OPEN_SHARE_PANEL:"sharePanelOpened",CLICK_DOWNLOAD:"downloadClicked",CLICK_BUY:"buyClicked",ERROR:"error"},t.bridge={REMOVE_LISTENER:"removeEventListener",ADD_LISTENER:"addEventListener"}},function(n,t){n.exports={GET_VOLUME:"getVolume",GET_DURATION:"getDuration",GET_POSITION:"getPosition",GET_SOUNDS:"getSounds",GET_CURRENT_SOUND:"getCurrentSound",GET_CURRENT_SOUND_INDEX:"getCurrentSoundIndex",IS_PAUSED:"isPaused"}},function(n,t){n.exports={PLAY:"play",PAUSE:"pause",TOGGLE:"toggle",SEEK_TO:"seekTo",SET_VOLUME:"setVolume",NEXT:"next",PREV:"prev",SKIP:"skip"}}]);

var iframeElement   = document.querySelector('iframe');
var iframeElementID = iframeElement.id;
var playerWidget         = SC.Widget(iframeElement);
var playerWidget2        = SC.Widget(iframeElementID);

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
	$src1 = 'https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/';
	$src2 = '&amp;color=ff5500&amp;auto_play=true&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false';
	$trackId = $(this).find('span').html();
	$finalSrc = $src1 + $trackId + $src2;
	$('.pc-player-wrapper').addClass('pc-player-hidden');
	$('#pc-soundcloud').attr('src', $finalSrc);
/*	$audioSource = $(this).find('span').html();
	$('.pc-player audio source').attr('src', $audioSource);
	$('.pc-player audio').load();
	$episodeNum = $(this).find('.pc-episode-footer h2').html();
	$('#audio-episode-number').html($episodeNum + ":");
	$episodeTitle = $(this).find('.pc-episode-content h2').html();
	$('#audio-episode-title').html($episodeTitle); */
});

//Load featured episode audio file into player on play button click
$('#featured-play').click(function(){
	$src1 = 'https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/';
	$src2 = '&amp;color=ff5500&amp;auto_play=true&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false';
	$trackId = $('#featured-audio').html();
	$finalSrc = $src1 + $trackId + $src2;
	$('.pc-player-wrapper').addClass('pc-player-hidden');
	$('#pc-soundcloud').attr('src', $finalSrc);
/*	$('.pc-player-wrapper').addClass('pc-player-hidden');
	$audioSource = $('#featured-audio').html();
	$('.pc-player audio source').attr('src', $audioSource);
	$('.pc-player audio').load();
	$episodeNum = $('#featured-number').html();
	$('#audio-episode-number').html("EPISODE " + $episodeNum + ":");
	$episodeTitle = $('#featured-title').html();
	$('#audio-episode-title').html($episodeTitle);*/
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
/*$('#audio-download').click(function(e){
	$('#audio-download-link').attr('href', $audioSource);
});*/

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
	playerWidget.pause();
});

});
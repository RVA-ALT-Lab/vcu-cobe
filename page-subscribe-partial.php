<?php
/**
*	Template Name: Subscribe Partial
*
*
*/

?>

<div class="frame-full" id="front-subscribe">
	<div class="frame">
	<div>
		<p>Subscribe to the COBE E-Newsletter below:</p>
		<div id="form-messages">
		</div>
		<form id="ajax-contact" method="post" action="<?php echo get_stylesheet_directory_uri(); ?>/subscribe-mailer.php">
			<input type="email" id="contactinfo" name="contactinfo"><br>
			<input type="submit" value="Subscribe" id="sub-contact-submit">
		</form>
	</div>
	</div>
</div>
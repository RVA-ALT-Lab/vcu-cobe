<?php /* Template Name: Mindfulness Study */ ?>

<?php get_header(); ?>

	<style type="text/css">
		#ninja_forms_form_10_cont {
			display: none; 
		}
	</style>

			<div id="content">

				<div id="inner-content" class="frame">

						<main id="main" class="bit-1" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
									<!--
									<p class="byline vcard">
										<?php printf( __( 'Posted', 'bonestheme').' <time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time> '.__( 'by',  'bonestheme').' <span class="author">%3$s</span>', get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
									</p>-->

								</header> <?php // end article header ?>

								<section class="entry-content" itemprop="articleBody">
									<?php
										// the content (pretty self explanatory huh)
										
									if(is_user_logged_in()){
										$current_user = wp_get_current_user(); 

										echo '<h2>Hello, '. $current_user->user_nicename .'</h2>'; 

										the_content();
									} else {
										echo '<p>You will need to login to access this content.</p>'; 

										$args = array(
										        'echo' => true,
										        'redirect' => site_url( $_SERVER['REQUEST_URI'] ), 
										        'form_id' => 'loginform',
										        'label_username' => __( 'Username' ),
										        'label_password' => __( 'Password' ),
										        'label_remember' => __( 'Remember Me' ),
										        'label_log_in' => __( 'Log In' ),
										        'id_username' => 'user_login',
										        'id_password' => 'user_pass',
										        'id_remember' => 'rememberme',
										        'id_submit' => 'wp-submit',
										        'remember' => true,
										        'value_username' => NULL,
										        'value_remember' => false );

										wp_login_form( $args );
									}

										/*
										 * Link Pages is used in case you have posts that are set to break into
										 * multiple pages. You can remove this if you don't plan on doing that.
										 *
										 * Also, breaking content up into multiple pages is a horrible experience,
										 * so don't do it. While there are SOME edge cases where this is useful, it's
										 * mostly used for people to get more ad views. It's up to you but if you want
										 * to do it, you're wrong and I hate you. (Ok, I still love you but just not as much)
										 *
										 * http://gizmodo.com/5841121/google-wants-to-help-you-avoid-stupid-annoying-multiple-page-articles
										 *
										*/
									?>
								</section> <?php // end article section ?>

								<footer class="article-footer cf">

								<script type="text/javascript">
										

										var currentUser = <?php echo json_encode($current_user->user_email); ?>; 

										document.addEventListener('DOMContentLoaded', function(){

											var timestampInput = document.querySelector('#ninja_forms_field_11'); 
											var usernameInput = document.querySelector('#ninja_forms_field_8'); 
											var audioInput = document.querySelector('#ninja_forms_field_10'); 
											var submitButton = document.querySelector('#ninja_forms_field_9'); 


											function submitNinjaForm(timestamp, username, audioFile){

												timestampInput.value = timestamp; 
												usernameInput.value = username; 
												audioInput.value = audioFile; 

												submitButton.click(); 

												timestampInput.value = ""; 
												usernameInput.value = ""; 
												audioInput.value = "";

											}



											var audioElements = document.querySelectorAll('audio'); 

											for (var i = 0; i < audioElements.length; i++){

												audioElements[i].addEventListener('play', function(event){
													var audioFile = event.currentTarget.src; 
													var timestamp = new Date(Date.now()).toDateString(); 
													

													submitNinjaForm(timestamp, currentUser, audioFile); 


												})

											}



										}); 


								</script>

								</footer>

							</article>

							<?php endwhile; endif; ?>

						</main>

						<?php //get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>

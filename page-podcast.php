<?php
/**
*	Template Name: Podcast
*
*
*/

?>

<?php get_header(); ?>
	
	<div class="frame-full podcast-wrap" id="main-content">
	<!--<div class="full pc-header">
		<div class="frame">
				<div class="bit-1">
					<h1><?php echo get_the_title( $post->ID ); ?></h1>
					<?php
						if ( have_posts() ) : while ( have_posts() ) : the_post();
							$header_text = get_post_meta($post->ID, 'header_text', true);
							echo '<p>' . $header_text . '</p>';
							endwhile; else :
								_e( 'No content here' );
						endif;
					?>
				</div>
		</div>
	</div>-->

	<div class="full pc-about">
		<div class="frame">
				<div class="bit-2 pc-logo">
					<img src="http://cobe.vcu.edu/wp-content/uploads/2016/03/PodcastLogo.png">
				</div>
				<div class="bit-2">
					<?php
						if ( have_posts() ) : while ( have_posts() ) : the_post();
							$about_text = get_post_meta($post->ID, 'about_text', true);
							echo '<p>' . $about_text . '</p>';
							endwhile; else :
								_e( 'No content here' );
						endif;
					?>
				</div>
		</div>
	</div>

	<div class="full pc-episodes">
		<div class="frame">
			<?php
				$count = 0;
				$args = array( 'post_type' => 'cobe_episodes', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'DSC' );
				$episodes_loop = new WP_query( $args );
				while ( $episodes_loop->have_posts() ) : $episodes_loop->the_post();
					/*if ($count % 3 == 0 and count !== 0 ) {
						echo '</div><div class="row">';
					} */
					$number = get_post_meta($post->ID, "_number", true);
					$title = get_post_meta($post->ID, "_title", true);
					$title = strtoupper($title);
					$desc = get_post_meta($post->ID, "_desc", true);
					$url = get_post_meta($post->ID, "_url", true);
					$bgImgUrl = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
					echo '<div class="bit-3 pc-episode-box" id="episode-' . $number . '" style="background-image: url(' . $bgImgUrl . ')">';
					echo '<div class="pc-episode-content">';
					echo '<div class="pc-episode-content-filter hover-inactive"></div>';
					echo '<p class="hover-inactive">' . $desc . '</p>';
					echo '<h2>' . $title . '</h2></div>';
					echo '<span class="hover-inactive">' . $url . '</span>';
					echo '<div class="pc-episode-footer"><h2>EPISODE ' . $number . '</h2></div></div>';
					$count++;
				endwhile;
			?>
		</div>
	</div>

	<!--
	<div class="full pc-staff">
		<div class="frame">
				<div class="bit-1">
					<h1>STAFF</h1>
				</div>
				<?php
					if ( have_posts() ) : while ( have_posts() ) : the_post();
						$staff_one_name = get_post_meta($post->ID, 'staff_one_name', true);
						$staff_one_text = get_post_meta($post->ID, 'staff_one_text', true);
						$staff_one_c = get_post_meta($post->ID, 'staff_one_c', true);
						$staff_one_d = get_post_meta($post->ID, 'staff_one_d', true);
						$staff_two_name = get_post_meta($post->ID, 'staff_two_name', true);
						$staff_two_text = get_post_meta($post->ID, 'staff_two_text', true);
						$staff_two_c = get_post_meta($post->ID, 'staff_two_c', true);
						$staff_two_d = get_post_meta($post->ID, 'staff_two_d', true);
						$staff_three_name = get_post_meta($post->ID, 'staff_three_name', true);
						$staff_three_text = get_post_meta($post->ID, 'staff_three_text', true);
						$staff_three_c = get_post_meta($post->ID, 'staff_three_c', true);
						$staff_three_d = get_post_meta($post->ID, 'staff_three_d', true);
						$staff_four_name = get_post_meta($post->ID, 'staff_four_name', true);
						$staff_four_text = get_post_meta($post->ID, 'staff_four_text', true);
						$staff_four_c = get_post_meta($post->ID, 'staff_four_c', true);
						$staff_four_d = get_post_meta($post->ID, 'staff_four_d', true);
						endwhile; else :
							_e( 'No content here' );
					endif;
				?>
				<div class="bit-2 offset-24">
					<div class="pc-staff-box pc-staff-box-lg" id="staff-1" style="background-image: url(<?php echo $staff_one_d ?>);">
					<span class="staff-d"><?php echo $staff_one_d ?></span>
					<span class="staff-c"><?php echo $staff_one_c ?></span>
					<h2 class="hover-inactive"><?php echo $staff_one_name ?></h2>
					<p class="hover-inactive"><?php echo $staff_one_text ?></p>
					</div>
					<div class="pc-staff-box pc-staff-box-sm" id="staff-3" style="background-image: url(<?php echo $staff_three_d ?>);">
					<span class="staff-d"><?php echo $staff_three_d ?></span>
					<span class="staff-c"><?php echo $staff_three_c ?></span>
					<h2 class="hover-inactive"><?php echo $staff_three_name ?></h2>
					<p class="hover-inactive"><?php echo $staff_three_text ?></p>
					</div>
				</div>
				<div class="bit-3 offset-24">
					<div class="pc-staff-box pc-staff-box-sm" id="staff-2" style="background-image: url(<?php echo $staff_two_d ?>);">
					<span class="staff-d"><?php echo $staff_two_d ?></span>
					<span class="staff-c"><?php echo $staff_two_c ?></span>
					<h2 class="hover-inactive"><?php echo $staff_two_name ?></h2>
					<p class="hover-inactive"><?php echo $staff_two_text ?></p>
					</div>
					<div class="pc-staff-box pc-staff-box-lg" id="staff-4" style="background-image: url(<?php echo $staff_four_d ?>);">
					<span class="staff-d"><?php echo $staff_four_d ?></span>
					<span class="staff-c"><?php echo $staff_four_c ?></span>
					<h2 class="hover-inactive"><?php echo $staff_four_name ?></h2>
					<p class="hover-inactive"><?php echo $staff_four_text ?></p>
					</div>
				</div>
		</div>
	</div>

	<div class="full pc-music">
		<div class="frame">
				<div class="bit-1">
					<h1>MUSIC</h1>
					<?php
						if ( have_posts() ) : while ( have_posts() ) : the_post();
							$music_text = get_post_meta($post->ID, 'music_text', true);
							echo '<p>' . $music_text . '</p>';
							endwhile; else :
								_e( 'No content here' );
						endif;

						$args = array( 'post_type' => 'cobe_musicians', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'ASC' );
						$musicians_loop = new WP_query( $args );
						while ( $musicians_loop->have_posts() ) : $musicians_loop->the_post();
							$name = get_the_title($post->ID);
							$name = strtoupper($name);
							$desc = get_post_meta($post->ID, "_desc", true);
							$url = get_post_meta($post->ID, "_url", true);
							$bgImgUrl = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
							echo '<a href="' . $url . '" target="_blank">';
							echo '<div class="flip-container">';
							echo '<div class="pc-musician-flipper">';
							echo '<div class="front" style="background-image: url(' . $bgImgUrl . ')"></div>';
							echo '<div class="back"><h1>' . $name . '</h1><p>' . $desc . '</p></div></div></div></a>';
						endwhile;
					?>
				</div>
		</div>
	</div>

	<div class="full" id="pc-contact">
		<div class="frame">
				<div class="bit-1">
				<h1>CONTACT</h1>
				<?php
					if ( have_posts() ) : while ( have_posts() ) : the_post();
						$contact_text = get_post_meta($post->ID, 'contact_text', true);
						echo '<p>' . $contact_text . '</p>';
						endwhile; else :
							_e( 'No content here' );
					endif;
				?>
				<div id="form-messages">
				</div>
				</div>
				<div class="bit-7">
				<span></span>
				</div>
				<div class="bit-75">
					<form id="ajax-contact" method="post" action="<?php echo get_stylesheet_directory_uri(); ?>/mailer.php">
						<span>Your Name:</span><br>
						<input type="text" id="yourname" name="yourname" required><br>
						<span>Your Inquiry:</span><br>
						<textarea rows="10" id="inquiry" name="inquiry" required></textarea><br>
						<span>Email Address:</span><br>
						<input type="email" id="contactinfo" name="contactinfo"><br>
						<input type="submit" value="Submit" id="pc-contact-submit">
					</form>
				</div>
				<div class="bit-7">
				<span></span>
				</div>
		</div>
	</div>-->

	<div class="full pc-player-wrapper">
	<div class="pc-player">
		<div class="frame">
				<div class="bit-1">
				<iframe id="pc-soundcloud" width="100%" height="166" scrolling="no" frameborder="no" src=""></iframe>
					<!--<audio controls autoplay>
						<source src="" type="audio/mpeg">
					</audio>
					<h3 id="audio-episode-number"></h3>
					<h3 id="audio-episode-title"></h3>
					<a href="" id="audio-download-link" download><button class="pc-player-button" id="audio-download">&darr;</button></a>-->
					<button class="pc-player-button" id="audio-close-player">STOP</button>
				</div>
		</div>
	</div>
	</div>
	</div>



<?php get_footer(); ?>
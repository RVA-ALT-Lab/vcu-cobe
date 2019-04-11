<?php
/**
*	Template Name: About Partial
*
*
*/

?>

<div class="frame-full" id="front-about">
	<div class="frame">
	<div class="bit-1">
		<!-- <h1>What is COBE?</h1>
		<p>The College Behavioral and Emotional Health Institute integrates research, coursework, creative media and programming to promote health and wellness at VCU.</p> -->
		<div id="about-media">
			<div class="bit-75">
			<div class="bss-slides slideshow-photos" tabindex="1" id="about-photos">
			<?php
				$args = array( 'post_type' => 'cobe_fpslides', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'ASC' );
				$slides_loop = new WP_query( $args );
				$count = 0;
				while ( $slides_loop->have_posts() ) : $slides_loop->the_post();
					$imgUrl = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
					$imgId = get_post( get_post_thumbnail_id() );
					$alt_text = get_post_meta($imgId->ID, '_wp_attachment_image_alt', true);
					$caption = get_post_meta($post->ID, "_caption", true);
					$url = get_post_meta($post->ID, "_url", true);
					echo '<figure id="figure-' . $count . '">';
					echo '<a href="' . $url . '">';
					echo '<img src="' . $imgUrl . '" alt="' . $alt_text . '"/>';
					echo '<figcaption><h3>' . $caption . '</h3></figcaption>';
					echo '</a>';
					echo '</figure>';
					$count++;
				endwhile;
			?>
			</div>
			<div class="slides-bar">

			</div>
			</div>
			<div class="bit-25" id="about-videos">
			<?php
				$args = array( 'post_type' => 'cobe_fpvideos', 'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'ASC' );
				$videos_loop = new WP_query( $args );
				while ( $videos_loop->have_posts() ) : $videos_loop->the_post();
					$imgUrl = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
					$imgId = get_post( get_post_thumbnail_id() );
					$alt_text = get_post_meta($imgId->ID, '_wp_attachment_image_alt', true);
					$url = get_post_meta($post->ID, "_url", true);
					echo '<a href="' . $url . '" class="fp-video">';
					echo '<img src="' . $imgUrl . '" alt="' . $alt_text . '"/>';
					echo '<p>' . get_the_title() . '</p>';
					echo '</a>';
				endwhile;
			?>
			</div>
		</div>
	</div>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/podcast.css" media="screen" />

<div class="container">
	<div class="row">
		<div class="column column-6">
			<?php
				$args = array( 'post_type' => 'cw_episodes', 'tax_query' => array(array('taxonomy' => 'cw_episode_featured', 'field' => 'slug', 'terms' => array('featured'))), 'posts_per_page' => 1 );
					$featured_episode_loop = new WP_query( $args );
					while ( $featured_episode_loop->have_posts() ) : $featured_episode_loop->the_post();
						$number = get_post_meta($post->ID, "_number", true);
						$title = get_post_meta($post->ID, "_title", true);
						$title = strtoupper($title);
						$desc = get_post_meta($post->ID, "_desc", true);
						$url = get_post_meta($post->ID, "_url", true);
						$bgImgUrl = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
						echo '<div class="column column-4 pc-episode-box" id="episode-' . $number . '" style="background-image: url(' . $bgImgUrl . ')">';
						echo '<div class="pc-episode-content">';
						echo '<div class="pc-episode-content-filter hover-inactive"></div>';
						echo '<h2>' . $title . '</h2>';
						echo '<p class="hover-inactive">' . $desc . '</p></div>';
						echo '<span class="hover-inactive">' . $url . '</span>';
						echo '<div class="pc-episode-footer"><h2>EPISODE ' . $number . '</h2></div></div>';
				endwhile;
			?>
		</div>
		<div class="column column-6">
		</div>
	</div>
</div>
	
</html>
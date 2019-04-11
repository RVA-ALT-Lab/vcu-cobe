<?php
/*
 Template Name: Front Page
 *
 * Our home page template.  We have a few pieces: header navigation, full-width banner, tagline, social widgets, center navigation area, calendar widget, news feed, featured podcast widget.
 * Includes the media area and subscribe form as partial pulls
*/
?>

<?php get_header(); ?>
		
	<div id="widget-area">
	<div id="header-widgets" class="frame-full">
		<div class="frame">
		<div id="top-story">
		<h2>TOP STORY</h2>
		<?php
			$args = array( 'post_type' => 'post', 'posts_per_page' => 1, 'orderby' => 'date', 'order' => 'DSC' );
			$posts_loop = new WP_query( $args );
			while ( $posts_loop->have_posts() ) : $posts_loop->the_post();
				$title = get_the_title();
				$url = get_permalink();
				echo '<a href="' . $url . '">';
				echo '<p>' . $title . '</p></a>';
			endwhile;
		?>
		</div>
		<div id="social-connect">
			<h2>CONNECT WITH COBE</h2>
			<ul>
				<li><a href="https://www.facebook.com/vcu.cobe" target="_blank" id="link-facebook" title="Facebook" aria-label="Go to COBE's Facebook page."></a></li>
				<li><a href="https://twitter.com/vcucobe" target="_blank" id="link-twitter" title="Twitter" aria-label="Go to COBE's Twitter page."></a></li>
				<li><a href="http://instagram.com/_u/vcucobe/" target="_blank" id="link-instagram" title="Instagram" aria-label="Go to COBE's Instagram page."></a></li>
				<li><a href="https://www.youtube.com/channel/UCjf6HVjL4WJFCqGRtJJ1nhA" target="_blank" id="link-youtube" title="Youtube" aria-label="Go to COBE's YouTube page."></a></li>
			</ul>
		</div>
		</div>
	</div>
	</div>

	<?php get_template_part('page-about-partial', 'front-page-about'); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php $featuredBgImgUrl = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>
	<?php $featuredBgId = get_post( get_post_thumbnail_id() ); ?>
	<?php $alt_text = get_post_meta($featuredBgId->ID, '_wp_attachment_image_alt', true); ?>
	<?php endwhile; endif; ?>
	<div class="frame-full">
	<div id="banner" class="bit-1">
	<?php
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			$banner_url = get_post_meta($post->ID, '_url', true);
			echo '<a href="' . $banner_url . '">';
			endwhile; else :
				_e( 'No content here' );
		endif;
	?>
	<img src="<?php echo $featuredBgImgUrl ?>" alt="<?php echo $alt_text ?>">
	</a>
	</div>
	</div>

	<div class="frame">
	<div class="bit-1" id="central-nav">
	<?php
		$pages = array();
		for ($count = 1; $count <= 6; $count++) {
			$mod = get_theme_mod ('nav-box-page-' . $count);
			if ( 'page-none-selected' != $mod ) {
				$pages[] = $mod;
			}
		}

		$args = array(
			'posts_per_page' => 6,
			'post_type' => 'page',
			'post__in' => $pages,
			'orderby' => 'post__in'
		);

		$query = new WP_query( $args );

		if ( $query -> have_posts() ) :
			$count = 1;
			while ( $query -> have_posts() ) : $query -> the_post();
			$bgImgUrl = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
			$navLink = get_page_link($post->ID);
			?>
			<div class="bit-3">
				<a href="<?php echo $navLink; ?>">
					<div class="bit-1 link-box">
						<div class="box" style="background-image: url(<?php echo $bgImgUrl ?>);">
						</div>
						<div class="box-caption">
						<h3><?php the_title(); ?></h3>
						<p><?php the_excerpt(); ?></p>
						</div>
					</div>
				</a>
			</div>
		<?php 
		endwhile;
		$count++;
		endif;
	?>
		
	</div>
	<div class="bit-4 social-widgets">
	<div id="twitter-widget">
		<a class="social-sidebar twitter" href="http://twitter.com/vcucobe"><h3>Twitter</h3></a>
		<a class="twitter-timeline" href="https://twitter.com/VCUCOBE" data-tweet-limit="2" data-widget-id="657627818445139969">Tweets by @VCUCOBE</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	</div>
		<a class="social-sidebar instagram" href="http://instagram.com/_u/vcucobe/"><h3>Instagram</h3></a>
	<div id="instafeed">
	</div>
	</div>
	<div class="bit-2" id="home-news-window">
		<div class="frame">

		<div class="social-sidebar" style="background-color: black; text-align: center;">
		<h3 style="margin-left: 0;">VIDEOS</h3>
		</div>

		<div class="bit-1" id="home-news">
		<?php
			$args = array( 'post_type' => 'post', 'posts_per_page' => 4, 'orderby' => 'date', 'order' => 'DSC', 'tag' => 'video, videos' );
			$posts_loop = new WP_query( $args );
			while ( $posts_loop->have_posts() ) : $posts_loop->the_post();
				$imgUrl = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
				$thumbUrl = wp_get_attachment_thumb_url(get_post_thumbnail_id($post->ID));
				$imgId = get_post( get_post_thumbnail_id() );
				$alt_text = get_post_meta($imgId->ID, '_wp_attachment_image_alt', true);
				$title = get_the_title();
				$excerpt = get_the_excerpt();
				//$date = get_the_date();
				$url = get_permalink();
				if ($posts_loop->current_post == 0 && !is_paged() ) {
					echo '<a href="' . $url . '">';
					echo '<img src="' . $imgUrl . '" alt="' . $alt_text . '"/>';
					echo '<h2>' . $title . '</h2>';
					echo '<p>' . $excerpt . '</p><br>';
					//echo '<p>' . $date . '</p>';
					echo '</a><hr>';
				} else {
					echo '<div class="bit-3">';
					echo '<a href="' . $url . '">';
					echo '<img src="' . $thumbUrl . '" alt="' . $alt_text . '"/>';
					echo '<h6>' . $title . '</h6>';
					//echo '<p>' . $date . '</p>';
					echo '</a></div>';
				}
				
			endwhile;
		?>
		</div>
		</div>
	</div>
	<!-- GCF Calendar Script -->
	<script type="text/javascript">
	$(function() { $('#gcf-design').gCalFlow({
	  calid: 'thewellvcu@gmail.com',
	  apikey: 'AIzaSyCLy2OTkUZ8T-MesAYMSWxWkngGgDlAIc8'
	});});
	</script>
	<div class="bit-4">
	<div id="calendar-widget">
		<a class="social-sidebar events" href=""><h3>University Events</h3></a>
		<div id="gcf-design">
		</div>
	</div>
	<a class="social-sidebar podcast" href="http://cobe.vcu.edu/podcast/"><h3>Podcast</h3></a>
	<?php
		$args = array( 'post_type' => 'podcast', 'posts_per_page' => 1 );
			$featured_episode_loop = new WP_query( $args );
			while ( $featured_episode_loop->have_posts() ) : $featured_episode_loop->the_post();
				$number = get_post_meta($post->ID, "itunes_episode_number", true);
				$title = get_post_meta($post->ID, "_title", true);
				$title = strtoupper($title);
				$desc = get_post_meta($post->ID, "_desc", true);
				$url = get_permalink();
				$bgImgUrl = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
				echo '<a href="'.$url.'">';
				echo '<div class="bit-1 pc-episode-box pc-episode-box-front" id="episode-' . $number . '" style="background-image: url(' . $bgImgUrl . ')">';
				echo '<div class="pc-episode-content">';
				echo '<div class="pc-episode-content-filter pc-episode-content-filter-front hover-inactive"></div>';
				//echo '<h2>' . $title . '</h2>';
				echo '<p class="hover-inactive">' . $desc . '</p></div>';
				echo '<span class="hover-inactive">' . $url . '</span>';
				echo '<div class="pc-episode-footer"><h2>EPISODE ' . $number . '</h2></div></div>';
				echo '</a>';
		endwhile;
	?>
	</div>
	</div>

	<div class="frame" id="home-news-med">
	<div class="bit-1" id="home-news-resp">
		<?php
			$args = array( 'post_type' => 'post', 'posts_per_page' => 4, 'orderby' => 'date', 'order' => 'DSC', 'tag' => 'video, videos' );
			$posts_loop = new WP_query( $args );
			while ( $posts_loop->have_posts() ) : $posts_loop->the_post();
				$imgUrl = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
				$thumbUrl = wp_get_attachment_thumb_url(get_post_thumbnail_id($post->ID));
				$imgId = get_post( get_post_thumbnail_id() );
				$alt_text = get_post_meta($imgId->ID, '_wp_attachment_image_alt', true);
				$title = get_the_title();
				$excerpt = get_the_excerpt();
				//$date = get_the_date();
				$url = get_permalink();
				if ($posts_loop->current_post == 0 && !is_paged() ) {
					echo '<a href="' . $url . '">';
					echo '<img src="' . $imgUrl . '" alt="' . $alt_text . '"/>';
					echo '<h2>' . $title . '</h2>';
					echo '<p>' . $excerpt . '</p><br>';
					//echo '<p>' . $date . '</p>';
					echo '</a><hr>';
				} else {
					echo '<div class="bit-3">';
					echo '<a href="' . $url . '">';
					echo '<img src="' . $thumbUrl . '" alt="' . $alt_text . '"/>';
					echo '<h6>' . $title . '</h6>';
					//echo '<p>' . $date . '</p>';
					echo '</a></div>';
				}
				
			endwhile;
		?>
	</div>
	</div>

<?php /*get_template_part('page-subscribe-partial', 'front-page-subscribe');*/ ?>

<?php get_footer(); ?>
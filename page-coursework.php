<?php
/**
*	Template Name: Coursework
*
*
*/

?>

<?php get_header(); ?>

<body class="cw">

<div class="cw-container">

	<div class="head-area">
		<h1><?php echo get_the_title( $post->ID ); ?></h1>
		<?php the_post_thumbnail(); ?>
	</div>

	<div class="content-area">
		<div class="info-box">
		<?php
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				$info_first = get_post_meta($post->ID, 'info_first', true);
				$info_first = strtoupper($info_first);
				$info_second = get_post_meta($post->ID, 'info_second', true);
				$info_second = strtoupper($info_second);
				echo $info_first;
				endwhile; else :
					_e( 'No content here' );
			endif;
		?>
		</div>
		<div class="course-options">
			<?php
				$args = array('orderby'=>'asc', 'hide_empty'=>true);
				$cats = get_terms('cw_course_type', $args);
				foreach($cats as $cat) {
					echo '<div class="col-3"><button class="course-cat"><p>' . $cat->name . '</p></button></div>';
				}
			?>
		</div>
		<div class="course-area">
			<?php
				$args = array( 'post_type' => 'cw_course', 'posts_per_page' => -1 );
				$courses_loop = new WP_query( $args );
				while ( $courses_loop->have_posts() ) : $courses_loop->the_post();
					$category = strip_tags( get_the_term_list($post->ID, 'cw_course_type') );
					$category = strtolower($category);
					$category = str_replace(' ', '', $category);
					echo '<div class="course-box animated ' . $category . '">';
					echo '<a href="' . get_post_meta($post->ID, "_url", true) . '" target="_blank" class="course-link"></a>';
					echo '<h2>' . get_the_title($post->ID) . '</h2>';
					echo '<h3>' . get_post_meta($post->ID, "_name", true) . '</h3>';
					echo '<h4><a href="mailto:' . get_post_meta($post->ID, "_email", true) . '">' . get_post_meta($post->ID, "_prof", true) . '</a></h3>';
					echo '<p>' . get_post_meta($post->ID, "_desc", true) . '</p>';
					echo '</div>';
				endwhile;
			?>
		</div>

		<div class="info-box">
			<?php echo $info_second; ?>
		</div>

	</div>

</div>


<?php get_footer(); ?>
</body>

</html>
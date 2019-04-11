<?php
/**
*	Template Name: Resources Template
*
*
*/

?>

<?php get_header(); ?>

<div class="frame">
<div class="resource-container">
	<div class="head-area">
		<h1><?php echo get_the_title( $post->ID ); ?></h1>
		<?php //the_post_thumbnail(); ?>
	</div>
	<div class="content-area">
<div class="research-info-box">
			<?php
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					$info_first = get_post_meta($post->ID, 'info_first', true);
					$info_first = strtoupper($info_first);
					echo $info_first;
					endwhile; else :
						_e( 'No content here' );
				endif;
			?>
		</div>
		<div class="resource-area">
			<div class="resource-buttons">
				<?php
					$args = array('orderby'=>'asc', 'hide_empty'=>true);
					$cats = get_terms('cobe_resource_type', $args);
					foreach($cats as $cat) {
						$cat->name = str_replace('_', ' ', $cat->name);
						echo '<div class="col-3"><button class="resource-cat"><p>' . $cat->name . '</p></button></div>';
					}
				?>
			</div>
			<div id="resource-selected">
				<h2>&nbsp;</h2>
			</div>
			<div class="resource-space">
				<?php
					$args = array( 'post_type' => 'cobe_resources', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC' );
					$resources_loop = new WP_query( $args );
					while ( $resources_loop->have_posts() ) : $resources_loop->the_post();
						$category = strip_tags( get_the_term_list($post->ID, 'cobe_resource_type') );
						$category = strtolower($category);
						$category = str_replace(' ', '', $category);
						$category = str_replace('_', ' ', $category);
						$level = strip_tags( get_the_term_list($post->ID, 'cobe_resource_level') );
						$title = get_the_title($post->ID);
						$titleID = strtolower($title);
						$titleID = str_replace(' ', '', $titleID);
						$titleID = str_replace(',', '', $titleID);
						$titleID = str_replace('(', '', $titleID);
						$titleID = str_replace(')', '', $titleID);
						$url = get_post_meta($post->ID, "_url", true);
						$phone = get_post_meta($post->ID, "_phone", true);
						$email = get_post_meta($post->ID, "_email", true);
						$desc = get_post_meta($post->ID, "_desc", true);
						echo '<div class="new-resource animated ' . $category . '">';
						echo '<div class="resource-name ' . $level . '" id="' . $titleID . '">';
						echo '<h3>' . $title . '</h3>';
						echo '<span class="arrow">&#8635;</span></div>';
						echo '<div class="resource-content" id="content-' . $titleID . '">';
						echo '<p><a href="' . $url . '" target="_blank">' . $url . '</a></p>';
						echo '<p>' . $phone . '</p>';
						echo '<p><a href="mailto:' . $email . '">' . $email . '</a></p>';
						echo '<p>' . $desc . '</p>';
						echo '</div></div>';
					endwhile;
				?>
			</div>
		</div>
	</div>
</div>
</div>
<?php get_footer(); ?>
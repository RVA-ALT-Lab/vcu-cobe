<?php
/**
*	Template Name: Resources
*
*
*/

?>

<?php get_header(); ?>

<body class="cw">

<div class="resource-container">
	<div class="head-area">
		<h1><?php echo get_the_title( $post->ID ); ?></h1>
		<?php the_post_thumbnail(); ?>
	</div>
	<div class="content-area">
		<div class="resource-area">
			<div class="resource-legend">
			<div class="legend-item color-key">
				<h3>Color Key</h3>
			</div>
			<?php
				$args = array('orderby'=>'slug', 'hide_empty'=>true);
				$levels = get_terms('cw_resource_level', $args);
				foreach($levels as $level) {
					$levelsID = strtolower($level->name);
					$levelsID = str_replace(' ', '', $levelsID);
					echo '<div class="legend-item ' . $levelsID . '">';
					echo '<h3>' . $level->name . '</h3>';
					echo '</div>';
				}
			?>
			</div>
			<?php
				$args = array('orderby'=>'slug', 'hide_empty'=>true);
				$cats = get_terms('cw_resource_type', $args);
				foreach($cats as $cat) {
					$catID = strtolower($cat->name);
					$catID = str_replace(' ', '', $catID);
					echo '<div class="resource-group" id="' . $catID . '">';
					echo '<h2>' . $cat->name . '</h2>';
					echo '</div>';
				}
			?>
		</div>
	</div>
</div>
<div class="dummy-holder" style="display: none;">
<?php
	$resources_array = array();
	$args = array( 'post_type' => 'cw_resources', 'posts_per_page' => -1 );
	$resources_loop = new WP_query( $args );
	while ( $resources_loop->have_posts() ) : $resources_loop->the_post();
		$category = strip_tags( get_the_term_list($post->ID, 'cw_resource_type') );
		$category = strtolower($category);
		$category = str_replace(' ', '', $category);
		$level = strip_tags( get_the_term_list($post->ID, 'cw_resource_level') );
		$level = strtolower($level);
		$title = get_the_title($post->ID);
		$titleID = strtolower($title);
		$titleID = str_replace(' ', '', $titleID);
		$url = get_post_meta($post->ID, "_url", true);
		$phone = get_post_meta($post->ID, "_phone", true);
		$desc = get_post_meta($post->ID, "_desc", true);
		$resource_data = array('category' => $category, 'level' => $level, 'title' => $title, 'titleID' => $titleID, 'url' => $url, 'phone' => $phone, 'desc' => $desc);
		array_push($resources_array, $resource_data);
	endwhile;
	$resources_array = json_encode($resources_array);
	echo $resources_array;
?>
</div>

<?php get_footer(); ?>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/resources.js" type="text/javascript"></script>
</body>

</html>
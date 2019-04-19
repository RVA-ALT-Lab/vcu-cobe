<?php
/**
*	Template Name: Blogs
*
*
*/

?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="frame">

						<main id="main" class="bit-75" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php
							$blog_paged = get_query_var('paged') ? get_query_var('paged') : 1;
							$args = array( 'post_type' => 'post', 'paged' => $blog_paged, 'posts_per_page' => 4, 'orderby' => 'date', 'order' => 'DSC', 'ignore_sticky_posts' => 1 );
							$posts_loop = new WP_query( $args );
							if ($posts_loop->have_posts()) : while ($posts_loop->have_posts()) : $posts_loop->the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

								<section class="entry-content cf">
									<div class="bit-40">
									<div class="blog-img-wrap">
									<?php $imgId = get_post( get_post_thumbnail_id() ); ?>
									<?php $alt_text = get_post_meta($imgId->ID, '_wp_attachment_image_alt', true); ?>
									<?php echo '<img src="' . wp_get_attachment_url(get_post_thumbnail_id($post->ID)) . '" alt="' . $alt_text . '">'; ?>
									</div>
									</div>
									<div class="bit-60">
									<h1 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
									<p class="byline entry-meta vcard">
                                                                        <?php printf( __( 'Posted', 'bonestheme' ).' %1$s %2$s',
                       								/* the time the post was published */
                       								'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
                       								/* the author of the post */
                       								'<span class="by">'.__( 'by', 'bonestheme').'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
                    							); ?>
									</p>
									<?php the_excerpt(); ?>
									</div>
								</section>

								<footer class="article-footer cf">
									<p class="footer-comment-count">
										<?php //comments_number( __( '<span>No</span> Comments', 'bonestheme' ), __( '<span>One</span> Comment', 'bonestheme' ), __( '<span>%</span> Comments', 'bonestheme' ) );?>
									</p>


                 	<?php //printf( '<p class="footer-category">' . __('filed under', 'bonestheme' ) . ': %1$s</p>' , get_the_category_list(', ') ); ?>
				 

                  <?php the_tags( '<p class="footer-tags tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>


								</footer>

							</article>

							<?php endwhile; ?>
									<?php wp_pagenavi( array( 'query' => $posts_loop ) ); ?>
									<?php //bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>


						</main>

					<?php get_sidebar(); ?>

				</div>

			</div>


<?php get_footer(); ?>

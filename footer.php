			<footer class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

				<div id="inner-footer" class="frame">

					<nav role="navigation">
						<?php wp_nav_menu(array(
    					'container' => 'div',                           // enter '' to remove nav container (just make sure .footer-links in _base.scss isn't wrapping)
    					'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
    					'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
    					'menu_class' => 'nav footer-nav cf',            // adding custom nav class
    					'theme_location' => 'footer-links',             // where it's located in the theme
    					'before' => '',                                 // before the menu
    					'after' => '',                                  // after the menu
    					'link_before' => '',                            // before each link
    					'link_after' => '',                             // after each link
    					'depth' => 0,                                   // limit the depth of the nav
    					'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
						)); ?>
					</nav>
					<div class="bit-3">
<left><a id="vcu-seal" href="http://www.vcu.edu/"><img src="<?php  echo get_stylesheet_directory_uri(); ?>/library/images/vcu-seal.svg" alt="VCU Seal"></a></left>
					<p>
					<?php if ( is_active_sidebar( 'left_footer_1' ) ) : ?>
							<?php dynamic_sidebar( 'left_footer_1' ); ?>
					<?php endif; ?>					
					</p>
					<ul class="vcuhp-footer-list list-unstyled vcuhp-footer-infolinks">
						<li class="list-item"><a href="mailto:webmaster@vcu.edu" title="Contact the VCU webmaster">Webmaster</a></li>
						<li class="list-item"><a href="/privacy-statement/" class="vcuhp-footer-link">Privacy statement</a></li>
						<li class="list-item"><a href="https://accessibility.vcu.edu/" class="vcuhp-footer-link">Accessibility</a></li>
					</ul>
					</div>
					<div class="bit-3" id="footer-center">
					<a id="vcu-donate" href="http://cobe.vcu.edu/Donate"><img src="http://cobe.vcu.edu/wp-content/uploads/2017/02/donate_rir.gif" alt="VCU-Donate"></a>
					<div id="cobe-cr">
					<h2 class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>COBE</h2>
					<p>Last Updated: April 11, 2019</p>
					</div>
					</div>
					<div class="bit-3">
					<?php get_template_part('page-subscribe-partial', 'front-page-subscribe'); ?>
					</div>
				</div>
				
			</footer>

		</div>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

	</body>

</html> <!-- end of site. what a ride! -->

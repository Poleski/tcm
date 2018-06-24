<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Methanol
 */

?>
</div>

	<footer id="colophon" class="site-footer">
        <?php if( is_active_sidebar( 'methanol_footer_1' ) || is_active_sidebar( 'methanol_footer_2' ) || is_active_sidebar( 'methanol_footer_3' ) || is_active_sidebar( 'methanol_footer_4' )) : ?>
        <div class="widget-container">
            <div class="widgets">
                <?php
                    for($i = 1; $i < 5; $i++) :
                        $widget = 'methanol_footer_' . $i;

                        if (is_active_sidebar($widget)) :
                ?>
                    <div class="footer-widget <?php echo $widget; ?>">
                        <?php dynamic_sidebar( $widget );?>
                    </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>
        <?php endif; ?>

		<div class="site-info">
			<span>All rights reserved (c) <?php echo date('Y'); ?> Richlife</span>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

<?php
/**
 * Template Name: Testimonials
 *
 * The template for displaying list of testimonials
 *
 * @package methanol
 */

?>

<div class="testimonial-container">
    <?php
        $testimonial_args = array(
            'post_type' => 'testimonial',
            'order' => 'ASC',
            'orderby' => 'menu_order',
            'posts_per_page' => '-1'
        );

        $category_filter = get_post_meta($post->ID, 'custom_category_filter', true);

        if ($category_filter) {

            $category_filter = explode(',', $category_filter);

            $testimonial_args['tax_query'] = array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'testimonial_category',
                    'field' => 'slug',
                    'terms' => $category_filter
                )
            );
        }

        $testimonial_query = new WP_Query($testimonial_args);

        if ($testimonial_query->have_posts()) :
    ?>
        <div class="slider slider-dots slider-testimonial">
             <div class="slides">
                 <?php while ($testimonial_query->have_posts()) : $testimonial_query->the_post();
                    $subtitle = get_post_meta(get_the_ID(), 'testimonial_subtitle', true);
                 ?>
                     <div class="slide">
                         <div class="testimonial-container">
                             <div class="testimonial-quote-container">
                                 <blockquote><i class="fas fa-quote-left"></i><?php the_content() ?></blockquote>
                             </div>
                             <div class="testimonial-footer">
                                 <div class="testimonial-footer-left">
                                     <?php if (has_post_thumbnail()) { ?>
                                         <img src="<?php the_post_thumbnail_url(); ?>" />
                                     <?php } ?>
                                 </div>
                                 <div class="testimonial-footer-right">
                                     <h4><?php the_title(); ?></h4>
                                     <p><?php echo $subtitle ?></p>
                                 </div>
                             </div>
                         </div>
                     </div>
                 <?php endwhile; ?>
             </div>
        </div>
    <?php else: ?>
        <div class="notice">
            <h3>Coming soon...</h3>
        </div>
    <?php endif; ?>
</div>

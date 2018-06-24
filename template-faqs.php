<?php
/**
 * Template Name: FAQs
 *
 * The template for displaying FAQs
 *
 * @package methanol
 */

?>

<div class="faq-container">
        <?php
        $faq_args = array(
            'post_type' => 'faq',
            'order' => 'ASC',
            'orderby' => 'menu_order',
            'posts_per_page' => '-1'
        );

        $category_filter = get_post_meta($post->ID, 'custom_category_filter', true);

        if ($category_filter) {

            $category_filter = explode(',', $category_filter);

            $faq_args['tax_query'] = array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'faq_category',
                    'field' => 'slug',
                    'terms' => $category_filter
                )
            );
        }

        $faq_query = new WP_Query($faq_args);

        if ($faq_query->have_posts()) :

        ?>
            <div class="faqs">

            <?php while ($faq_query->have_posts()) : $faq_query->the_post(); ?>
                <h3><?php the_title(); ?></h3>
                <div class="faq-content">
                    <?php the_content(); ?>
                </div>
            <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="notice">
                <h3>Coming soon...</h3>
            </div>
        <?php endif; ?>
    </div>
</div>
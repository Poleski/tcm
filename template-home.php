<?php
/**
 * Template Name: Home
 *
 * The template for displaying a one-page
 *
 * @package methanol
 */
?>
<?php get_header(); ?>

<?php

$args=array(
    'post_type' => 'page',
    'order' => 'ASC',
    'orderby' => 'menu_order',
    'post_parent' => $post->ID,
    'posts_per_page' => '-1',
    'meta_query' => array(
        array(
            'key' => 'separate',
            'compare' => 'NOT EXISTS'
        )
    )
);

$main_query = new WP_Query($args);

/* Start the Loop */
while ($main_query->have_posts()) : $main_query->the_post();

?>
    <section id="<?php echo $post->post_name ?>"
        <?php if (has_post_thumbnail()) { ?>
            class="background-section" style="background-image:url('<?php the_post_thumbnail_url('full'); ?>')"
        <?php } else if (get_post_meta($post->ID, 'background-color', true)) { ?>
            class="background-section" style="background-color:<?php echo get_post_meta($post->ID, 'background-color', true); ?>"
        <?php }; ?>
    >
        <h2 class="section-title"><?php the_title(); ?></h2>
        <?php the_content(); ?>
    </section>
<?php endwhile; ?>

<?php get_footer(); ?>
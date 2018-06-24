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

    $backgroundImage = has_post_thumbnail();
    $backgroundColor = get_post_meta($post->ID, 'page_background_color', true);
    $hasImage = has_post_thumbnail();
    $removeTitle= get_post_meta($post->ID, "page_title_remove", true);
    $removePadding = get_post_meta($post->ID, "page_padding_remove", true);
    $slug = substr(get_page_template_slug($post->ID), 0, -4);

    $sectionClasses = array();
    $sectionStyles = array();

    if ($backgroundImage || $backgroundColor) {
        $sectionClasses[] = "background-section";
    }

    if ($backgroundImage) {
        $sectionStyles[] = "background-image: url(" . the_post_thumbnail_url('full') . ")";
    }

    if ($removeTitle) {
        $sectionClasses[] = "no-title";
    }

    if ($removePadding) {
        $sectionClasses[] = "no-padding";
    }

?>
    <section id="<?php echo $post->post_name ?>"
         class="<?php echo implode(' ', $sectionClasses); ?>"
         style="<?php echo implode(';', $sectionStyles); ?>"
    >

    <h2 class="section-title"><?php the_title(); ?></h2>

    <?php if ($slug) : ?>
        <?php get_template_part($slug); ?>
    <?php else: ?>
        <?php the_content(); ?>
    <?php endif; ?>

    </section>
<?php endwhile; ?>

<?php get_footer(); ?>
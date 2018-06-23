<?php
/**
 * Template Name: Members
 *
 * The template for displaying list of members
 *
 * @package methanol
 */
?>

<div class="member-container">
    <div class="members">
        <?php
        $member_args = array(
            'post_type' => 'member',
            'order' => 'ASC',
            'orderby' => 'menu_order',
            'posts_per_page' => '-1'
        );
        $member_query = new WP_Query($member_args);

        if ($member_query->have_posts()) :
            while ($member_query->have_posts()) : $member_query->the_post();

            $short_description = get_post_meta(get_the_ID(), 'short_description', true);

        ?>
            <div class="member">
                <div class="member-photo-container">
                    <div class="member-photo"<?php if (has_post_thumbnail()) { ?> style="background-image: url(<?php the_post_thumbnail_url('full'); ?>)"<?php } ?> ></div>
                </div>
                <h4><?php the_title();?></h4>
                <p><?php echo $short_description; ?></p>
                <div class="member-cta-container">
                    <a href="javascript: void(0)" data-href="<?php the_permalink(); ?>">Learn more</a>
                </div>
            </div>
        <?php
            endwhile;

        else:
        ?>
            <div class="notice">
                <h3>Coming soon...</h3>
            </div>
        <?php endif; ?>
    </div>
</div>

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

        $category_filter = get_post_meta($post->ID, 'custom_category_filter', true);

        if ($category_filter) {

            $category_filter = explode(',', $category_filter);

            $member_args['tax_query'] = array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'member_category',
                    'field' => 'slug',
                    'terms' => $category_filter
                )
            );
        }

        $member_query = new WP_Query($member_args);

        if ($member_query->have_posts()) :
            while ($member_query->have_posts()) : $member_query->the_post();

            $short_description = get_post_meta(get_the_ID(), 'member_short_description', true);

        ?>
            <div class="member">
                <div class="member-photo-container">
                    <div class="member-photo"<?php if (has_post_thumbnail()) { ?> style="background-image: url(<?php the_post_thumbnail_url('full'); ?>)"<?php } ?> ></div>
                </div>
                <h4><?php the_title();?></h4>
                <h6><?php echo $short_description; ?></h6>
                <div class="member-cta-container">
                    <span>Learn more<a href="<?php the_permalink(); ?>"></a></span>
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
<script>
    jQuery(document).ready(function() {
        jQuery(".member-container .member-cta-container a").magnificPopup({
            type: 'ajax',
            gallery:{
                enabled: true
            }
        });

        jQuery('.member-cta-container').each(function() {
            jQuery(this).click(function() {
                jQuery(this).find('a').trigger('click');
            });
        });
    });
</script>
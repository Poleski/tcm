<?php
if ( have_posts() ) while ( have_posts() ) : the_post();

    $short_description = get_post_meta(get_the_ID(), 'member_short_description', true);
    ?>

    <div id="member-popup" class="member">
        <div class="member-popup-left">
            <div class="member-photo-container">
                <?php if (has_post_thumbnail()) { ?>
                    <img src="<?php the_post_thumbnail_url(); ?>" />
                <?php } ?>
            </div>
            <div class="member-details">
                <h4><?php the_title(); ?></h4>
                <h6><?php echo $short_description; ?></h6>
            </div>
        </div>
        <div class="member-popup-right">
            <p><?php the_content(); ?></p>
        </div>
    </div>


<?php endwhile; ?>
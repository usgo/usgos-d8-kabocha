<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div <?php post_class('containfloats') ?> id="post-<?php the_ID(); ?>">
     <h2 class="storytitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
     <p class="date"><?php the_time('l F j, Y'); ?></p>
	<div class="storycontent">
		<?php the_content(__('Continue reading...)')); ?>
	</div>
    <div class="meta containfloats">
        <div class="categories">
            <?php _e("Categories:"); ?> <?php the_category(',') ?>
        </div>
        <?php if (!in_category('members-only') && function_exists('ADDTOANY_SHARE_SAVE_KIT')) { 
            /* No share button for "Member's Only" posts */
            echo '<div class="sharesave">';
            ADDTOANY_SHARE_SAVE_KIT();
            echo '</div>';
          } ?>

        <div class="tags">
            <?php the_tags(__('Tags: '), ', ', ''); ?>
        </div>
        <div class="edit">
            <?php edit_post_link(__('Edit This Post')); ?>
        </div>
    </div>
</div>
<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

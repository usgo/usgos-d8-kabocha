<!-- begin sidebar -->
<ul class="mainnav">
<?php 	/* Widgetized sidebar, if you have the plugin installed. */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
	<?php wp_list_pages('title_li=' . __('Pages:')); ?>
	<?php wp_list_bookmarks('title_after=&title_before='); ?>
    <?php wp_list_categories('show_option_all=All&exclude=1182&title_li=' . __('Categories:')); ?>
</ul>
<form class="search" id="newssearch" method="get" action="<?php bloginfo('home'); ?>">
    <fieldset>
        <legend>News Search</legend>
        <input type="text" class="searchbox" id="s" name="s" maxlength="255" value="" />
        <input type="submit" class="searchbutton" value="Search" />
    </fieldset>
</form>
<ul class="mainnav">
    <li id="archives"><?php _e('Archives:'); ?>
	    <ul>
	    <?php wp_get_archives('type=monthly'); ?>
	    </ul>
    </li>
</ul>
<div class="mainnav" id="ejnavarchive">
    <a href="/american-go-e-journal-archive">Older E-Journals</a>
</div>
<ul class="mainnav">
    <li id="meta"><?php _e('Meta:'); ?>
	    <ul>
		    <?php wp_register(); ?>
		    <li><?php wp_loginout(); ?></li>
		    <li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Latest go news via RSS'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr> Feed'); ?></a></li>
		    <?php wp_meta(); ?>
	    </ul>
    </li>
<?php endif; ?>
</ul>
<!-- end sidebar -->

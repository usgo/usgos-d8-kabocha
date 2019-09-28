<?php
// Get the location of the /news directory.
$drupal_frontpage_news_dir = dirname(__DIR__, 2) . "/news";

require($drupal_frontpage_news_dir . '/wp-blog-header.php');

// Fix to allow frontpage to display sticky_posts.
global $query_string;
query_posts($query_string . '&cat=-1182&showposts=5');

if (!have_posts())
{
    query_posts($query_string . '&cat=-1182&showposts=3');
}

include('content.wordpress.php');
?>

<?php
// Provides a dynamic way to get the /news directory for wordpress.
$newsbar_generate_news_dir = dirname(__DIR__, 2) . "/news";

require($newsbar_generate_news_dir . '/wp-blog-header.php');

query_posts('cat=712,-1182,-542&showposts=5');
if (!have_posts())
{
    query_posts('cat=-1182&showposts=5');
}
if (have_posts()) :
?>
<h2 id="newsHL">Latest News</h2>
<ul id="news">
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink(); ?>"><?php the_title('<span>', '</span>');
if (function_exists('the_advanced_excerpt')) {
    $excerpt = the_advanced_excerpt('length=25&use_words=1&no_custom=1&ellipsis=%26hellip;&allowed_tags=strong,em', true);
}
else
{
    $excerpt = get_the_excerpt();
}
$tags_to_remove = array("<p>", "</p>");
print str_replace($tags_to_remove, "", $excerpt);
?>
</a></li>
<?php endwhile; ?>
    <li><a href="/news/"><span>More News&hellip;</span></a></li>
    <li><a href="/news/feed/"><span class="rss"><abbr title="Really Simple Syndication">RSS</abbr> Feed</span></a></li>
</ul>
<?php endif; ?>

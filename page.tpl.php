        <div id="header">
            <?php include(path_to_theme() . "/includes/header.html"); ?>
            <div id="navwrap">
                <?php print theme('links', array('links' => menu_navigation_links('menu-header-links'), 'attributes' => array('class'=> array('navbar'), 'id' => 'headerlinks') )); ?>
            </div>
        </div>
        <div id="container">
            <div id="fauxcolbgR" class="containfloats">
                <div id="contentwrapper">
                    <div id="content">
<?php
if (!empty($messages)) {
    print $messages;
}
if (!empty($page['help'])) {
    print '<div id="help">' . render($page['help']) . '</div>';
}
if ($page['highlighted']) {
    print '<div id="highlighted">' . render($page['highlighted']) . '</div>';
}
print render($title_prefix);
if ($is_front) {
    print '<h1 id="pagetitle">Welcome to the American Go Association</h1>';
}
else
{
    print "<h1 id=\"pagetitle\">$title</h1>\n";
}
print render($title_suffix);
if (!empty($tabs)) {
    print "<div class=\"tabs\">" . render($tabs) . "</div>";
}
if ($is_front) {
    include(path_to_theme() . "/includes/drupal.frontpage.html");
?>
                        <div id="morenewsnav">
                            <a href="/news/">More Go News</a>
                        </div>
<?php
}
else
{
    print render($page['content']);
}
?>
                    </div>
                </div>
                <div id="navcol" class="ie7fix">
                    <?php if (!empty($page['sidebar_first'])) {print render($page['sidebar_first']);} ?>
                </div>
<?php if (!empty($page['sidebar_second'])) {
                print "<div id=\"extracol\">" . render($page['sidebar_second']) . "</div>";
} ?>
            </div>
        </div>
        <div id="footer">
            <?php include(path_to_theme() . "/includes/footer.html"); ?>
        </div>
        <div id="postfooter" class="containfloats">
            <?php if (!empty($page['footer_ads'])) {
                print "<div id=\"ads\" class=\"containfloats\">" . render($page['footer_ads']) . "</div>";
            } ?>
            <?php print theme('links', array('links' => menu_navigation_links('menu-footer-links'), 'attributes' => array('id'=> 'sitelinks'))); ?>
        </div>
<!--
Copyright 2011 Joshua Simmons

All rights reserved
-->

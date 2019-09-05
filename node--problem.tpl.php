<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print $user_picture; ?>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="submitted">
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      hide($content['field_sgf']);
      hide($content['field_to_play']);
      hide($content['field_ready']);
      $sgf_url = url(file_create_url($field_sgf[0]['uri']))
?>
<?php print render($content); ?>
<script type="text/javascript">
eidogoConfig = {
    theme: "standard", // "standard" or "compact"(stack panes vertically)
    mode: "play",    // "play" or "view"
    problemMode: false,     // partial board covering just the initial stones
    showNavTree: true,   // Only way for theme="compact" to show variations?
    showComments: true,   // Scrollable comment pane
    showPlayerInfo: true,   // Static line showing player names
    showGameInfo: false,  // Big pane for misc tag data
    showTools: true,   // Markups menu.  Really only makes sense for mode=play!
    showOptions: true,   // "Download SGF" (dumps raw SGF to browser!?)
    markCurrent: true,   // Tiny square on current(last) move
    markVariations: false,  // Put numbers on 1st move of all variations
    markNext: false,  // Put mark on next move
    enableShortcuts: true    // Don't know what this does
};
</script>
<script type="text/javascript" src="/theme/eidogo/player/js/all.compressed.js"></script>
<noscript>
<p>Error:  the Eidogo go player requires a JavaScript-enabled browser.  Most likely, to see the go board here, you only need to turn on JavaScript from the Options tab on your browser's Tool menu.</p>
</noscript>
<div class="eidogo-player-auto" sgf="<?php print $sgf_url; ?>"> </div>
<?php print l("Downloadable game record", $sgf_url); ?>
<p>For problems, questions, or comments (<strong>even if</strong> they're about this web page or go in general), email the <a href="mailto:potw@usgo.org">Problem of the Week editor</a></p>
<?php
if ($is_admin || $status != 1):

    // Set the sgf_uri in this way to avoid error
    // with variables being passed by reference.
    $sgf_uri = $field_sgf[0]['uri'];
    $sgf_uri = explode("/", $sgf_uri);
    $sgf_uri = array_pop($sgf_uri);

    // Base url for the sgf.
    $auto_base = "/weekly_sgf_preview/" . $sgf_uri;
    $png_uri = $auto_base . ".png";

    // Set the proto for either https or http.
    $proto = isset($_SERVER['HTTPS']) ? "https://" : "http://";

    $auto_to_play = @file_get_contents($proto . $_SERVER['SERVER_NAME'] . $auto_base . '.toplay');
?>
<h2>This section is only visible to administrators:</h2>
<h3>Automatically generated preview image:</h3>
<img class = "graphic" src="<?php print $png_uri ?>" alt="auto generated preview image" />
<p>Note: if no picture is visible above, check <a href="<?php print $png_uri ?>">the automatic preview image</a> sometimes a useful error will
be shown.</p>
<p>Automatically generated "to play": <?php print $auto_to_play ?></p>
<p>Note: if no automatic to play is visible above, look in the <a href="<?php print "$auto_base.toplay" ?>">automatic to play file</a>, sometimes a useful error will be shown.
<p>IMPORTANT: inform <a href="mailto:joshua.simmons@usgo.org">Joshua Simmons</a> if there are any problems with these automatically generated files.  Send the SGF file that doesn't work, so I can debug it!</p>
<?php endif; ?>
  </div>

  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>

</div>

<?php if ($block->module != 'mean_menus')
{
?>
<div id="block-<?php print $block->module .'-'. $block->delta; ?>" class="block block-<?php print $block->module ?>">

<?php if ($block->subject): ?>
  <h2><?php print $block->subject ?></h2>
<?php endif;?>
<div class="content">
<?php
}
?>
<?php print render($content) ?>
<?php if ($block->module != 'mean_menus')
{
?>
</div>
</div>
<?php
}
?>

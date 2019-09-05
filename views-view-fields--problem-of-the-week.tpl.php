<?php
$content_uri = $fields['path']->content;
$title = $fields['title']->content;
$sgf_uri = $row->field_field_sgf[0]['raw']['uri'];
$sgf_uri = explode("/", $sgf_uri);
$sgf_uri = array_pop($sgf_uri);

$auto_base = "/weekly_sgf_preview/" . $sgf_uri;
if (!empty($row->field_field_sgf_preview)) {
  $png_uri = file_create_url($sgf_uri);
}
else {
  $png_uri = $auto_base . ".png";
}
$to_play = $fields['field_to_play']->content;
$img = "<img src=\"$png_uri\" alt=\"$title\" />";
print "<a class=\"potwpreview\" href=\"$content_uri\" title=\"$title\">$img</a>";
if ($to_play != "Automatic") {
  print "<p class=\"potwtoplay\"><em>$to_play</em> to play</p>";
}
else {
  // Set the correct protocal for the server.
  $proto = !isset($_SERVER['HTTPS']) ? "https://" : "http://";

  // Define the location of the *.toplay file for troubleshooting.
  $auto_to_play = @file_get_contents($proto . $_SERVER['SERVER_NAME'] . $auto_base . '.toplay');
  if ($auto_to_play != FALSE) {
    print "<p class=\"potwtoplay\"><em>$auto_to_play</em> to play</p>";
  }
}
?>

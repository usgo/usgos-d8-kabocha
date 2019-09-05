<?php

function kabocha_preprocess_html(&$variables) {
  if ($variables['is_front']) {
    // Dynamically get the themes include directory.
    $theme_includes_directory = dirname(__DIR__, 1) . "/includes";
    $wp_head = file_get_contents($theme_includes_directory . "/drupal.wphead.html");
    drupal_add_html_head(array('#type' => 'markup', '#markup' => $wp_head), 'wp-head');
  }
}

function kabocha_preprocess_page(&$variables) {
  if(!empty($variables['page']['sidebar_second'])) {
    drupal_add_css(path_to_theme() . '/style/right_col.css');
  }
  drupal_add_css(path_to_theme() . '/style/ie6_fixes.css',
                 array('browsers' => array('IE' => 'IE 6', '!IE' => FALSE)));
  drupal_add_css(path_to_theme() . '/style/ie7_fixes.css',
                 array('browsers' => array('IE' => 'IE 7', '!IE' => FALSE)));
  drupal_add_css(path_to_theme() . '/style/ie_fixes.css',
                 array('browsers' => array('IE' => 'lte IE 8', '!IE' => FALSE)));
}

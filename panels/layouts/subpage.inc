<?php
/**
 * Implementation of HOOK_panels_layouts().
 */
function elsinore_subpage_panels_layouts() {
  $items['subpage'] = array(
    'title' => t('subpage - 2 spalter'),
    'icon' => 'subpage.png',
    'theme' => 'subpage',
    'css' => 'subpage.css',
    'panels' => array(
      'left' => t('Left '),
      'right' => t('Right'),
    ),
  );

  return $items;
}
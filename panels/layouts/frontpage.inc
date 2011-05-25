<?php
/**
 * Implementation of HOOK_panels_layouts().
 */
function elsinore_frontpage_panels_layouts() {
  $items['frontpage'] = array(
    'title' => t('Frontpage 3 spalter'),
    'icon' => 'frontpage.png',
    'theme' => 'frontpage',
    'css' => 'frontpage.css',
    'panels' => array(
      'top' => t('top'),
      'left' => t('Left '),
      'middle' => t('middle'),
      'right' => t('Right'),
      'bottom' => t('bottom'),
    ),
  );

  return $items;
}
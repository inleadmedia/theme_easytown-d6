<?php
/**
 * Implementation of HOOK_panels_layouts().
 */
function elsinore_basepage_panels_layouts() {
  $items['basepage'] = array(
    'title' => t('basepage - 3 spalter'),
    'icon' => 'basepage.png',
    'theme' => 'basepage',
    'css' => 'basepage.css',
    'panels' => array(
      'left' => t('Left '),
      'middle' => t('middle'),
      'right' => t('Right'),
    ),
  );

  return $items;
}
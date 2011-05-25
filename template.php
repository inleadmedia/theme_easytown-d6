<?php
// $Id$
/**
 * Override of theme_ting_search_form().
 */
function elsinore_ting_search_form($form){
  $form['submit']['#type']  = "submit" ;
  $form['submit']['#src']   = drupal_get_path('theme','elsinore')."/images/searchbutton.png";
  $form['submit']['#attributes']['class']   = "";

  return drupal_render($form);
}

/**
 * Override of theme_user_login_block().
 */
function elsinore_user_login_block($form){
  $form['submit']['#type']  = "submit" ;
  $form['submit']['#src']   = drupal_get_path('theme','elsinore')."/images/accountlogin.png";
  $form['submit']['#attributes']['class']   = "";


  $name = drupal_render($form['name']);
  $pass = drupal_render($form['pass']);
  $submit = drupal_render($form['submit']);
  $remember = drupal_render($form['remember_me']);

  return  $name . $pass .$submit . $remember . drupal_render($form);
}

/**
 * Override of theme_menu_item_link().
 */
function elsinore_menu_item_link($link) {
  if ($link['href'] == 'http://nolink') {
    return '<span class="nolink">' . check_plain($link['title']) . '</span>';
  }
  else {
    return theme_menu_item_link($link);
  }
}

/**
 * Preprocess page template variables.
 */
function elsinore_preprocess_page(&$variables) {
	//Magic function to override module js with .info js files :-)
	$info = file_get_contents(drupal_get_path('theme','elsinore').'/elsinore.info');
	preg_match_all('/^scripts\[\]\s*=\s*([\w\.\/\-\_]*)/im', $info, $matches);
	if (0 < count($matches[1])) {
		foreach ($matches[1] AS $key => $value) {
			//$regExp = '/<script type="text\/javascript" defer="defer" src="[\w\/]*js\/ting_facet_browser\.js\?\w?"[^>]*><\/script>/im';
			$regExp = '/<script type="text\/javascript" defer="defer" src="[\w\/]*'.str_replace(array('/', '.'),array('\/', '\\.'),$value).'(\?\w?)"[^>]*><\/script>/im';
			$replaceWith = '<script type="text/javascript" defer="defer" src="'.base_path().drupal_get_path('theme','elsinore').'/'.$value.'$1"></script>';
			$variables['closure'] = preg_replace($regExp, $replaceWith, $variables['closure']);
		}
	}	
}

/**
 * Preprocess node template variables.
 */
function elsinore_preprocess_node(&$variables) {
  if ($variables['type'] == 'page' && isset($variables['field_page_type'][0]['safe'])) {
    $page_type = $variables['field_page_type'][0]['safe'];

    if (!empty($page_type)) {
      $variables['classes'] .= ' page-type-' . $page_type;
    }
  }
}

/**
 * Preprocess library location pane template variables.
 */
function elsinore_preprocess_ding_panels_content_library_location(&$variables) {
  $node = $variables['node'];

  // Add a static Google map to the location information.
  if (function_exists('location_has_coordinates') && location_has_coordinates($node->location)) {
    $map_url = url('http://maps.google.com/maps/api/staticmap', array('query' => array(
      'zoom' => 14,
      'size' => '210x210',
      'markers' => $node->location['latitude'] . ',' . $node->location['longitude'],
      'sensor' => 'false',
    )));
    $variables['library_map'] = theme('image', $map_url, '', '', NULL, FALSE);
  }
}

/**
 * Preprocess library title pane template variables.
 */
function  elsinore_preprocess_ding_panels_content_library_title(&$variables) {
  if (isset($variables['library_links'])) {
    $variables['library_links']['events'] = l('Det sker', $variables['base_url'] . '/arrangementer');
    $variables['library_navigation'] = theme('item_list', $variables['library_links']);
  }
}


<?php
// $Id$

/**
 * @file ding_panels_content_libary_location.tpl.php
 * Library location, map, etc.
 */

/** 
 * The address, etc. are marked up to conform to the hCard microformat.
 * http://microformats.org/wiki/hcard for more information.
 */
 
?>
<!--
Hva gider du ikke lige at blive   overskrevet?
  ding_panels_content_libary_location.tpl.php
  
-->
<div class="library-info">

	<div class="library-map">
    <div class="library-map-inner">
    <?php print $library_map; ?>  
    </div>
  </div>

	<div class="library-info-inner">

	  <div class="vcard">
	    <span class="fn org"><?php print $node->title; ?></span>
	    <div class="adr">
	      <div class="street-address"><?php print $node->location['street']; ?></div>
	      <span class="postal-code"><?php print $node->location['postal_code']; ?></span>
	      <span class="locality"><?php print $node->location['city']; ?></span>
	      <div class="country-name"><?php print $node->location['country_name']; ?></div>
	    </div>
      <?php if($node->location['phone']){ ?>
	    <div class="tel">
	      <span class="type"><?php print t('Phone'); ?></span> <?php print $node->location['phone']; ?>
	    </div>
	    <?php } ?>
      <?php if($node->location['fax']){ ?>
	    <div class="tel">
	      <span class="type"><?php print t('Fax'); ?></span> <?php print $node->location['fax']; ?>
	    </div>
	    <?php } ?>
      <?php if (!empty($node->field_email[0]['email'])): ?>
        <div class="email">
          <span class="type"><?php echo t('Email'); ?></span> <?php echo l($node->field_email[0]['email'], 'mailto:' . $node->field_email[0]['email'], array('absolute' => true)) ; ?>
        </div>
      <?php endif; ?>
	  </div>

	  <?php print $library_links; ?>  
	</div>
  
</div>

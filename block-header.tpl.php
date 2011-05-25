<?php
/*
ad a class="" if we have anything in the $classes var
this is so we can have a cleaner output - no reason to have an empty <div class="" id=""> 
*/
if($classes){
   $classes = ' class="' . $classes . '"';
}

if($id_block){
  $id_block = ' id="' . $id_block . '"';  
}
?>
<div<?php print $id_block . $classes; ?>>
  <?php if ($block->subject): ?>
    <h3><?php print l(t('Åbningstider i dag'), 'biblioteker'); ?></h3>
  <?php endif; ?>

  <div class="block-content">
    <?php print $block->content; ?>
  </div>
</div>

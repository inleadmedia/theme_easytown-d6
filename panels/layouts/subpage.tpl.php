<!--subpage.tpl.php-->

<div class="subpage clearfix" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>	
  <div class="panel-left">
    <?php print $content['left']; ?>  
  </div>

  <div class="panel-right">
    <?php print $content['right']; ?>  
  </div>
</div>
<!-- / subpage.tpl.php-->
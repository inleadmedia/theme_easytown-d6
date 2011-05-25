<!--basepage.tpl.php-->

<div class="basepage clearfix" <?php if (!empty($css_id)) { print 'id="$css_id"'; } ?>>	
  <div class="panel-left">
    <?php print $content['left']; ?>  
  </div>

  <div class="panel-middle">
    <?php print $content['middle']; ?>
    <div class="prevent-collapse"></div>
  </div>

  <div class="panel-right">
    <?php print $content['right']; ?>  
  </div>
</div>
<!-- / basepage.tpl.php-->

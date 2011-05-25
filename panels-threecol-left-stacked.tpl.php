<!--panels-threecol-left-stacked.tpl.php-->
<div class="panel-threecol-left-stacked clearfix" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>

	<div class="content-left">

			<div class="content-top">
      	<?php print $content['top']; ?>
			</div>

			<div class="content-middle">

				<div class="panel-left">
			      <?php print $content['left']; ?>      		
				</div>

				<div class="panel-middle">
			      <?php print $content['middle']; ?>        
				</div>

			</div>

			<div class="panel-bottomt">
      	<?php print $content['bottom']; ?>        
			</div>

	</div>

	<div class="content-right">
      <div class="panel-pane pane-library_location  ">
<!--
Hva gider du ikke lige at blive   overskrevet?
  ding_panels_content_libary_location.tpl.php
  
-->
<div class="library-info">

	<div class="library-map">
    <div class="library-map-inner">
    <img title="" alt="" src="http://maps.google.com/maps/api/staticmap?zoom=14&amp;size=210x210&amp;markers=55.708597%2C12.521630&amp;sensor=false">  
    </div>
  </div>
<h3>Kontaktinformationer</h3>

	<div class="library-info-inner">

	  <div class="vcard">
	    <span class="fn org">Easytown Bibliotek</span>
	    <div class="adr">
	      <div class="street-address">Rentemestervej 80</div>
	      <span class="postal-code">2400</span>
	      <span class="locality">København NV</span>
	      <div class="country-name">Denmark</div>
	    </div>
      	    <div class="tel">
	      <span class="type">Phone</span> +45 7020 1220	    </div>
      	  </div>
	</div>
  
</div>
</div>
<div class="panel-region-separator"></div><div class="ding-box-pane"><div class="panel-pane pane-library_hours  ">
<h3>&Aring;bningstider</h3>
<div class="office-hours-week node-1 oh-processed">
  <div class="week-info"><a href="#" class="prev">←</a>
    <strong>
      <span class="week-num">Week 10</span> &ndash; 
      <span class="from-date">07/03</span> &ndash;
      <span class="to-date">13/03</span>
    </strong>
  <a href="#" class="next">→</a></div>
<div class="even clear-block">
<span class="day">Monday</span>
<span class="hours">
 <span class="start">08:00</span>
 &ndash; <span class="end">16:00</span>
</span>
</div><div class="odd clear-block">
<span class="day">Tuesday</span>
<span class="hours">
 <span class="start">09:00</span>
 &ndash; <span class="end">17:00</span>
</span>
</div><div class="even clear-block">
<span class="day">Wednesday</span>
 <span class="hours closed">closed</span>
</div><div class="odd clear-block">
<span class="day">Thursday</span>
<span class="hours">
 <span class="start">10:00</span>
 &ndash; <span class="end">14:00</span>
</span>
</div><div class="even clear-block">
<span class="day">Friday</span>
<span class="hours">
 <span class="start">09:00</span>
 &ndash; <span class="end">17:00</span>
</span>
</div><div class="odd clear-block">
<span class="day">Saturday</span>
<span class="hours">
 <span class="start">08:00</span>
 &ndash; <span class="end">16:00</span>
</span>
</div><div class="even clear-block">
<span class="day">Sunday</span>
 <span class="hours closed">closed</span>
</div></div>

</div>
</div>
<!--?php print $content['right']; ?-->	
	</div>
	
</div>

<!--/panels-threecol-left-stacked.tpl.php-->

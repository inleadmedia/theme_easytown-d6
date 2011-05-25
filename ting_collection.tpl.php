<?php
// $Id$
/**
 * @file ting_object.tpl.php
 *
 * Template to render a collection objects from the Ting database.
 *
 * Available variables:
 * - $collection: The TingClientObjectCollection instance we're rendering.
 * - $sorted_collection: Array of TingClientObject instances sorted by type.
 */
?>
<!--ting-collection-->
<div id="ting-collection">
  <div class="content-left">
    <div>
      <div>
        <div class="ting-overview clearfix">
          <div class="top-column">
              <h2>
              <?php
                $creators = array();
                foreach ($collection->creators as $i => $creator) {
                  $creators[] = l($creator, 'search/ting/' . $creator, array('attributes' => array('class' => 'author')));
                }
                print implode(', ', $creators);
                  print("&nbsp;:&nbsp;");
                  print check_plain($collection->title);
              ?>
              <span class='date'>(<?php print $collection->date; ?>)</span> 
              </h2>
              <p><?php print check_plain($collection->abstract); ?></p>
              <div class='terms'>
                <span class='title'><?php echo t('Terms:'); ?></span>
                <?php
                  $subjects = array();
                  foreach ($collection->subjects as $subject) {
                    $subjects[] = "<span class='term'>". l($subject, 'search/ting/'. $subject) ."</span>";
                  }
                  print implode(', ', $subjects);
                ?>
              </div>
            </div>

            <?php  if (count($sorted_collection) > 1) { ?>
              <div class='material-links'>
                <span class='title'><?php echo t('Go to material:'); ?></span>
                <?php
                  foreach ($sorted_collection as $type => $objects) {
                    $material_links[] = '<span class="link"><a href="#'.$type.'">'.t($type).'</a></span>';
                  }
                  print implode(", ", $material_links);
                ?>
              </div>
            <?php } ?>
          </div>

          <?php
 				foreach ($sorted_collection as $type => $objects) {		
          if(count($sorted_collection) > 1){ 
					  print '<h2>'.$type.'<a name="'.$type.'"></a></h2>';
 					}

					foreach ($objects as $tingClientObject) {
				    // now display all the materials
								?>

				<div id="ting-item-<?php print $tingClientObject->localId; ?>" class="ting-item clearfix">

          <div class="content clearfix">
  		  		<div class="picture">
  						<?php $image_url = ting_covers_object_url($tingClientObject, '80_x'); ?>
  						<?php if ($image_url) { ?>
  							<?php print theme('image', $image_url, '', '', null, false); ?>
  						<?php } ?>
  					</div>

  				  <div class="info"> 
  						<h3><?php print l($tingClientObject->title, $tingClientObject->url, array('attributes' => array('class' => 'alternative'))); ?> (<?php print $tingClientObject->record['dc:date'][''][0]; ?>)</h3>
  						
  						<?php if ($tingClientObject->language); { ?><div class='language'><?php echo t('Language') . ': ' . $tingClientObject->language; ?></div><?php } ?>
  						<?php if ($tingClientObject->record['dc:publisher'][''][0]); { ?><div class='language'><?php echo t('Publisher') . ': ' . $tingClientObject->record['dc:publisher'][''][0]; ?></div><?php } ?>
  						<?php if ($tingClientObject->record['dkdcplus:version'][''][0]); { ?><div class='language'><?php echo t('Version') . ': ' . $tingClientObject->record['dkdcplus:version'][''][0]; ?></div><?php } ?>
  						<?php if ($tingClientObject->record['dcterms:extent'][''][0]); { ?><div class='language'><?php echo $tingClientObject->record['dcterms:extent'][''][0]; ?></div><?php } ?>
  						<?php if ($tingClientObject->record['dc:subject']['dkdcplus:DK5-Text'][0]); { ?><div class='language'><?php echo t('DK5') . ': ' . $tingClientObject->record['dc:subject']['dkdcplus:DK5-Text'][0]; ?></div><?php } ?>
  						<?php
  						for ($i = 1; $i < count($tingClientObject->creators); $i++) {
  							if($extradesc = $tingClientObject->creators[$i]) { print "<p>".$extradesc."</p>"; }
  						}
  						?>

  						<div class="more">
                <?php print l(t('More information'), $tingClientObject->url, array('attributes' => array('class' => 'more-link')) ); ?>
  						</div>
              <?php if ($tingClientObject->type != 'Netdokument') { ?>
                <div class="alma-status waiting">Afventer data…</div>
              <?php } ?>
  					</div>

          </div>

					<div class="cart">
            <?php print theme('alma_cart_reservation_buttons', $tingClientObject); ?>
					</div>

				</div>

				<?php 
					} // foreach objects
				} //foreach collection
				?>

        <?php
        $referenced_nodes = ting_reference_nodes($collection);
        if ($referenced_nodes) {
              print '<h2>Omtale på websitet</h2>';
          foreach ($referenced_nodes as $node) {
            print node_view($node, TRUE);
          }
        }
        ?>

        </div>
      </div>	
    </div>
  </div>
</div>

<!--/ting-collection-->
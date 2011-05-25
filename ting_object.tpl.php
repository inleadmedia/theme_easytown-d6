<?php
// $Id$
/**
 * @file ting_object.tpl.php
 *
 * Template to render objects from the Ting database.
 *
 * Available variables:
 * - $object: The TingClientObject instance we're rendering.
 */
?>
<!-- ting_object.tpl -->
<div id="ting-object">
  <div class="content-left">
    <div>
        <div id="ting-item-<?php print $object->localId; ?>" class="ting-item ting-item-full dp-ting-object dp-object-<?=$object->localId;?>">
          <div class="ting-overview clearfix">
            <div class="top-column">
              <h2>
                <?php
                  $creators = array();
                  foreach ($object->creators as $i => $creator) {
                    $creators[] = l($creator, 'search/ting/' . $creator, array('attributes' => array('class' => 'author')));
                  }
                  print implode(', ', $creators);
                  print("&nbsp;:&nbsp;");
                  print check_plain($object->record['dc:title'][''][0]);
                  ?>
              </h2>
              <?php
                $titles = array();
                foreach (array_diff_key($object->record['dc:title'], array('' => 1)) as $type => $dc_title) {
                  $titles = array_merge($titles, $dc_title);
                }
              ?>
              <?php if (!empty($titles) && is_array($titles)) { ?>
                <h2><?php print check_plain(implode(', ', $titles)); ?></h2>
              <?php } ?>
              <?php if (!empty($object->record['dcterms:alternative'][''])) { ?>
                <?php foreach ($object->record['dcterms:alternative'][''] as $title) { ?>
                  <h2>(<?php print check_plain($title); ?>)</h2>
                <?php } ?>
              <?php } ?>
            </div>
    
            <div class="left-column left">
              <div class="picture">
                <?php $image_url = ting_covers_object_url($object, '180_x'); ?>
                <?php if ($image_url) { ?>
                  <?php print theme('image', $image_url, '', '', null, false); ?>
                <?php } ?>
              </div>
              <div class="left-column left">
                <?php print theme('alma_cart_reservation_buttons', $object); ?>
              </div>
            </div>

            <div>
              <p><?php print check_plain($object->record['dcterms:abstract'][''][0]); ?></p>
           
              <div class="left"> 
              <div class="object-information left">
                <?php 
                  //we printed the first part up above so remove that 
                  unset($object->record['dcterms:abstract'][''][0]);
                ?>
                <?php if (!empty($object->record['dcterms:abstract'][''])) { ?>
                  <div class="abstract"><?php print implode(' ; ', format_danmarc2((array)$object->record['dcterms:abstract'][''])) ?></div>
                <?php } ?>
                <?php
                  $creators = array();
                  foreach ($object->creators as $i => $creator) {
                    $creators[] = l($creator, 'search/ting/' . $creator, array('attributes' => array('class' => 'author')));
                  }
                  $niceCreators[] = implode(', ', $creators);
                  print theme('item_list', $niceCreators, t('Creator'), 'span', array('class' => 'author'));
                ?>
                <?php print theme('item_list', array($object->type), t('Type'), 'span', array('class' => 'type')); ?>
                <?php if (!empty($object->record['dc:format'][''])) { ?>
                  <?php print theme('item_list', $object->record['dc:format'][''], t('Format'), 'span', array('class' => 'format'));?>
                <?php } ?>
                <?php if (!empty($object->record['dcterms:isPartOf'][''])) { ?>
                  <?php print theme('item_list', $object->record['dcterms:isPartOf'][''], t('Available in'), 'span', array('class' => 'is-part-of'));?>
                <?php } ?>


                <?php if (!empty($object->language)) { ?>
                  <?php print theme('item_list', array($object->language), t('Language'), 'span', array('class' => 'language'));?>
                <?php } ?>
                <?php if (!empty($object->record['dc:language']['oss:spoken'])) { ?>
                  <?php print theme('item_list', $object->record['dc:language']['oss:spoken'], t('Speech'), 'span', array('class' => 'language'));?>
                <?php } ?>
                <?php if (!empty($object->record['dc:language']['oss:subtitles'])) { ?>
                  <?php print theme('item_list', $object->record['dc:language']['oss:subtitles'], t('Subtitles'), 'span', array('class' => 'language'));?>
                <?php } ?>

                <?php if (!empty($object->record['dc:subject']['oss:genre'])) { ?>
                  <?php print theme('item_list', $object->record['dc:subject']['oss:genre'], t('Genre'), 'span', array('class' => 'subject'));?>
                <?php } ?>
                <?php if (!empty($object->subjects) || !empty($object->record['dcterms:spatial']['dkdcplus:DBCS']) || !empty($object->record['dcterms:temporal']['dkdcplus:DBCP'])) { ?>
                  <div class="item-list">
                    <span class="title"><?php echo t('Subjects'); ?></span>
                    <span class="item-list">
                      <?php 
                        $list = array_merge(is_array($object->subjects) ? $object->subjects : array(), is_array($object->record['dcterms:spatial']['dkdcplus:DBCS']) ? $object->record['dcterms:spatial']['dkdcplus:DBCS']: array(), is_array($object->record['dcterms:temporal']['dkdcplus:DBCP']) ? $object->record['dcterms:temporal']['dkdcplus:DBCP'] :array());
                      ?>
                      <?php echo implode(', ', $list); ?>
                    </span>
                  </div>
                <?php } ?>
                <?php if (!empty($object->record['dc:subject']['dkdcplus:DK5'])) { ?>
                  <?php print theme('item_list', $object->record['dc:subject']['dkdcplus:DK5'], t('Classification'), 'span', array('class' => 'subject'));?>
                <?php } ?>
                <?php if (!empty($object->record['dcterms:spatial'][''])) { ?>
                  <?php print theme('item_list', $object->record['dcterms:spatial'][''], NULL, 'span', array('class' => 'spatial')); ?>
                <?php } ?>

                <?php if (!empty($object->record['dc:contributor']['oss:dkind'])) { ?>
                  <?php print theme('item_list', $object->record['dc:contributor']['oss:dkind'], t('Reader'), 'span', array('class' => 'contributor'));?>
                <?php } ?>
                <?php if (!empty($object->record['dc:contributor']['oss:act'])) { ?>
                  <?php print theme('item_list', $object->record['dc:contributor']['oss:act'], t('Actor'), 'span', array('class' => 'contributor'));?>
                <?php } ?>
                <?php if (!empty($object->record['dc:contributor']['oss:mus'])) { ?>
                  <?php print theme('item_list', $object->record['dc:contributor']['oss:mus'], t('Musician'), 'span', array('class' => 'contributor'));?>
                <?php } ?>

                <?php if (!empty($object->record['dcterms:hasPart']['oss:track'])) { ?>
                  <?php print theme('item_list', $object->record['dcterms:hasPart']['oss:track'], t('Contains'), 'span', array('class' => 'contains'));?>
                <?php } ?>

                <?php if (!empty($object->record['dcterms:isReferencedBy'][''])) { ?>
                  <?php print theme('item_list', $object->record['dcterms:isReferencedBy'][''], t('Referenced by'), 'span', array('class' => 'referenced-by'));?>
                <?php } ?>


                <?php if (!empty($object->record['dc:description'])) { ?>
                  <?php foreach ($object->record['dc:description'] as $type => $dc_description) { ?>
                    <?php print theme('item_list', $dc_description, t('Description'), 'span', array('class' => 'description'));?>
                  <?php } ?>
                <?php } ?>

                <?php if (!empty($object->record['dc:source'][''])) { ?>
                  <?php print theme('item_list', $object->record['dc:source'][''], t('Original title'), 'span', array('class' => 'titles'));?>
                <?php } ?>
                <?php if (!empty($object->record['dcterms:replaces'][''])) { ?>
                  <?php print theme('item_list', $object->record['dcterms:replaces'][''], t('Previous title'), 'span', array('class' => 'titles'));?>
                <?php } ?>
                <?php if (!empty($object->record['dcterms:isReplacedBy'][''])) { ?>
                  <?php print theme('item_list', $object->record['dcterms:isReplacedBy'][''], t('Later title'), 'span', array('class' => 'titles'));?>
                <?php } ?>

                <?php if (!empty($object->record['dc:identifier']['dkdcplus:ISBN'])) { ?>
                  <?php print theme('item_list', $object->record['dc:identifier']['dkdcplus:ISBN'], t('ISBN no.'), 'span', array('class' => 'identifier'));?>
                <?php } ?>

                <?php
                  if (!empty($object->record['dc:identifier']['dcterms:URI'])) {
                    $uris = array();
                    foreach ($object->record['dc:identifier']['dcterms:URI'] as $uri) {
                      $uris[] = l($uri, $uri);
                    }
                    print theme('item_list', $uris, t('Host publication'), 'span', array('class' => 'identifier'));                
                  }
                ?>


                <?php if (!empty($object->record['dkdcplus:version'][''])) { ?>
                  <?php print theme('item_list', $object->record['dkdcplus:version'][''], t('Version'), 'span', array('class' => 'version'));?>
                <?php } ?>



                <?php if (!empty($object->record['dcterms:extent'][''])) { ?>
                  <?php print theme('item_list', $object->record['dcterms:extent'][''], t('Extent'), 'span', array('class' => 'version'));?>
                <?php } ?>
                <?php if (!empty($object->record['dc:publisher'][''])) { ?>
                  <?php print theme('item_list', $object->record['dc:publisher'][''], t('Publisher'), 'span', array('class' => 'publisher'));?>
                <?php if (!empty($object->date)) { ?>
                  <?php print theme('item_list', $object->record['dc:date'][''], t('Publishing date'), 'span', array('class' => 'date'));?>
                <?php } ?>
                <?php } ?>
                <?php if (!empty($object->record['dc:rights'][''])) { ?>
                  <?php print theme('item_list', $object->record['dc:rights'][''], t('Rights'), 'span', array('class' => 'rights'));?>
                <?php } ?>
                
                <!-- Social services -->
                <?php // Do not send an empty string! in the second arg ?>
                <?php print theme('item_list', ' ', t('Rating'), 'span', array('class' => 'dp-rating'));?>
              </div>
              </div>
            </div>
   
            <div class="clearfix"></div>

            <div class="left-column left">
              <?php print theme('alma_cart_reservation_buttons', $object); ?>
            </div>
<!--
            <div class="right-column left">
              <?php if ($object->type[0] != 'Netdokument') { ?>
                  <ul class="library-list">
                    <li class="alma-status waiting even"><?php print t('waiting for data'); ?></li>
                  </ul>
              <?php } ?>
            </div>
            <div class="clearfix"></div>
            <hr />

            <h2>Kommentare</h2>
            <ul class="dp-comments">
              <li>
                <div class="info">
                  <div class="dp-name">Henrik K Jørgensen</div>
                  <div class="dp-date">28. dec 2010</div>
                </div>
                <div class="comment dp-body">
                  Verdens bedste og mest søgte bog                
                </div>
                <div class="clearfix"></div>
              </li>

              <li>
                <div class="info">
                  <div class="dp-name">Henrik K Jørgensen</div>
                  <div class="dp-date">28. dec 2010</div>
                </div>
                <div class="comment dp-body">
                  Verdens bedste og mest søgte bog                
                </div>
                <div class="clearfix"></div>
              </li>

              <li>
                <div class="info">
                  <div class="dp-name">Henrik K Jørgensen</div>
                  <div class="dp-date">28. dec 2010</div>
                </div>
                <div class="comment">
                  <div class="dp-body">
                    Verdens bedste og mest søgte bog                
                  </div>
                </div>
                <div class="clearfix"></div>
              </li>
            </ul>

            <hr />
            <h2>Ikke ledig?</h2>
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />

            <hr />

            <h2>Kommentarer</h2>

            <br />
            <br />
            <br />
            <br />
            <br />
            <br />

            <hr />

            <h2>Hvad synes du?</h2>

            <br />
            <br />
            <br />
            <br />
            <br />
            <br />

            <hr />
-->            
            <?php
            $collection = ting_get_collection_by_id($object->id);
            if ($collection instanceof TingClientObjectCollection && is_array($collection->types)) {
              // Do we have more than only this one type?
              if (count($collection->types) > 1) {
                print '<h2>'. t('Also available as: ') . '</h2>';  
                print "<ul>";
                foreach ($collection->types as $type) {
                  if ($type != $object->type) {
                    $material_links[] = '<li class="category">' . l($type, $collection->url, array('fragment' => $type)). '</li>';
                  }
                }
                print implode(' ', $material_links);
                print "</ul>";
              }
            }
            ?>

            <?php
            $referenced_nodes = ting_reference_nodes($object);
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
</div>


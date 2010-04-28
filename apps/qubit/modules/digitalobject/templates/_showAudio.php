<?php if (QubitTerm::REFERENCE_ID == $usageType): ?>

  <?php if ($showFlashPlayer): ?>
    <a class="flowplayer audio" href="<?php echo public_path($representation->getFullPath()) ?>"></a>
  <?php else: ?>
    <div style="text-align: center">
      <?php echo image_tag($representation->getFullPath(), array('style' => 'border: #999 1px solid')) ?>
    </div>
  <?php endif;?>

  <?php if ($link != null && QubitAcl::check($digitalObject->informationObject, 'readMaster')): ?>
    <?php echo link_to(__('Download audio'), $link) ?>
  <?php endif; ?>

<?php elseif (QubitTerm::THUMBNAIL_ID == $usageType): ?>

  <?php if ($iconOnly): ?>
    <?php echo link_to(image_tag('play.png'), $link); ?>
  <?php else: ?>
    <div class="digitalObject">
      <div class="digitalObjectRep">
        <?php echo link_to(image_tag('play.png'), $link); ?>
      </div>
      <div class="digitalObjectDesc">
        <?php echo string_wrap($digitalObject->getName(), 18); ?>
      </div>
    </div>
  <?php endif; ?>

<?php endif; ?>

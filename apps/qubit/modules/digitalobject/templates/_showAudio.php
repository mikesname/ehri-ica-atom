<?php if ($usageType == QubitTerm::MASTER_ID || $usageType == QubitTerm::REFERENCE_ID): ?>
  <a class="flowplayer audio" href="<?php echo $link ?>"></a>
  <?php echo link_to(__('Download audio'), $link) ?>
<?php elseif ($usageType == QubitTerm::THUMBNAIL_ID): ?>
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

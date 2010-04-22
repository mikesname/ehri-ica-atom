<?php if ($usageType == QubitTerm::MASTER_ID): ?>
  <?php if ($link == null): ?>
  <?php echo image_tag($representation->getFullPath()); ?>
  <?php else: ?>
  <?php echo link_to(image_tag($representation->getFullPath()), $link); ?>
  <?php endif; ?>
<?php elseif ($usageType == QubitTerm::REFERENCE_ID): ?>
  <?php if ($showFlashPlayer): ?>
    <a class="flowplayer" href="<?php echo public_path($representation->getFullPath()) ?>"></a>
  <?php else: ?>
    <div style="text-align: center">
      <?php echo image_tag($representation->getFullPath(), array('style' => 'border: #999 1px solid')) ?>
    </div>
  <?php endif;?>

  <!-- link to download master -->
  <?php if ($link != null): ?>
  <?php echo link_to(__('Download movie'),$link) ?>
  <?php endif; ?>
<?php elseif ($usageType == QubitTerm::THUMBNAIL_ID): ?>
  <?php if ($iconOnly): ?>
    <?php if ($link == null): ?>
      <?php echo image_tag($representation->getFullPath()); ?>
    <?php else: ?>
      <?php echo link_to(image_tag($representation->getFullPath()), $link); ?>
    <?php endif; ?>
  <?php else: ?>
  <div class="digitalObject">
    <div class="digitalObjectRep">
      <?php if ($link == null): ?>
      <?php echo image_tag($representation->getFullPath()); ?>
      <?php else: ?>
      <?php echo link_to(image_tag($representation->getFullPath()), $link); ?>
      <?php endif; ?>
    </div>
    <div class="digitalObjectDesc">
      <?php echo string_wrap($digitalObject->getName(), 18); ?>
    </div>
  </div>
  <?php endif; ?>
<?php endif; ?>

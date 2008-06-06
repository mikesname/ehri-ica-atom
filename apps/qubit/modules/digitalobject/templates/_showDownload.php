<?php if ($iconOnly): ?>
  <?php echo link_to(image_tag($representation->getFullPath()), $link);?>
<?php else: ?>
  <div style="width: 100px; text-align: center" />
    <?php if ($link !== null): ?>
    <?php echo link_to(image_tag($representation->getFullPath()), $link);?>
    <?php else: ?>
    <?php echo image_tag($representation->getFullPath()); ?>
    <?php endif; ?><br />
    <?php echo string_wrap($digitalObject->getName(), 15); ?>
  </div>
<?php endif; ?>
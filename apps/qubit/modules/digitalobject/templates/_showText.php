<?php if ($link == null): ?>
<?php echo image_tag($representation->getFullPath()); ?>
<?php else: ?>
<?php echo link_to(image_tag($representation->getFullPath()), $link); ?>
<?php endif; ?>
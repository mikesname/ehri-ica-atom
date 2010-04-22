<div class="section" id="userMenu">

  <h2 class="element-invisible"><?php echo __('User menu') ?></h2>

  <div class="content">
    <ul class="clearfix links">
      <?php foreach ($menu->getChildren() as $child): ?>
        <?php if (($sf_user->isAuthenticated()
            && 'log in' != $child->getName())
          || (!$sf_user->isAuthenticated()
            && 'logout' != $child->getName()
            && 'my profile' != $child->getName())): ?>
          <li<?php if ($child->isSelected()): ?> class="active"<?php endif; ?>><?php echo link_to($child->getLabel(array('cultureFallback' => true)), $child->getPath(array('getUrl' => true, 'resolveAlias' => true))) ?></li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>
  </div>

</div>

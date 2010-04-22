<div class="page">

  <h1><?php echo render_title($staticPage->getTitle(array('cultureFallback' => true))) ?></h1>

  <p>
    <?php echo render_value($staticPage->getContent(array('cultureFallback' => true))) ?>
  </p>

  <?php if (SecurityCheck::HasPermission($sf_user, array('module' => 'staticpage', 'action' => 'update'))): ?>
    <div class="actions section">

      <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

      <div class="content">
        <ul class="links">
          <li><?php echo link_to(__('Edit'), array($staticPage, 'module' => 'staticpage', 'action' => 'edit'), array('title' => __('Edit this page'))) ?></li>
        </ul>
      </div>

    </div>
  <?php endif; ?>

</div>

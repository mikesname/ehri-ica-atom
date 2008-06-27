<div class="pageTitle"></div>

<h1 id="first"><?php echo $sf_data->getRaw('staticPage')->getTitle(array('cultureFallback' => true)) ?></h1><br/>

<div class="staticPageContent">
  <?php echo nl2br($sf_data->getRaw('staticPage')->getContent(array('cultureFallback' => true))) ?>
</div>

<?php if (SecurityCheck::HasPermission($sf_user, array('module' => 'staticpage', 'action' => 'update'))): ?>
  <div class="editLink"><?php echo link_to(__('edit this page'), 'staticpage/edit/?id='.$staticPage->getId()) ?></div>
<?php endif; ?>

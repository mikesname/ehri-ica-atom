<div class="pageTitle"></div>

<?php if (null === $title = $sf_data->getRaw('staticPage')->getTitle()) $title = $sf_data->getRaw('staticPage')->getTitle(array('sourceCulture' => true)); ?>

<h1 id="first"><?php echo $title; ?></h1><br/>

<div class="staticPageContent">
  <?php if (null === $content = $sf_data->getRaw('staticPage')->getContent()) $content = $sf_data->getRaw('staticPage')->getContent(array('sourceCulture' => true)); echo nl2br($content) ?>
</div>

<?php if (SecurityCheck::HasPermission($sf_user, array('module' => 'staticpage', 'action' => 'update'))): ?>
  <div class="editLink"><?php echo link_to(__('edit this page'), 'staticpage/edit/?id='.$staticPage->getId()) ?></div>
<?php endif; ?>

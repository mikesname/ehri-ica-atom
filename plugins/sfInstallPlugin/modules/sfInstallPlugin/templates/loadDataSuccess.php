<h2>Loading data</h2>

<?php sfInstall::insertSql() ?>

<?php sfInstall::loadRoot() ?>

<?php sfInstall::loadData() ?>

<!-- If JavaScript is enabled, automatically redirect to the next task.  Include a link in case it is not. -->
<ul>
  <li><?php echo link_to('Continue', array('module' => 'sfInstallPlugin', 'action' => 'configureSite')) ?></li>
</ul>
<?php if (!$error) $sf_context->getController()->redirect(array('module' => 'sfInstallPlugin', 'action' => 'configureSite')) ?>

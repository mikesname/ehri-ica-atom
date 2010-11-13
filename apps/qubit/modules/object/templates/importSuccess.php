<h1><?php echo __('Import completed') ?></h1>

<div class="note">
  <?php echo __('Elapsed time: %1% seconds.', array('%1%' => $timer->elapsed())) ?>
</div>

<?php if ($import->hasErrors()): ?>
  <div class="messages error">
    <h3>Warnings were encountered:</h3>
    <?php foreach ($import->getErrors() as $error): ?>
      <div>
        <?php echo $error ?>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<div class="actions section">

  <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

  <div class="content">
    <ul class="clearfix links">
    <?php if (!($import->getRootObject() instanceof QubitTaxonomy)): ?>
      <?php echo link_to(__('View %1%', array('%1%' => sfConfig::get('app_ui_label_'.strtolower($objectType)))), array($import->getRootObject(), 'module' => strtolower($objectType))) ?>
    <?php else: ?>
      <?php echo link_to(__('View %1%', array('%1%' => sfConfig::get('app_ui_label_'.strtolower($objectType)))), array($import->getRootObject(), 'module' => 'taxonomy')) ?>
    <?php endif; ?>
    </ul>
  </div>

</div>

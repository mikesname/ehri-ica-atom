<h1 style="text-align: left; margin-top: 30px;"><?php echo __('Import completed') ?></h1>

<div style="clear:both; margin-bottom: 20px;">
  <span class="note"><?php echo __('elapsed time: %1% seconds.', array('%1%' => $timer->elapsed())) ?></span>
</div>

<?php if ($import->hasErrors()): ?>
  <h3>Warnings were encountered:</h3>
    <?php foreach ($import->getErrors() as $error): ?>
      <p class="form_error"><?php echo $error ?></p>
    <?php endforeach; ?><br />
<?php endif; ?>

<div class="menu-action">
  <?php echo link_to (__('view %1%', array('%1%' => sfConfig::get('app_ui_label_'.strtolower($objectType)))), strtolower($objectType).'/show?id='.$import->getRootObject()->getId()) ?>
</div>

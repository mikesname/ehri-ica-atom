<h1><?php echo __('Edit %1%', array('%1%' => sfConfig::get('app_ui_label_physicalobject'))) ?></h1>

<h1 class="label"><?php echo render_title($physicalObject) ?></h1>

<?php echo $form->renderGlobalErrors() ?>

<?php if (isset($sf_request->id)): ?>
  <?php echo $form->renderFormTag(url_for(array($physicalObject, 'module' => 'physicalobject', 'action' => 'edit'))) ?>
<?php else: ?>
  <?php echo $form->renderFormTag(url_for(array('module' => 'physicalobject', 'action' => 'create'))) ?>
<?php endif; ?>

  <?php echo $form->renderHiddenFields() ?>

  <?php echo render_field($form->name, $physicalObject) ?>

  <?php echo render_field($form->location, $physicalObject) ?>

  <?php echo $form->type->renderRow() ?>

  <div class="actions section">

    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

    <div class="content">
      <ul class="clearfix links">

        <?php if (null !== $next = $form->getValue('next')): ?>
          <li><?php echo link_to(__('Cancel'), $next) ?></li>
        <?php else: ?>
          <li><?php echo link_to(__('Cancel'), array($physicalObject, 'module' => 'physicalobject')) ?></li>
        <?php endif; ?>

        <li><?php echo submit_tag(__('Save')) ?></li>

      </ul>
    </div>

  </div>

</form>

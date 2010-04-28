<h1><?php echo __('Add/edit static page') ?></h1>

<h1 class="label"><?php echo render_title($staticPage) ?></h1>

<?php if (isset($sf_request->id)): ?>
  <?php echo $form->renderFormTag(url_for(array($staticPage, 'module' => 'staticpage', 'action' => 'edit'))) ?>
<?php else: ?>
  <?php echo $form->renderFormTag(url_for(array('module' => 'staticpage', 'action' => 'create'))) ?>
<?php endif; ?>

  <?php echo $form->renderHiddenFields() ?>

  <?php echo $form->title->renderRow() ?>

  <?php echo $form->permalink->renderRow() ?>

  <?php echo render_field($form->content, $staticPage, array('class' => 'resizable')) ?>

  <div class="actions section">

    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

    <div class="content">
      <ul class="clearfix links">
        <li><?php echo link_to(__('Cancel'), array('module' => 'staticpage', 'action' => 'list')) ?></li>
        <?php if (isset($sf_request->id)): ?>
          <li><?php echo submit_tag(__('Save')) ?></li>
        <?php else: ?>
          <li><?php echo submit_tag(__('Create')) ?></li>
        <?php endif; ?>
      </ul>
    </div>

  </div>

</form>

<h1><?php echo __('Reports') ?></h1>

<h1 class="label"><?php echo $resource->__toString() ?></h1>

<?php echo $form->renderGlobalErrors() ?>

<?php echo $form->renderFormTag(url_for(array($resource, 'module' => 'informationobject', 'action' => 'reports'))) ?>

<div class="section">

<?php echo render_show(__('Select report'), $form->report) ?>

</div>

<div class="actions section">

  <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

  <div class="content">
    <ul class="clearfix links">
      <li><input class="form-submit" type="submit" value="<?php echo __('Continue') ?>"/></li>
      <li><?php echo link_to(__('Cancel'), array($resource, 'module' => 'informationobject')) ?></li>
    </ul>
  </div>

</div>

</form>

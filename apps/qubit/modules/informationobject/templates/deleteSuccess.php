<h1><?php echo __('Are you sure you want to delete %1%?', array('%1%' => render_title($informationObject))) ?></h1>

<?php if (0 < count($informationObject->descendants)): ?>
  <h2><?php echo __('It has %1% descendants that will also be deleted:', array('%1%' => count($informationObject->descendants))) ?></h2>
  <ul>
    <?php foreach ($informationObject->descendants as $descendant): ?>
      <li><?php echo link_to(render_title($descendant), array($descendant, 'module' => 'informationobject')) ?></li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<?php echo $form->renderFormTag(url_for(array($informationObject, 'module' => 'informationobject', 'action' => 'delete')), array('method' => 'delete')) ?>

  <div class="actions section">
    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>
    <div class="content">
      <ul class="clearfix links">
        <li><?php echo link_to(__('Cancel'), array($informationObject, 'module' => 'informationobject')) ?></li>
        <li><?php echo submit_tag(__('Confirm')) ?></li>
      </ul>
      </div>
  </div>

</form>

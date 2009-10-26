<h1><?php echo __('Are you sure you want to delete %1%?', array('%1%' => render_title($physicalObject))) ?></h1>

<?php if (0 < count($informationObjects)): ?>
  <ul>
    <?php foreach ($informationObjects as $informationObject): ?>
      <li><?php echo link_to(render_title($informationObject), array('module' => 'informationobject', 'action' => 'show', 'id' => $informationObject->id)) ?></li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<?php echo $form->renderFormTag(url_for(array('module' => 'physicalobject', 'action' => 'delete', 'id' => $physicalObject->id)), array('method' => 'delete')) ?>

  <?php echo $form->renderHiddenFields() ?>

  <ul class="actions">
    <li><?php echo link_to(__('Cancel'), array('module' => 'physicalobject', 'action' => 'edit', 'id' => $physicalObject->id)) ?></li>
    <li><?php echo submit_tag(__('Confirm')) ?></li>
  </ul>

</form>

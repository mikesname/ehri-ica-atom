<h1><?php echo __('Are you sure you want to delete %1%?', array('%1%' => render_title($informationObject))) ?></h1>

<?php if (0 < count($informationObject->descendants)): ?>
  <ul>
    <?php foreach ($informationObject->descendants as $descendant): ?>
      <li><?php echo link_to(render_title($descendant), array('module' => 'informationobject', 'action' => 'show', 'id' => $descendant->id)) ?></li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<?php echo $form->renderFormTag(url_for(array('module' => 'informationobject', 'action' => 'delete', 'id' => $informationObject->id)), array('method' => 'delete')) ?>

  <ul class="actions">
    <li><?php echo link_to(__('Cancel'), array('module' => 'informationobject', 'action' => 'show', 'id' => $informationObject->id)) ?></li>
    <li><?php echo submit_tag(__('Confirm')) ?></li>
  </ul>

</form>

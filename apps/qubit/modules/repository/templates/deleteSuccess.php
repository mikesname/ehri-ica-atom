<h1><?php echo __('Are you sure you want to delete %1%?', array('%1%' => render_title($repository))) ?></h1>

<?php echo $form->renderFormTag(url_for(array('module' => 'repository', 'action' => 'delete', 'id' => $repository->id)), array('method' => 'delete')) ?>

  <ul class="actions">
    <li><?php echo link_to(__('Cancel'), array('module' => 'repository', 'action' => 'show', 'id' => $repository->id)) ?></li>
    <li><?php echo submit_tag(__('Confirm')) ?></li>
  </ul>

</form>

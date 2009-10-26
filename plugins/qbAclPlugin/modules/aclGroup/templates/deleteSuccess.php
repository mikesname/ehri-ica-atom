<h1><?php echo __('Are you sure you want to delete %1%?', array('%1%' => render_title($group))) ?></h1>

<?php echo $form->renderFormTag(url_for(array('module' => 'aclGroup', 'action' => 'delete', 'id' => $group->id)), array('method' => 'delete')) ?>

  <ul class="actions">
    <li><?php echo link_to(__('Cancel'), array('module' => 'aclGroup', 'action' => 'edit', 'id' => $group->id)) ?></li>
    <li><?php echo submit_tag(__('Confirm')) ?></li>
  </ul>

</form>

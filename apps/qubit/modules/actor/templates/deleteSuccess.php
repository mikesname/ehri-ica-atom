<h1><?php echo __('Are you sure you want to delete %1%?', array('%1%' => render_title($actor))) ?></h1>

<?php echo $form->renderFormTag(url_for(array('module' => 'actor', 'action' => 'delete', 'id' => $actor->id)), array('method' => 'delete')) ?>

  <ul class="actions">
    <li><?php echo link_to(__('Cancel'), array('module' => 'actor', 'action' => 'show', 'id' => $actor->id)) ?></li>
    <li><?php echo submit_tag(__('Confirm')) ?></li>
  </ul>

</form>

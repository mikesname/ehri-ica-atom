<h1><?php echo __('Are you sure you want to delete this contact information from %1%?', array('%1%' => render_title($actor))) ?></h1>

<?php echo get_partial('repository/contactInformation', array('contactInformation' => $resource)) ?>

<?php echo $form->renderFormTag(url_for(array('module' => 'actor', 'action' => 'deleteContactInformation', 'contactInformationId' => $resource->id)), array('method' => 'delete')) ?>

  <div class="actions section">
  <h2 class="element-invisible"><?php echo __('Actions') ?></h2>
    <div class="content">
      <ul class="clearfix links">
        <li><?php echo link_to(__('Cancel'), array($actor, 'module' => 'repository', 'action' => 'edit')) ?></li>
        <li><input class="form-submit" type="submit" value="<?php echo __('Confirm') ?>"/></li>
      </ul>
    </div>
  </div>

</form>

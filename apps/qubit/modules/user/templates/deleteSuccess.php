<h1><?php echo __('Are you sure you want to delete user %1%?', array('%1%' => $resource->username)) ?></h1>

<?php echo $form->renderFormTag(url_for(array($resource, 'module' => 'user', 'action' => 'delete')), array('method' => 'delete')) ?>

  <div class="actions section">

    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

    <div class="content">
      <ul class="clearfix links">
        <li><?php echo link_to(__('Cancel'), array($resource, 'module' => 'user')) ?></li>
        <li><input class="form-submit" type="submit" value="<?php echo __('Confirm') ?>"/></li>
      </ul>
    </div>

  </div>

</form>

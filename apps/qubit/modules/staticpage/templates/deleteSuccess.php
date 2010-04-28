<h1><?php echo __('Are you sure you want to delete %1%?', array('%1%' => render_title($staticPage))) ?></h1>

<?php echo $form->renderFormTag(url_for(array($staticPage, 'module' => 'staticpage', 'action' => 'delete')), array('method' => 'delete')) ?>

  <div class="actions section">

    <h2 class="element-invisible"><?php echo __('Actions') ?></h2>

    <div class="content">
      <ul class="clearfix links">
        <li><?php echo link_to(__('Cancel'), array($staticPage, 'module' => 'staticpage')) ?></li>
        <li><?php echo submit_tag(__('Confirm')) ?></li>
      </ul>
    </div>

  </div>

</form>

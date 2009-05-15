<div class="options-list"><?php echo link_to('list', array('module' => 'sfPluginAdminPlugin')) ?><a class="active">configure</a></div>
<br />

<?php echo $form->renderFormTag(url_for(array('module' => 'sfThemePlugin')), array('style' => 'float: left;')) ?>
  <?php echo $form->renderGlobalErrors() ?>

  <fieldset>
    <legend><?php echo __('Default page elements') ?></legend>
    <div class="description">
      <p>
        <?php echo __('Enable or disable the display of certain page elements. Unless they have been overridden by a specific theme, these settings will be used site wide.') ?>
      </p>
    </div>
    <?php echo $form->toggleLogo->renderRow(null, 'Logo') ?>
    <?php echo $form->toggleTitle->renderRow(null, 'Title') ?>
    <?php echo $form->toggleDescription->renderRow(null, 'Description') ?>
  </fieldset>

  <?php echo submit_tag('Save settings') ?>
</form>
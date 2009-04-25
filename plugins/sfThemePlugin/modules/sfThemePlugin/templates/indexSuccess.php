<h2>Themes</h2>

<div class="help">
  <p>
    These options control the default display settings for your entire site, across all themes. Unless they have been overridden by a specific theme, these settings will be used.
  </p>
</div>

<?php echo $form->renderFormTag(url_for(array('module' => 'sfThemePlugin'))) ?>
  <?php echo $form->renderGlobalErrors() ?>

  <fieldset>
    <legend>Toggle display</legend>
    <div class="description">
      <p>
        Enable or disable the display of certain page elements.
      </p>
    </div>
    <?php echo $form->toggleLogo->renderRow(null, 'Logo') ?>
    <?php echo $form->toggleTitle->renderRow(null, 'Title') ?>
    <?php echo $form->toggleDescription->renderRow(null, 'Description') ?>
  </fieldset>

  <?php echo submit_tag('Save configuration') ?>
</form>

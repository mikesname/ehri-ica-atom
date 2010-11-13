<h1><?php echo __('Import an XML file') ?></h1>

<?php echo form_tag(array('module' => 'object', 'action' => 'import'), array('multipart' => 'true')) ?>

  <?php if ($sf_user->hasFlash('error')): ?>
  <div class="messages error">
    <h3><?php echo __('Error encountered') ?></h3>
    <div><?php echo $sf_user->getFlash('error') ?></div>
  </div>
  <?php endif; ?>

  <div class="form-item">
    <input name="file" type="file"/>
    <div class="description">
      <?php echo __('Select a file to import') ?>
    </div>
  </div>

  <input class="form-submit" type="submit" value="<?php echo __('Import') ?>"/>

</form>

<h2>Database configuration</h2>

<?php if (count($database) > 0): ?>
  <h3>The following errors must be resolved before you can continue the installation process:</h3>
  <div class="messages error">
    <ul>
      <?php foreach ($database as $e): ?>
        <li><?php echo $e->getMessage() ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<?php echo $form->renderFormTag(url_for(array('module' => 'sfInstallPlugin', 'action' => 'configureDatabase'))) ?>

  <fieldset>
    <legend>Basic options</legend>
    <div class="description">
      <p>
        To set up your database, enter the following information.
      </p>
    </div>
    <?php echo $form->databaseName->renderRow() ?>
    <?php echo $form->databaseUsername->renderRow() ?>
    <?php echo $form->databasePassword->renderRow() ?>
  </fieldset>

  <fieldset class="collapsible collapsed">
    <legend>Advanced options</legend>
    <div class="description">
      <p>
        These options are only necessary for some sites.  If you're not sure what you should enter here, leave the default settings or check with your hosting provider.
      </p>
    </div>
    <?php echo $form->databaseHost->renderRow() ?>
    <?php echo $form->databasePort->renderRow() ?>
    <?php echo $form->tablePrefix->renderRow() ?>
  </fieldset>

  <input class="form-submit" type="submit" value="Save and continue"/>
</form>

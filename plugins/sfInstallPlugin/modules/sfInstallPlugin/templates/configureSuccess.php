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

<p>
  <?php echo link_to('A database must exist on your server before '.sfConfig::get('app_name', 'Qubit').' can be installed.', 'http://qubit-toolkit.org/wiki/index.php?title=Installation#B._Create_your_MySQL_database') ?>
</p>

<form action="<?php echo url_for(array('module' => 'sfInstallPlugin', 'action' => 'configure')) ?>" method="post">
  <div class="description">
    <p>
      To set up your database, enter the following information.
    </p>
  </div>
  <?php echo $form ?>
  <input class="form-submit" type="submit" value="Save and continue"/>
</form>

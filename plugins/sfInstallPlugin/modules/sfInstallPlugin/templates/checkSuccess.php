<h2>System checks</h2>

<!-- FIXME: We currently do this logic in the template instead of the action to give the user more immediate feedback, but symfony apparently buffers output and does not start sending it to the user until it is finished being generated : ( -->
<!-- TODO: Considder using array keys for wiki anchors -->
<?php $error = false ?>

<?php $error |= count($dependencies = sfInstall::checkDependencies()) > 0 ?>
<?php if (isset($dependencies['php']['min'])): ?>
  <div class="messages error">
    <p>
      <?php echo link_to('Minimum PHP version', 'http://qubit-toolkit.org/wiki/index.php?title=Install#Minimum_PHP_version') ?>: <?php echo $dependencies['php']['min'] ?>
    </p>
    <p>
      Current version is <?php echo PHP_VERSION ?>
    </p>
  </div>
<?php endif; ?>
<?php if (isset($dependencies['extensions'])): ?>
  <?php foreach ($dependencies['extensions'] as $extension): ?>
    <div class="messages error">
      <p>
        <?php echo link_to($extension.' extension', 'http://qubit-toolkit.org/wiki/index.php?title=Install#'.$extension.'_extension') ?>
      </p>
    </div>
  <?php endforeach; ?>
<?php endif; ?>

<?php $error |= count($writablePaths = sfInstall::checkWritablePaths()) > 0 ?>
<?php if (count($writablePaths) > 0): ?>
  <div class="messages error">
    <p>
      <?php echo link_to('Writable paths', 'http://qubit-toolkit.org/wiki/index.php?title=Install#Writable_paths') ?>
    </p>
    <ul>
      <?php foreach ($writablePaths as $path): ?>
        <li><?php echo $path ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<?php $error |= count($databasesYml = sfInstall::checkDatabasesYml()) > 0 ?>
<?php if (isset($databasesYml['notWritable'])): ?>
  <div class="messages error">
    <p>
      <?php echo link_to('databases.yml not writable', 'http://qubit-toolkit.org/wiki/index.php?title=Install#databases.yml_not_writable') ?>
    </p>
  </div>
<?php endif; ?>

<?php $error |= count($propelIni = sfInstall::checkPropelIni()) > 0 ?>
<?php if (isset($propelIni['notWritable'])): ?>
  <div class="messages error">
    <p>
      <?php echo link_to('propel.ini not writable', 'http://qubit-toolkit.org/wiki/index.php?title=Install#propel.ini_not_writable') ?>
    </p>
  </div>
<?php endif; ?>

<!-- HACK: This checkSettingsYml() was meant to get called after checkHtaccess() but without settings.yml, sfInstallPlugin is disabled, breaking the checkHtaccess() callbacks : ( -->
<?php sfInstall::checkSettingsYml() ?>

<?php $error |= count($htaccess = sfInstall::checkHtaccess()) > 0 ?>
<?php if (isset($htaccess['notWritable'])): ?>
  <div class="messages error">
    <p>
      <?php echo link_to('.htaccess not writable', 'http://qubit-toolkit.org/wiki/index.php?title=Install#.htaccess_not_writable') ?>
    </p>
  </div>
<?php endif; ?>
<?php if (isset($htaccess['ignored'])): ?>
  <div class="messages error">
    <p>
      <?php echo link_to('.htaccess files are completely ignored', 'http://qubit-toolkit.org/wiki/index.php?title=Install#.htaccess_files_are_completely_ignored') ?>
    </p>
  </div>
<?php endif; ?>
<?php if (isset($htaccess['optionsNotAllowed'])): ?>
  <div class="messages error">
    <p>
      <?php echo link_to('Options not allowed in .htaccess files', 'http://qubit-toolkit.org/wiki/index.php?title=Install#Options_not_allowed_in_.htaccess_files') ?>
    </p>
  </div>
<?php endif; ?>
<?php if (isset($htaccess['modRewriteNotConfigured'])): ?>
  <div class="messages error">
    <p>
      <?php echo link_to('mod_rewrite not configured', 'http://qubit-toolkit.org/wiki/index.php?title=Install#mod_rewrite_not_configured') ?>
    </p>
  </div>
<?php endif; ?>

<?php $error |= count($settingsYml = sfInstall::checkSettingsYml(count($htaccess) > 0)) > 0 ?>
<?php if (isset($settingsYml['notWritable'])): ?>
  <div class="messages error">
    <p>
      <?php echo link_to('settings.yml not writable', 'http://qubit-toolkit.org/wiki/index.php?title=Install#settings.yml_not_writable') ?>
    </p>
  </div>
<?php endif; ?>

<?php $error |= count($searchIndex = sfInstall::checkSearchIndex()) > 0 ?>
<?php if (count($searchIndex) > 0): ?>
  <div class="messages error">
    <p>
      <?php echo link_to('Search index', 'http://qubit-toolkit.org/wiki/index.php?title=Install#Search_index') ?>
    </p>
    <ul>
      <?php foreach ($searchIndex as $e): ?>
        <li><?php echo $e->getMessage() ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<?php if ($error): ?>
  <?php echo link_to('Try again', $sf_request->getUri()) ?>
  <?php echo link_to('Ignore errors and continue', array('module' => 'sfInstallPlugin', 'action' => 'configure')) ?>
<?php else: ?>
  <!-- If JavaScript is enabled, automatically redirect to the next task.  Include a link in case it is not. -->
  <?php echo link_to('Continue', array('module' => 'sfInstallPlugin', 'action' => 'configure')) ?>
  <?php $sf_context->getController()->redirect(array('module' => 'sfInstallPlugin', 'action' => 'configure')) ?>
<?php endif; ?>

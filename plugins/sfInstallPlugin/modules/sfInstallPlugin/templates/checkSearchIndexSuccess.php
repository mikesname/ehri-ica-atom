<?php $error |= count($searchIndex = sfInstall::checkSearchIndex()) > 0 ?>
<?php if (count($searchIndex) > 0): ?>
  <div class="messages error">
    <p>
      <?php echo link_to('Search index', array('module' => 'sfInstallPlugin', 'action' => 'help'), array('anchor' => 'Search_index')) ?>
    </p>
    <ul>
      <?php foreach ($searchIndex as $e): ?>
        <li><?php echo $e->getMessage() ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

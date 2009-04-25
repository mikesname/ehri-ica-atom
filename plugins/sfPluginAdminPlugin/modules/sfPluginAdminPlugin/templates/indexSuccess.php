<?php echo $form->renderFormTag(url_for(array('module' => 'sfPluginAdminPlugin'))) ?>
  <?php echo $form->renderGlobalErrors() ?>
  <table class="sticky-enabled">
    <thead>
      <tr>
        <th>Enabled</th>
        <th>Name</th>
        <th>Version</th>
        <th>Summary</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($plugins as $name => $plugin): ?>
        <tr>
          <?php // TODO: Should redisplay tainted value ?>
          <td><?php echo checkbox_tag('enabled[]', $name, $form->isBound() && in_array($name, $form->getValue('enabled')) || !$form->isBound() && in_array($name, $form->getDefault('enabled'))) ?></td>
          <td><?php echo $name ?></td>
          <td><?php echo $plugin->version ?></td>
          <td><?php echo $plugin->summary ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php echo submit_tag() ?>
</form>

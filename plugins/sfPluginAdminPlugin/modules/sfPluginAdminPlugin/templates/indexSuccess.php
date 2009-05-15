<div class="options-list"><a class="active">list</a><?php echo link_to('configure', array('module' => 'sfThemePlugin')) ?></div>


<?php echo $form->renderFormTag(url_for(array('module' => 'sfPluginAdminPlugin'))) ?>
  <?php echo $form->renderGlobalErrors() ?>
  <table class="sticky-enabled">
    <thead>
      <tr>

        <th>
        </th>

        <th>
          Name
        </th>

        <th>
          Version
        </th>

        <th>
          Enabled
        </th>

      </tr>
    </thead>
    <tbody>
      <?php foreach ($plugins as $name => $plugin): ?>
        <tr>

          <td>
            <?php if (file_exists($plugin->getRootDir().'/web/images/image.png')): ?>
              <?php echo image_tag('/'.$name.'/images/image', array('alt' => $name)) ?>
            <?php else: ?>
              No image
            <?php endif; ?>
          </td>

          <td>
            <h2><?php echo $name ?></h2>
            <div class="description">
              <?php echo $plugin->summary ?>
            </div>
          </td>

          <td>
            <?php echo $plugin->version ?>
          </td>

          <?php // TODO: Should redisplay tainted value ?>
          <td align="center">
            <?php echo checkbox_tag('enabled[]', $name, $form->isBound() && in_array($name, $form->getValue('enabled')) || !$form->isBound() && in_array($name, $form->getDefault('enabled'))) ?>
          </td>

        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php echo submit_tag() ?>
</form>

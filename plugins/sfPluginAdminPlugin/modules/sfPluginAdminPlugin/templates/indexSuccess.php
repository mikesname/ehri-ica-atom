<h1><?php echo __('List plugins') ?></h1>

<?php echo $form->renderGlobalErrors() ?>

<?php echo $form->renderFormTag(url_for(array('module' => 'sfPluginAdminPlugin'))) ?>

  <table class="sticky-enabled">
    <thead>
      <tr>

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
    </thead><tbody>
      <?php foreach ($plugins as $name => $plugin): ?>
        <tr class="<?php echo 0 == ++$row % 2 ? 'even' : 'odd' ?>">

          <td>

            <?php if (file_exists($plugin->getRootDir().'/images/image.png')): ?>
              <?php echo image_tag('/plugins/'.$name.'/images/image', array('alt' => $name)) ?>
            <?php endif; ?>

            <h2><?php echo $name ?></h2>

            <div class="description">
              <?php $class = new ReflectionClass($plugin); echo $class->getStaticPropertyValue('summary') // HACK Use $plugin::$summary in PHP 5.3 http://php.net/oop5.late-static-bindings ?>
            </div>

          </td>

          <td>
            <?php echo $class->getStaticPropertyValue('version') // HACK Use $plugin::$version in PHP 5.3 ?>
          </td>

          <?php // TODO Should redisplay tainted value ?>
          <td align="center">
            <input<?php if ($form->isBound() && in_array($name, $form->getValue('enabled')) || !$form->isBound() && in_array($name, $form->getDefault('enabled'))): ?> checked="checked"<?php endif; ?> name="enabled[]" type="checkbox" value="<?php echo $name ?>"
          </td>

        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <input class="form-submit" type="submit" value="Save configuration"/>

</form>

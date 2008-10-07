<div class="pageTitle"><?php echo __('site settings'); ?></div>

<?php foreach ($settingsGroups as $scope => $settings): ?>
  <?php echo form_tag('settings/update') ?>
  <?php echo input_hidden_tag('fieldset', $scope) ?>

<div class="tableHeader" style="margin-bottom: 10px;"><?php echo ($scope ? $scope : 'global') ?></div>
<fieldset class="collapsible collapsed">
    <legend><?php echo ($scope ? $scope : 'global') ?></legend>
<table class="list">
  <thead>
    <tr>
      <th><?php echo __('name')?></th>
      <th><?php echo __('value')?></th>
      <th/>
    </tr>
  </thead>

  <tbody>
  <?php foreach ($settings as $setting): ?>
    <tr>
    <td>
    <?php if ($sf_user->getCulture() != $setting->getCulture() && $scope != 'i18n_languages'): ?>
      <div class="default-translation"><?php echo $setting->getName() ?></div>
    <?php else: ?>
      <?php echo $setting->getName() ?>
    <?php endif; ?>
    </td>
    <td>
    <?php if ($scope == 'i18n_languages'): ?>
      <?php echo format_language($setting->getName()) ?>
    <?php elseif ($setting->isEditable()): ?>
      <?php echo input_tag($setting->getId(), $setting->getValue()) ?>
    <?php else: ?>
      <?php echo $setting->getValue() ?>
    <?php endif; ?>
    </td>
  <td>
    <?php if ($setting->isDeleteable()): ?>
      <?php echo link_to(image_tag('delete', 'valign=top'), 'settings/delete?id='.$setting->getId(), array('post' => 'true', 'confirm' => __('are you sure?'))) ?>
    <?php endif; ?>
  </td>
    </tr>
  <?php endforeach; ?>
    <tr>
    <?php if ($scope == 'i18n_languages'): ?>
      <td colspan="2">
      <?php echo select_tag('language_code', options_for_select($sf_data->getRaw('availableLanguages'))) ?>
      </td>
      <td>
        <div style="float: right; margin: 3px 8px 0 0;">
          <?php echo my_submit_tag(__('add'), array('style' => 'width: auto;')) ?>
        </div>
      </td>
    <?php else: ?>
      <td></td>
      <td>
        <div style="float: right; margin: 3px 8px 0 0;">
          <?php echo my_submit_tag(__('save'), array('style' => 'width: auto;')) ?>
        </div>
      </td>
    <?php endif; ?>
    </tr>
  </tbody>
</table>
</fieldset>
</form>

<?php endforeach; ?>

<h1><?php echo __('Site settings'); ?></h1>

<!-- Global settings table -->
<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('Global') ?></div>
<fieldset class="collapsible collapsed">
  <legend><?php echo __('Global') ?></legend>
  <form action="<?php echo url_for('settings/list') ?>" method="POST">
  <table class="list">
  <thead>
    <tr>
      <th><?php echo __('Name')?></th>
      <th><?php echo __('Value')?></th>
    </tr>
  </thead>
  <tbody>
    <?php echo $globalForm ?>
    <tr>
      <td>&nbsp;</td>
      <td>
        <div style="float: right; margin: 3px 8px 0 0;">
          <?php echo submit_tag(__('Save')) ?>
        </div>
      </td>
    </tr>
  </tbody>
  </table>
  </form>
</fieldset>

<!-- Site information form -->
<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('Site information') ?></div>
<fieldset class="collapsible collapsed">
  <legend><?php echo __('Site information') ?></legend>
  <form action="<?php echo url_for('settings/list') ?>" method="POST">
  <table class="list">
  <thead>
    <tr>
      <th><?php echo __('Name')?></th>
      <th><?php echo __('Value')?></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?php echo $siteInformationForm['site_title']->renderLabel(null,
        array('title' => __('The name of the website for display in the header'))) ?></td>
      <td>
        <?php if (strlen($error = $siteInformationForm['site_title']->renderError())): ?>
          <?php echo $error ?>
        <?php elseif ($sourceCultureHelper = $siteTitle->getSourceCultureHelper($culture)): ?>
          <div class="default-translation"><?php echo $sourceCultureHelper ?></div>
        <?php endif; ?>
        <?php echo $siteInformationForm['site_title']->render() ?>
      </td>
    </tr>
    <tr>
      <td><?php echo $siteInformationForm['site_description']->renderLabel(null,
        array('title' => __('A brief site description or &quot;tagline&quot; for the header'))) ?></td>
      <td>
        <?php if (strlen($error = $siteInformationForm['site_description']->renderError())): ?>
          <?php echo $error ?>
        <?php elseif ($sourceCultureHelper = $siteDescription->getSourceCultureHelper($culture)): ?>
          <div class="default-translation"><?php echo $sourceCultureHelper ?></div>
        <?php endif; ?>
        <?php echo $siteInformationForm['site_description']->render() ?>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
        <div style="float: right; margin: 3px 8px 0 0;">
          <?php echo submit_tag(__('Save')) ?>
        </div>
      </td>
    </tr>
  </tbody>
  </table>
  </form>
</fieldset>

<!-- Default page elements form -->
<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('Default page elements') ?></div>
<fieldset class="collapsible collapsed">
  <legend><?php echo __('Default page elements') ?></legend>


<?php echo $defaultPageElementsForm->renderFormTag(url_for(array('module' => 'sfThemePlugin')), array('style' => 'float: left;')) ?>
  <?php echo $defaultPageElementsForm->renderGlobalErrors() ?>
    <div class="description">
      <p>
        <?php echo __('Enable or disable the display of certain page elements. Unless they have been overridden by a specific theme, these settings will be used site wide.') ?>
      </p>
    </div>
    <?php echo $defaultPageElementsForm->toggleLogo->label('Logo')->renderRow() ?>
    <?php echo $defaultPageElementsForm->toggleTitle->label('Title')->renderRow() ?>
    <?php echo $defaultPageElementsForm->toggleDescription->label('Description')->renderRow() ?>
  <?php echo submit_tag('Save') ?>
</form>



</fieldset>


<!-- Default template form -->
<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('Default template') ?></div>
<fieldset class="collapsible collapsed">
  <legend><?php echo __('Default template') ?></legend>
  <form action="<?php echo url_for('settings/list') ?>" method="POST">
  <table class="list">
    <thead>
      <tr>
        <th><?php echo __('Name')?></th>
        <th><?php echo __('Value')?></th>
      </tr>
    </thead>

    <tbody>
      <?php echo $defaultTemplateForm ?>
      <tr>
        <td>&nbsp;</td>
        <td>
          <div style="float: right; margin: 3px 8px 0 0;">
            <?php echo submit_tag(__('Save')) ?>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  </form>
</fieldset>

<!-- UI Label Form -->
<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('User interface label') ?></div>
<fieldset class="collapsible collapsed">
  <legend><?php echo __('User interface label') ?></legend>
  <form action="<?php echo url_for('settings/list') ?>" method="POST">
  <table class="list">
    <thead>
      <tr>
        <th><?php echo __('Name')?></th>
        <th><?php echo __('Value')?></th>
      </tr>
    </thead>
    <tbody>

    <?php foreach ($uiLabelForm->getSettings() as $setting): ?>
      <tr>
        <td>
          <?php if ($sf_user->getCulture() != $setting->getSourceCulture() && !strlen($setting->getValue())): ?>
            <div class="default-translation"><?php echo $setting->getName() ?></div>
          <?php else: ?>
            <?php echo $setting->getName() ?>
          <?php endif; ?>
        </td>
        <td>
          <?php echo $uiLabelForm[$setting->getName()] ?>
        </td>
      </tr>
    <?php endforeach; ?>

      <tr>
        <td>&nbsp;</td>
        <td>
          <div style="float: right; margin: 3px 8px 0 0;">
            <?php echo submit_tag(__('Save')) ?>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  </form>
</fieldset>


<!-- I18n Languages Form -->
<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('I18n languages') ?></div>
<fieldset class="collapsible collapsed">
  <legend><?php echo __('I18n languages') ?></legend>
  <form action="<?php echo url_for('settings/update') ?>" method="POST">

  <table class="list">
    <thead>
      <tr>
        <th><?php echo __('Name')?></th>
        <th><?php echo __('Value')?></th>
        <th/>
      </tr>
    </thead>

    <tbody>
    <?php foreach ($i18nLanguages as $setting): ?>
      <tr>
        <td>
          <?php echo $setting->getName() ?>
        </td>
        <td>
          <?php echo format_language($setting->getName()) ?>
        </td>
        <td>
          <?php if ($setting->deleteable): ?>
            <?php echo link_to(image_tag('delete'), array($setting, 'module' => 'settings', 'action' => 'delete')) ?>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>

      <tr>
        <td colspan="2">
            <?php echo select_language_tag('language_code', null, array('include_blank' => true)) ?>
        </td>
        <td>
          <div style="float: right; margin: 3px 8px 0 0;">
            <?php echo submit_tag(__('Add')) ?>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  </form>
</fieldset>

<!-- OAI Repository settings -->
<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('OAI Repository') ?></div>
<fieldset class="collapsible collapsed">
  <legend><?php echo __('OAI Repository') ?></legend>
  <form action="<?php echo url_for('settings/list') ?>" method="POST">
  <table class="list">
  <thead>
    <tr>
      <th width="30%"><?php echo __('Name')?></th>
      <th><?php echo __('Value')?></th>
    </tr>
  </thead>
  <tbody>
    <?php echo $oaiRepositoryForm ?>
    <tr>
      <td>&nbsp;</td>
      <td>
        <div style="float: right; margin: 3px 8px 0 0;">
          <?php echo submit_tag(__('Save')) ?>
        </div>
      </td>
    </tr>
  </tbody>
  </table>
  </form>
</fieldset>

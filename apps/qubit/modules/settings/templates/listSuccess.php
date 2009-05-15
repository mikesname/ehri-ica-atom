<div class="pageTitle"><?php echo __('site settings'); ?></div>

<!-- Global settings table -->
<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('global') ?></div>
<fieldset class="collapsible collapsed">
  <legend><?php echo __('global') ?></legend>
  <form action="<?php echo url_for('settings/list') ?>" method="POST">
  <table class="list">
  <thead>
    <tr>
      <th><?php echo __('name')?></th>
      <th><?php echo __('value')?></th>
    </tr>
  </thead>
  <tbody>
    <?php echo $globalForm ?>
    <tr>
      <td>&nbsp;</td>
      <td>
        <div style="float: right; margin: 3px 8px 0 0;">
          <?php echo submit_tag(__('save')) ?>
        </div>
      </td>
    </tr>
  </tbody>
  </table>
  </form>
</fieldset>

<!-- Site information form -->
<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('site information') ?></div>
<fieldset class="collapsible collapsed">
  <legend><?php echo __('site information') ?></legend>
  <form action="<?php echo url_for('settings/list') ?>" method="POST">
  <table class="list">
  <thead>
    <tr>
      <th><?php echo __('name')?></th>
      <th><?php echo __('value')?></th>
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
          <div class="default-translation"><?php echo nl2br($sourceCultureHelper) ?></div>
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
          <div class="default-translation"><?php echo nl2br($sourceCultureHelper) ?></div>
        <?php endif; ?>
        <?php echo $siteInformationForm['site_description']->render() ?>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
        <div style="float: right; margin: 3px 8px 0 0;">
          <?php echo submit_tag(__('save')) ?>
        </div>
      </td>
    </tr>
  </tbody>
  </table>
  </form>
</fieldset>

<!-- Default template form -->
<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('default template') ?></div>
<fieldset class="collapsible collapsed">
  <legend><?php echo __('default template') ?></legend>
  <form action="<?php echo url_for('settings/list') ?>" method="POST">
  <table class="list">
    <thead>
      <tr>
        <th><?php echo __('name')?></th>
        <th><?php echo __('value')?></th>
      </tr>
    </thead>

    <tbody>
      <?php echo $defaultTemplateForm ?>
      <tr>
        <td>&nbsp;</td>
        <td>
          <div style="float: right; margin: 3px 8px 0 0;">
            <?php echo submit_tag(__('save')) ?>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  </form>
</fieldset>

<!-- UI Label Form -->
<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('user interface label') ?></div>
<fieldset class="collapsible collapsed">
  <legend><?php echo __('user interface label') ?></legend>
  <form action="<?php echo url_for('settings/list') ?>" method="POST">
  <table class="list">
    <thead>
      <tr>
        <th><?php echo __('name')?></th>
        <th><?php echo __('value')?></th>
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
            <?php echo submit_tag(__('save')) ?>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  </form>
</fieldset>


<!-- I18n Languages Form -->
<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('i18n languages') ?></div>
<fieldset class="collapsible collapsed">
  <legend><?php echo __('i18n languages') ?></legend>
  <form action="<?php echo url_for('settings/update') ?>" method="POST">

  <table class="list">
    <thead>
      <tr>
        <th><?php echo __('name')?></th>
        <th><?php echo __('value')?></th>
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
          <?php if ($setting->isDeleteable()): ?>
            <?php echo link_to(image_tag('delete', 'valign=top'), 'settings/delete?id='.$setting->getId(), array('post' => 'true', 'confirm' => __('are you sure?'))) ?>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>

      <tr>
        <td colspan="2">
          <?php echo select_tag('language_code', options_for_select($sf_data->getRaw('availableLanguages'))) ?>
        </td>
        <td>
          <div style="float: right; margin: 3px 8px 0 0;">
            <?php echo submit_tag(__('add')) ?>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  </form>
</fieldset>

<!-- OAI Harvesting settings -->
<div class="tableHeader" style="margin-bottom: 10px;"><?php echo __('OAI harvesting') ?></div>
<fieldset class="collapsible collapsed">
  <legend><?php echo __('OAI harvesting') ?></legend>
  <form action="<?php echo url_for('settings/list') ?>" method="POST">
  <table class="list">
  <thead>
    <tr>
      <th width="30%"><?php echo __('name')?></th>
      <th><?php echo __('value')?></th>
    </tr>
  </thead>
  <tbody>
    <?php echo $oaiHarvestingForm ?>
    <tr>
      <td>&nbsp;</td>
      <td>
        <div style="float: right; margin: 3px 8px 0 0;">
          <?php echo submit_tag(__('save')) ?>
        </div>
      </td>
    </tr>
  </tbody>
  </table>
  </form>
</fieldset>

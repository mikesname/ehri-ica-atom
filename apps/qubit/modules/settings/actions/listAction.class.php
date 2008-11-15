<?php

/*
 * This file is part of the Qubit Toolkit.
 * Copyright (C) 2006-2008 Peter Van Garderen <peter@artefactual.com>
 *
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option)
 * any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

/**
 * List of qubit settings
 *
 * @package    qubit
 * @subpackage settings
 * @version    svn: $Id$
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     Jack Bates <jack@artefactual.com>
 * @author     David Juhasz <david@artefactual.com>
 */

/**
 * List action
 */
class SettingsListAction extends sfAction
{
  // Available languages (have XLIFF dir and search engine config)
  protected static $availableLanguges = array(
    '' => '&nbsp;',
    'ar' => 'العربية',
    'de' => 'deutsch',
    'el' => 'eλληνικά',
    'en' => 'english',
    'es' => 'español',
    'fa' => 'فارسی',
    'fr' => 'français',
    'is' => 'íslenska',
    'it' => 'italiano',
    'ja' => '日本語',
    'ko' => '한국어 ',
    'nl' => 'nederlands',
    'pt' => 'português',
    'sl' => 'slovenščina'
  );

  public function execute($request)
  {
    $this->culture = $this->getUser()->getCulture();

    $this->globalForm = new SettingsGlobalForm;
    $this->siteInformationForm = new SettingsSiteInformationForm;
    $this->defaultTemplateForm = new SettingsDefaultTemplateForm;
    $this->uiLabelForm = new SettingsGenericForm(array(), array(
      'settings' => QubitSetting::getByScope('ui_label'), 'scope'=>'ui_label', 'fieldsRequired' => false));

    // Handle POST data (form submit)
    if ($request->isMethod('post'))
    {

      // Global settings form submission
      if (null !== $request->getParameter('global_settings'))
      {
        // Hack to populate "version" and "upload_dir" fields so they display
        // if validation fails. By default, their values are not included in
        // $request->parameterHolder (and thus are not bound) because their
        // <input> field is disabled.
        $version = (null !== $setting = QubitSetting::getSettingByName('version')) ? $setting->getValue(array('sourceCulture'=>true)) : null;
        $uploadDir = (null !== $setting = QubitSetting::getSettingByName('upload_dir')) ? $setting->getValue(array('sourceCulture'=>true)) : null;
        $this->globalForm->bind(array_merge($request->getParameter('global_settings'), array('version'=>$version, 'upload_dir'=>$uploadDir)));
        if ($this->globalForm->isValid())
        {
          // Do update and redirect to avoid repeat submit wackiness
          $this->updateGlobalSettings();
          $this->redirect('settings/list');
        }
      }

      // Handle site information form submission
      if (null !== $request->getParameter('site_information'))
      {
        $this->siteInformationForm->bind($request->getParameter('site_information'));
        if ($this->siteInformationForm->isValid())
        {
          // Do update and redirect to avoid repeat submit wackiness
          $this->updateSiteInformationSettings();
          $this->redirect('settings/list');
        }
      }

      // Handle default template form submission
      if (null !== $request->getParameter('default_template'))
      {
        $this->defaultTemplateForm->bind($request->getParameter('default_template'));
        if ($this->defaultTemplateForm->isValid())
        {
          // Do update and redirect to avoid repeat submit wackiness
          $this->updateDefaultTemplateSettings($this->defaultTemplateForm);
          $this->redirect('settings/list');
        }
      }

      // Handle default template form submission
      if (null !== $request->getParameter('ui_label'))
      {
        $this->uiLabelForm->bind($request->getParameter('ui_label'));
        if ($this->uiLabelForm->isValid())
        {
          // Do update and redirect to avoid repeat submit wackiness
          $this->updateUiLabelSettings($this->uiLabelForm);
          $this->redirect('settings/list');
        }
      }
    }

    // Populate forms
    $this->populateGlobalForm();
    $this->populateSiteInformationForm();
    $this->populateDefaultTemplateForm($this->defaultTemplateForm);
    $this->populateUiLabelForm($this->uiLabelForm);

    // Last symfony 1.0 forms holdout
    $this->i18nLanguages = QubitSetting::getByScope('i18n_languages');

    // make vars available to template
    $this->availableLanguages = self::$availableLanguges;
  }

  /**
   * Populate the Global form with database values (non-localized)
   */
  protected function populateGlobalForm()
  {
    // Get global settings
    $version = QubitSetting::getSettingByName('version');
    $uploadDir = QubitSetting::getSettingByName('upload_dir');
    $refImageMaxWidth = QubitSetting::getSettingByName('reference_image_maxwidth');
    $hitsPerPage = QubitSetting::getSettingByName('hits_per_page');
    $multiRepository = QubitSetting::getSettingByName('multi_repository');

    // Set defaults for global form
    $this->globalForm->setDefaults(array(
      'version' => (isset($version)) ? $version->getValue(array('sourceCulture'=>true)) : null,
      'upload_dir' => (isset($uploadDir)) ? $uploadDir->getValue(array('sourceCulture'=>true)) : null,
      'reference_image_maxwidth' => (isset($refImageMaxWidth)) ? $refImageMaxWidth->getValue(array('sourceCulture'=>true)) : null,
      'hits_per_page' => (isset($hitsPerPage)) ? $hitsPerPage->getValue(array('sourceCulture'=>true)) : null,
      'multi_repository' => (isset($multiRepository)) ? intval($multiRepository->getValue(array('sourceCulture'=>true))) : 1
    ));
  }

  /**
   * Update the global settings in database (non-localized)
   */
  protected function updateGlobalSettings()
  {
    $thisForm = $this->globalForm;

    // Reference image max width
    if (null !== $refMaxWidth = $thisForm->getValue('reference_image_maxwidth'))
    {
      if (intval($refMaxWidth) && $refMaxWidth > 0)
      {
        $setting = QubitSetting::getSettingByName('reference_image_maxwidth');

        // Force sourceCulture update to prevent discrepency in settings between cultures
        $setting->setValue($refMaxWidth, array('sourceCulture'=>true));
        $setting->save();
      }
    }

    // Hits per page
    if (null !== $hitsPerPage = $thisForm->getValue('hits_per_page'))
    {
      if (intval($hitsPerPage) && $hitsPerPage > 0)
      {
        $setting = QubitSetting::getSettingByName('hits_per_page');

        // Force sourceCulture update to prevent discrepency in settings between cultures
        $setting->setValue($hitsPerPage, array('sourceCulture'=>true));
        $setting->save();
      }
    }

    // Multi-repository radio button
    if (null !== $multiRepositoryValue = $thisForm->getValue('multi_repository'))
    {
      $setting = QubitSetting::getSettingByName('multi_repository');

      // Add setting if it's not already in the sampleData.yml file for
      // backwards compatiblity with v1.0.3 sampleData.yml file
      if (null === $setting)
      {
        $setting = QubitSetting::createNewSetting('multi_repository', null, array('deleteable'=>false));
      }

      // Force sourceCulture update to prevent discrepency in settings between cultures
      $setting->setValue($multiRepositoryValue, array('sourceCulture'=>true));
      $setting->save();
    }

    return $this;
  }


  /**
   * Populate the site information settings from the database (localized)
   */
  protected function populateSiteInformationForm()
  {
    // Get site information settings
    $this->siteTitle = (null !== $siteTitle = QubitSetting::getSettingByName('site_title')) ? $siteTitle : new QubitSetting;
    $this->siteDescription = (null !== $siteDescription = QubitSetting::getSettingByName('site_description')) ? $siteDescription : new QubitSetting;

    // Set defaults values
    $this->siteInformationForm->setDefaults(array(
      'site_title' => $this->siteTitle->getValue(array('culture' => $this->culture)),
      'site_description' => $this->siteDescription->getValue(array('culture' => $this->culture))
    ));

    return $this;
  }

  /**
   * Update site information settings (localized)
   */
  protected function updateSiteInformationSettings()
  {
    $thisForm = $this->siteInformationForm;

    if (strlen($siteTitle = $thisForm->getValue('site_title')))
    {
      $setting = QubitSetting::getSettingByName('site_title');

      // Create new QubitSetting if site_title doesn't already exist (backwards
      // compatiblity with v1.0.3 sampleData.yml file)
      if (null === $setting)
      {
        $setting = QubitSetting::createNewSetting('site_title', null, array('scope'=>'site_information', 'deleteable'=>false));
      }
      $setting->setValue($siteTitle);
      $setting->save();
    }

    if (strlen($siteDescription = $thisForm->getValue('site_description')))
    {
      $setting = QubitSetting::getSettingByName('site_description');

      // Create new QubitSetting if site_description doesn't already exist
      // (backwards compatiblity with v1.0.3 sampleData.yml file)
      if (null === $setting)
      {
        $setting = QubitSetting::createNewSetting('site_description', null, array('scope'=>'site_information', 'deleteable'=>false));
      }
      $setting->setValue($siteDescription);
      $setting->save();
    }

    return $this;
  }

  /**
   * Populate the default template settings from the database (non-localized)
   */
  protected function populateDefaultTemplateForm($form)
  {
    $infoObjectTemplate = QubitSetting::getByNameAndScope('informationobject', 'default_template');
    $actorTemplate = QubitSetting::getByNameAndScope('actor', 'default_template');
    $repositoryTemplate = QubitSetting::getByNameAndScope('repository', 'default_template');

    // Set defaults for global form
    $this->defaultTemplateForm->setDefaults(array(
      'informationobject' => (isset($infoObjectTemplate)) ? $infoObjectTemplate->getValue(array('sourceCulture'=>true)) : null,
      'actor' => (isset($actorTemplate)) ? $actorTemplate->getValue(array('sourceCulture'=>true)) : null,
      'repository' => (isset($repositoryTemplate)) ? $repositoryTemplate->getValue(array('sourceCulture'=>true)) : null,
    ));
  }

  /**
   * Update default template db values with form values (non-localized)
   *
   * @return $this;
   */
  protected function updateDefaultTemplateSettings($form)
  {
    if (null !== $newValue = $form->getValue('informationobject'))
    {
      $setting = QubitSetting::findAndSave('informationobject', $newValue, array(
        'scope'=>'default_template', 'createNew'=>true, 'sourceCulture'=>true));
    }

    if (null !== $newValue = $form->getValue('actor'))
    {
      $setting = QubitSetting::findAndSave('actor', $newValue, array(
        'scope'=>'default_template', 'createNew'=>true, 'sourceCulture'=>true));
    }

    if (null !== $newValue = $form->getValue('repository'))
    {
      $setting = QubitSetting::findAndSave('repository', $newValue, array(
        'scope'=>'default_template', 'createNew'=>true, 'sourceCulture'=>true));
    }

    return $this;
  }

  /**
   * Populate the ui_label form with database values (localized)
   */
  protected function populateUiLabelForm($form)
  {
    foreach ($form->getSettings() as $setting)
    {
      $form->setDefault($setting->getName(), $setting->getValue());
    }
  }

  /**
   * Update ui_label db values with form values (localized)
   *
   * @return $this
   */
  protected function updateUiLabelSettings($form)
  {
    foreach ($form->getSettings() as $setting)
    {
      if (null !== $value = $form->getValue($setting->getName()))
      {
        $setting->setValue($value);
        $setting->save();
      }
    }

    // Add a new ui_label
    if (null !== ($newName = $form->getValue('new_setting_name')) && strlen($newValue = $form->getValue('new_setting_value')))
    {
      $setting = QubitSetting::createNewSetting($newName, $newValue, array('scope'=>$form->getScope()));
      $setting->save();
    }

    return $this;
  }

} // End class
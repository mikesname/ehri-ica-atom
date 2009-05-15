<?php

/*
 */

class sfInstallPluginConfigureSiteAction extends sfAction
{
  public function execute($request)
  {
    $this->form = new sfInstallConfigureSiteForm;

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('configure'));

      if ($this->form->isValid())
      {
        $setting = new QubitSetting;
        $setting->name = 'siteTitle';
        $setting->value = $this->form->getValue('siteTitle');
        $setting->save();

        $setting = new QubitSetting;
        $setting->name = 'siteDescription';
        $setting->value = $this->form->getValue('siteDescription');
        $setting->save();

        $user = new QubitUser;
        $user->username = $this->form->getValue('username');
        $user->email = $this->form->getValue('email');
        $user->setPassword($this->form->getValue('password'));
        $user->save();

        $relation = new QubitUserRoleRelation;
        $relation->userId = $user->id;
        $relation->roleId = QubitRole::ADMINISTRATOR_ID;
        $relation->save();

        $this->redirect(array('module' => 'sfInstallPlugin', 'action' => 'finishInstall'));
      }
    }
  }
}

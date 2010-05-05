<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * Qubit Toolkit is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Qubit Toolkit.  If not, see <http://www.gnu.org/licenses/>.
 */

class StaticPageEditAction extends sfAction
{
  public static
    $NAMES = array(
      'title',
      'permalink',
      'content');

  protected function addField($name)
  {
    switch ($name)
    {
      case 'content':
        $this->form->setDefault('content', $this->staticPage->content);
        $this->form->setValidator('content', new sfValidatorString);
        $this->form->setWidget('content', new sfWidgetFormTextarea);

        break;

      default:
        $this->form->setDefault($name, $this->staticPage[$name]);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormInput);
    }
  }

  protected function processField($field)
  {
    switch ($name = $field->getName())
    {
      case 'permalink':

        if (!$this->staticPage->isProtected())
        {
          $this->staticPage[$name] = $this->form->getValue($name);
        }

        break;

      default:

        $this->staticPage[$name] = $this->form->getValue($name);
    }
  }

  protected function processForm()
  {
    foreach ($this->form as $field)
    {
      $this->processField($field);
    }

    $this->staticPage->save();
  }

  public function execute($request)
  {
    $this->form = new sfForm;

    $this->staticPage = new QubitStaticPage;

    if (isset($request->id))
    {
      $this->staticPage = QubitStaticPage::getById($request->id);

      if (!isset($this->staticPage))
      {
        $this->forward404();
      }
    }

    // HACK: Use static::$NAMES in PHP 5.3,
    // http://php.net/oop5.late-static-bindings
    $class = new ReflectionClass($this);
    foreach ($class->getStaticPropertyValue('NAMES') as $name)
    {
      $this->addField($name);
    }

    // Post form
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());

      if ($this->form->isValid())
      {
        $this->processForm();

        $this->redirect(array($this->staticPage, 'module' => 'staticpage'));
      }
    }
  }
}

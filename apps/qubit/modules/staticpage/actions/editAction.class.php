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

class StaticPageEditAction extends DefaultEditAction
{
  public static
    $NAMES = array(
      'title',
      'slug',
      'content');

  protected function earlyExecute()
  {
    $this->form->getWidgetSchema()->setIdFormat('edit-%s');

    $this->resource = new QubitStaticPage;
    $title = $this->context->i18n->__('Add new page');

    if (isset($this->getRoute()->resource))
    {
      $this->resource = $this->getRoute()->resource;

      if (1 > strlen($title = $this->resource))
      {
        $title = $this->context->i18n->__('Untitled');
      }

      $title = $this->context->i18n->__('Edit %1%', array('%1%' => $title));
    }

    $this->response->setTitle("$title - {$this->response->getTitle()}");
  }

  protected function addField($name)
  {
    switch ($name)
    {
      case 'content':
        $this->form->setDefault('content', $this->resource->content);
        $this->form->setValidator('content', new sfValidatorString);
        $this->form->setWidget('content', new sfWidgetFormTextarea);

        break;

      case 'slug':
        $this->form->setDefault('slug', $this->resource->slug);
        $this->form->setValidator('slug', new sfValidatorRegex(array('pattern' => '/^[^;]*$/'), array('invalid' => $this->context->i18n->__('Mustn\'t contain ";"'))));
        $this->form->setWidget('slug', new sfWidgetFormInput);

      case 'title':
        $this->form->setDefault('title', $this->resource->title);
        $this->form->setValidator('title', new sfValidatorString);
        $this->form->setWidget('title', new sfWidgetFormInput);

      default:

        return parent::addField($name);
    }
  }

  protected function processField($field)
  {
    switch ($field->getName())
    {
      case 'slug':

        if (!$this->resource->isProtected())
        {
          $this->resource->slug = $this->form->getValue('slug');
        }

        break;

      default:

        return parent::processField($field);
    }
  }

  public function execute($request)
  {
    parent::execute($request);

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());
      if ($this->form->isValid())
      {
        $this->processForm();

        $this->resource->save();

        $this->redirect(array($this->resource, 'module' => 'staticpage'));
      }
    }
  }
}

<?php

/**
 * unique actions.
 *
 * @package    test
 * @subpackage unique
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9666 2008-06-19 12:57:42Z fabien $
 */
class uniqueActions extends sfActions
{
  public function executeArticle($request)
  {
    $this->form = new ArticleForm();

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('article'));

      if ($this->form->isValid())
      {
        $this->form->save();

        $this->redirect('unique/ok');
      }
    }
  }

  public function executeCategory($request)
  {
    $category = CategoryPeer::retrieveByPk($request->getParameter('category[id]'));
    $this->form = new CategoryForm($category);

    if ($request->getParameter('global'))
    {
      $this->form->getValidatorSchema()->getPostValidator()->setOption('throw_global_error', true);
    }

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('category'));

      if ($this->form->isValid())
      {
        $this->form->save();

        $this->redirect('unique/ok');
      }
    }
  }

  public function executeOk()
  {
    return $this->renderText('ok');
  }
}

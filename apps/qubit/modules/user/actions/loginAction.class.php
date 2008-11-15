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

class UserLoginAction extends sfAction
{

  public function execute($request)
  {
    sfLoader::loadHelpers(array('Url'));

    $this->loginMessage = '';
    $this->loginError = '';
    $this->loginForm = new UserLoginForm;

    // handle the form submission
    if ($request->isMethod('post'))
    {
      $this->loginForm->bind($request->getParameter('login'));
      if ($this->loginForm->isValid())
      {
        if ($this->getUser()->authenticate($this->loginForm->getValue('email'), $this->loginForm->getValue('password'), $loginError))
        {
          // redirect to login_route, otherwise redirect to homepage
          if ($nextPage = $this->getUser()->getAttribute('login_route'))
          {
            $this->getUser()->getAttributeHolder()->remove('login_route');
            $this->getController()->redirect(url_for($nextPage), true);
          }
          else
          {
            $this->redirect('@homepage');
          }
        }
        else
        {
          $this->loginError = $loginError;
        }
      }
    }

    // Set the 'login_route' attribute for redirecting user after authentication
    $this->setLoginRoute($this->getUser());
  }

  /**
   * Get referring page so we can redirect the user back there after
   * successfully authenticating them
   *
   * @param sfUser $user
   */
  public function setLoginRoute($user)
  {
    // if the user selected the log-in page explicitely, send them back to their referring page
    if ($this->getRequest()->getPathInfo() == '/user/login')
    {
      // Don't set the login_route to referrer if referrer = current page (login)
      if ($this->getRequest()->getReferer() != $this->getRequest()->getUri())
      {
        $user->setAttribute('login_route', $this->getRequest()->getReferer());
      }
      $this->loginMessage = $this->getContext()->getI18N()->__('log in');
    }

    // if the user is stopped by the login page on their way to another page, send them on
    // their way to that page after logging on successfully
    else
    {
      $user->setAttribute('login_route', $this->getRequest()->getUri());
      $this->loginMessage = $this->getContext()->getI18N()->__('please log-in to access that page');
    }
  }
}

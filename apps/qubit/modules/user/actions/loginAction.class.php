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
  $this->login_message = '';

  if ($this->getRequest()->getMethod() != sfRequest::POST)
  {
      // set the login_route to user after the user is logged-in
      // if the user selected the log-in page explicitely, send them back to their referring page
      // if the user is stopped by the login page on their way to another page, send them on
      // their way to that page after logging on successfully

      if ($this->getRequest()->getPathInfo() == '/login')
      {
        $this->getUser()->setAttribute('login_route', $this->getRequest()->getReferer());
        $this->login_message = $this->getContext()->getI18N()->__('log in');
      }
      else
      {
        $this->getUser()->setAttribute('login_route', $this->getRequest()->getPathInfo());
        $this->login_message = $this->getContext()->getI18N()->__('please log-in to access that page');
      }

    // display the form
    return sfView::SUCCESS;
  }
  else
  {
    // handle the form submission

    // redirect to login_route, otherwise redirect to homepage

    if ($this->getUser()->getAttribute('login_route'))
    {
      $this->redirect($this->getUser()->getAttribute('login_route'));
      }
    else
    {
      $this->redirect('@homepage');
      }
  }
  }

  public function handleError()
  {
  $this->login_message = $this->getContext()->getI18N()->__('log in');

  return sfView::SUCCESS;
  }
}

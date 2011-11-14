<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
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

class qtSwordPluginHttpAuthFilter extends sfFilter
{
  public function execute($filterChain)
  {
    if ($this->isFirstCall())
    {
      if (!isset($_SERVER['PHP_AUTH_USER']))
      {
        $this->sendHeaders();

        exit;
      }

      $user = QubitUser::checkCredentials($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'], $error);

      if (null === $user)
      {
        $this->sendHeaders();

        return;
      }

      $user = new myUser(new sfEventDispatcher(), new sfNoStorage());
      $user->authenticate($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);

      // We'll need username/email details later
      sfContext::getInstance()->request->setAttribute('user', $user);
    }

    $filterChain->execute();
  }

  private function sendHeaders()
  {
    header('WWW-Authenticate: Basic realm="Secure area"');
    header('HTTP/1.0 401 Unauthorized');
  }
}

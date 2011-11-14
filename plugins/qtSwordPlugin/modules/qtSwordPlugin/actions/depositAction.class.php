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

// TODO
// 1.2 Check user authorization
// 1.2 Check upload/repository limit
// post-1.2 PUT/DELETE verbs
// post-1.2 X-On-Behalf-Of (mediation)
// post-1.2 X-No-Op (dev feature: dry run)
// post-1.2 X-Verbose (dev feature: verbose output)

class qtSwordPluginDepositAction extends sfAction
{
  public function execute($request)
  {
    if (null === $this->resource = $this->getRoute()->resource)
    {
      return $this->generateResponse(404, 'error/ErrorBadRequest', array('summary' => $this->context->i18n->__('Not found')));
    }

    $this->user = $request->getAttribute('user');

    if ($request->isMethod('post'))
    {
      if (QubitAcl::check(QubitInformationObject::getRoot(), 'create'))
      {
        return $this->generateResponse(403, 'error/ErrorBadRequest', array('summary' => $this->context->i18n->__('Forbidden')));
      }

      $this->packageFormat = $request->getHttpHeader('X-Packaging');
      $this->packageContentType = $request->getContentType();

      // Check if the packaging format is supported
      if (!in_array($this->packageFormat, qtSwordPluginConfiguration::$packaging))
      {
        return $this->generateResponse(415, 'error/ErrorContent', array('summary' => $this->context->i18n->__('The supplied format is not supported by this server')));
      }

      // Check if the content type is supported
      if (!in_array($this->packageContentType, qtSwordPluginConfiguration::$mediaRanges))
      {
        return $this->generateResponse(415, 'error/ErrorContent', array('summary' => $this->context->i18n->__('The supplied content type is not supported by this server')));
      }

      // Save the file temporary
      $filename = qtSwordPlugin::saveRequestContent();

      // Package name
      if (null !== $request->getHttpHeader('Content-Disposition'))
      {
        $this->packageName = substr($request->getHttpHeader('Content-Disposition'), 9);
      }
      {
        // TODO see [RFC2183]
        $this->packageName = $filename;
      }

      // Calculated MD5 check does not match the value provided by the client
      if (md5(file_get_contents($filename)) != $request->getHttpHeader('Content-MD5'))
      {
        return $this->generateResponse(412, 'error/ErrorChecksumMismatchSuccess', array('summary' => $this->context->i18n->__('Checksum sent does not match the calculated checksum')));
      }

      try
      {
        $extractor = qtPackageExtractorFactory::build($this->packageFormat, array(
          'filename' => $filename,
          'name' => $this->packageName,
          'format' => $this->packageFormat,
          'resource' => $this->resource,
          'type' => $this->packageContentType));
      }
      catch (Exception $e)
      {
        return $this->generateResponse(415, 'error/ErrorContent', array('summary' => $e->getMessage())); 
      }

      // Open package and XML document
      $extractor->extract();

      // Parse and create objects
      $extractor->process();

      $this->informationObject = $extractor->informationObject;

      // Remove temporary files
      $extractor->clean();

      return $this->generateResponse(201, 'deposit', array('headers' =>
        array('Location' => $this->context->routing->generate(null, array($this->informationObject, 'module' => 'informationobject')))));
    }
    else if ($request->isMethod('put') || $request->isMethod('delete'))
    {
      return $this->generateResponse(501, 'error/ErrorNotImplemented', array('summary' => $this->context->i18n->__('Not implemented')));
    }
    else
    {
      return $this->generateResponse(400, 'error/ErrorBadRequest', array('summary' => $this->context->i18n->__('Bad request')));
    }
  }

  protected function generateResponse($code, $template = null, array $options = array())
  {
    $this->response->setStatusCode($code);

    if ($template !== null)
    {
      $this->request->setRequestFormat('xml');

      $this->response->setHttpHeader('Content-Type', 'application/atom+xml; charset="utf-8"');

      if (isset($options['headers']))
      {
        foreach ($options['headers'] as $key => $value)
        {
          $this->response->setHttpHeader($key, $value);
        }
      }

      if (isset($options['summary']))
      {
        $this->summary = $options['summary'];
      }

      $this->setTemplate($template);
    }

    return null;
  }
}

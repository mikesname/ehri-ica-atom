<?php

include dirname(__FILE__).'/../../bootstrap/functional.php';

$browser = new sfTestFunctional(new sfBrowser);

$browser
  ->post(';create/isad', array('title' => 'Example fonds'))

  ->with('request')->begin()
    ->isParameter('module', 'sfIsadPlugin')
    ->isParameter('action', 'edit')
  ->end()

  ->with('response')->begin()
    ->isStatusCode(200)
    ->checkElement('body', '/Example fonds/')
  ->end();

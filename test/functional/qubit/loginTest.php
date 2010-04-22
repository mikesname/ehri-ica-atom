<?php

require_once dirname(__FILE__).'/../../bootstrap/functional.php';

$browser = new sfTestFunctional(new sfBrowser);

$user = new QubitUser;

$user->username = 'Test McTester';
$user->email = 'test@example.com';
$user->setPassword('test1234');

$user->save();

$browser
  ->post(';user/login', array('email' => 'test@example.com', 'password' => 'test1234'))

  ->with('request')->begin()
    ->isParameter('module', 'user')
    ->isParameter('action', 'login')
  ->end();

$browser->test()->ok($browser->getUser()->isAuthenticated(),
  'User is authenticated');

$browser->test()->isa_ok($browser->getUser()->user, 'QubitUser',
  'myUser->user is QubitUser');

$browser
  ->get('/')

  ->with('request')->begin()
    ->isParameter('module', 'staticpage')
    ->isParameter('action', 'static')
  ->end()

  ->click('Log out')

  ->with('request')->begin()
    ->isParameter('module', 'user')
    ->isParameter('action', 'logout')
  ->end();

$browser->test()->ok(!$browser->getUser()->isAuthenticated(),
  'User isn\'t authenticated');

$browser = new sfTestFunctional(new sfBrowser);

$browser
  ->post(';user/login', array('email' => 'test@example.com', 'password' => 'wrongpass'))

  ->with('request')->begin()
    ->isParameter('module', 'user')
    ->isParameter('action', 'login')
  ->end();

$browser->test()->ok(!$browser->getUser()->isAuthenticated(),
  'User isn\'t authenticated');

$browser->test()->is($browser->getUser()->user, null,
  'myUser->user is null');

// Issue 1342
$browser = new sfTestFunctional(new sfBrowser);

$browser
  ->post(';user/login', array('email' => 'test@example.com', 'password' => 'test1234', 'next' => 'http://localhost/example'))

  ->with('request')->begin()
    ->isParameter('module', 'user')
    ->isParameter('action', 'login')
  ->end();

$browser->test()->ok($browser->getUser()->isAuthenticated(),
  'User is authenticated');

$browser->test()->isa_ok($browser->getUser()->user, 'QubitUser',
  'myUser->user is QubitUser');

$user->delete();

<?php
class MyClass
{
    $varName  = 'hello';
    $var_name = 'hello';
    $varname  = 'hello';
    $_varName = 'hello';

    public $varName  = 'hello';
    public $var_name = 'hello';
    public $varname  = 'hello';
    public $_varName = 'hello';

    protected $varName  = 'hello';
    protected $var_name = 'hello';
    protected $varname  = 'hello';
    protected $_varName = 'hello';

    private $_varName  = 'hello';
    private $_var_name = 'hello';
    private $_varname  = 'hello';
    private $varName   = 'hello';
}

class MyClass
{
  function func1()
  {
    function func2()
    {
     return $a;
    }
    return $data;
  }
}

class MyClass
{
    public function prepare() {}
    public function paint() {}
}

if (true) {
    class MyClass
    {
        $varName  = 'hello';
        $var_name = 'hello';
    }
}
?>
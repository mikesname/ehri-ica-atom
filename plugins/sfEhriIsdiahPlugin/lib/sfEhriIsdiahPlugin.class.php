<?php

/*
 */

class sfEhriIsdiahPlugin extends sfIsaarPlugin
{
  private
    $_meta;

  // FIXME: These should really be static
  // class properties, but that seems to
  // require jumping through some unpleasant
  // hoops elsewhere in the code.
  public $commonSources = array(
      'Archival Guide',
      'Bibliography',
      'Claims Conference',      
      'Mémorial de la Shoah',
      'USHMM',
      'Yad Vashem',
  );
  // FIXME: Ditto, should be static
  public $researchServices = array(
      'Basic description',
      'Search services',
  );
  // Ditto
  public $priorities = array(
    null => "",
    5 =>"5",
    4 => "4",
    3 => "3",
    2 => "2",
    1 => "1",
    0 => "Reject"
  );

  public function __get($name)
  {
    switch ($name)
    {
      case '_ehriMeta':

        if (!isset($this->_meta))
        {            
          $criteria = new Criteria;
          $this->resource->addPropertysCriteria($criteria);
          $criteria->add(QubitProperty::NAME, "ehrimeta");

          if (1 == count($query = QubitProperty::get($criteria)))
          {
            $this->_meta = $query[0];
          }
          else
          {
            $this->_meta = new QubitProperty;
            $this->_meta->name = "ehrimeta";
            $this->_meta->value = serialize(array());
            $this->resource->propertys[] = $this->_meta;
          }
        }
        return $this->_meta;

      case 'ehriCopyrightIssue':
      case 'ehriPriority':
        $meta = unserialize($this->_ehriMeta->value);
        return array_key_exists($name, $meta) ? $meta[$name] : NULL;
      default:
        return parent::__get($name);
    }
  }

  public function __set($name, $value)
  {
    switch ($name)
    {
    case 'ehriCopyrightIssue':
    case 'ehriPriority':
        $meta = unserialize($this->_ehriMeta->value);
        $meta[$name] = $value;
        $this->_ehriMeta->value = serialize($meta);
        return $this;
    default:
      return parent::__set($name, $value);
    }
  }

}

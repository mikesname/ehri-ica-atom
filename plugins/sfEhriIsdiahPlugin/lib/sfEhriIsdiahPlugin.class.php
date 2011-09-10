<?php

/*
 */

class sfEhriIsdiahPlugin extends sfIsaarPlugin
{
  private
      $_meta;

  public $commonSources = array(
      'Yad Yashem',
      'Mémorial de la Shoah',
      'USHMM',
      'Archival Guide',
      'Bibliography',      
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

      case 'ehriScope':          
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
    case 'ehriScope':
    case 'ehriCopyrightIssue':
        error_log("Fetching value for " . $name);
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

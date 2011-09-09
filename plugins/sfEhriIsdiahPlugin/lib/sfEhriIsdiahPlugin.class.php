<?php

/*
 */

class sfEhriIsdiahPlugin extends sfIsdiahPlugin
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
          $criteria->add(QubitNote::OBJECT_ID, $this->resource->id);
          $criteria->add(QubitNote::TYPE_ID, QubitTerm::OTHER_DESCRIPTIVE_DATA_ID);

          if (1 == count($query = QubitNote::get($criteria)))
          {
            $this->_meta = $query[0];
          }
          else
          {
            $this->_meta = new QubitNote;
            $this->_meta->typeId = QubitTerm::OTHER_DESCRIPTIVE_DATA_ID;
            $this->_meta->content = serialize(array());
            $this->resource->notes[] = $this->_meta;
          }
        }
        return $this->_meta;

      case 'ehriScope':          
      case 'ehriCopyrightIssue':
      case 'ehriPriority':
        $meta = unserialize($this->_ehriMeta->content);
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
        $meta = unserialize($this->_ehriMeta->content);
        $meta[$name] = $value;
        $this->_ehriMeta->content = serialize($meta);
        return $this;
    default:
      return parent::__set($name, $value);
    }
  }

}

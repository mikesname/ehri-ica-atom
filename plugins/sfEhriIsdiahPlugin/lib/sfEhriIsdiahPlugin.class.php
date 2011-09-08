<?php

/*
 */

class sfEhriIsdiahPlugin extends sfIsdiahPlugin
{
  protected
    $ehriMeta;

  public function __get($name)
  {
    switch ($name)
    {
      case '_ehriMeta':

        if (!isset($this->ehriMeta))
        {
          $termcrit = new Criteria;
          $termcrit->add(QubitTerm::CODE, "EHRIPRIORITY");
          $termquery = QubitTerm::get($termcrit);
          //$this->logMessage("Term Query: " . $termquery);
          // throw new sfPluginException("Term Query: " . count($termquery) . " id: " . $termquery[0]->id);
          if (0 == count($termquery))
          {
            throw new sfPluginException("Unable to find Term with code 'EHRIPRIORIY' in database.");
          }  
          
          $criteria = new Criteria;
          $criteria->add(QubitNote::OBJECT_ID, $this->resource->id);
          $criteria->add(QubitNote::TYPE_ID, $termquery[0]->id);

          if (1 == count($query = QubitNote::get($criteria)))
          {
            $this->ehriMeta = $query[0];
          }
          else
          {
            $this->ehriMeta = new QubitNote;
            $this->ehriMeta->typeId = $termquery[0]->id;

            $this->resource->notes[] = $this->ehriMeta;
          }
        }

        return $this->ehriMeta;

      case 'ehriScope':
      case 'ehriPriority':
        $content = $this->_ehriMeta->content;
        if (!$content)
        {
          return;
        }
        try {
            $meta = unserialize($this->_ehriMeta->content);
        } catch (Exception $e) {
        }
        if (is_array($meta) && array_key_exists($name, $meta))
        {
          return $meta[$name];
        }
        break;

      default:
          return parent::__get($name);
    }
  }

  public function __set($name, $value)
  {
    switch ($name)
    {
    case 'ehriScope':
    case 'ehriPriority':
        try {
            $meta = unserialize($this->_ehriMeta->content);
        } catch (Exception $e) {
        }
        if (!is_array($meta))
        {
          $meta = array();
        }
        $meta[$name] = $value;
        $this->_ehriMeta->content = serialize($meta);

        return $this;

      default:
          return parent::__set($name, $value);
    }
  }

}

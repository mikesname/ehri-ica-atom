<?php

/*
 */

class sfEhriIsdiahPlugin extends sfIsdiahPlugin
{
  protected
    $ehriPriority;

  public function __get($name)
  {
    switch ($name)
    {
      case '_ehriPriority':

        if (!isset($this->ehriPriority))
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
            $this->ehriPriority = $query[0];
          }
          else
          {
            $this->ehriPriority = new QubitNote;
            $this->ehriPriority->typeId = $termquery[0]->id;

            $this->resource->notes[] = $this->ehriPriority;
          }
        }

        return $this->ehriPriority;

      case 'ehriPriority':
        return $this->_ehriPriority->content;

      default:
          return parent::__get($name);
    }
  }

  public function __set($name, $value)
  {
    switch ($name)
    {
      case 'ehriPriority':
        $this->_ehriPriority->content = $value;

        return $this;

      default:
          return parent::__set($name, $value);
    }
  }

}

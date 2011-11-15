<?php
/**
* FluentDOMIterator is the Iterator class for FluentDOMCore objects
*
* @version $Id: Iterator.php 431 2010-03-29 20:42:04Z subjective $
* @license http://www.opensource.org/licenses/mit-license.php The MIT License
* @copyright Copyright (c) 2009 Bastian Feder, Thomas Weinert
*
* @package FluentDOM
*/

/**
* FluentDOMIterator is the Iterator class for FluentDOMCore objects
*
* @package FluentDOM
*/
class FluentDOMIterator implements RecursiveIterator, SeekableIterator {

  /**
  * internal position pointer variable
  * @var integer
  */
  private $_position  = 0;

  /**
  * owner (object) of the iterator
  * @var FluentDOMCore
  */
  private $_owner = NULL;

  /**
  * Remember the owner object (the FluentDOMCore object this iterator interates)
  *
  * @param FluentDOMCore $owner
  * @return FluentDOMCore
  */
  public function __construct(FluentDOMCore $owner) {
    $this->_owner = $owner;
  }

   /*
  * Interface - Iterator, SeekableIterator
  */

  /**
  * Get current iterator element
  *
  * @return object DOMNode
  */
  public function current() {
    return $this->_owner->item($this->_position);
  }

  /**
  * Get current iterator pointer
  *
  * @return integer
  */
  public function key() {
    return $this->_position;
  }

  /**
  * Move iterator pointer to next element
  *
  * @return void
  */
  public function next() {
    ++$this->_position;
  }

  /**
  * Reset iterator pointer
  *
  * @return void
  */
  public function rewind() {
    $this->_position = 0;
  }

  /**
  * Move iterator pointer to specified element
  *
  * @param integer $position
  * @return void
  */
  public function seek($position) {
    if (count($this->_owner) > $position) {
      $this->_position = $position;
    } else {
      throw new InvalidArgumentException('Unknown position');
    }
  }

  /**
  * Check if current iterator pointer contains a valid element
  *
  * @return boolean
  */
  public function valid() {
    return is_object($this->_owner->item($this->_position));
  }

  /**
  * Get children of the current iterator element
  *
  * @return object FluentDOMCore
  */
  public function getChildren() {
    $fd = $this->_owner->spawn();
    $fd->push($this->_owner->item($this->_position)->childNodes);
    return new self($fd);
  }

  /**
  * Check if the current iterator element has children
  *
  * @return object FluentDOMCore
  */
  public function hasChildren() {
    $item = $this->_owner->item($this->_position);
    return $item->hasChildNodes();
  }
}
<?php
/**
* FluentDOMStyle extends the FluentDOM class with a function to edit
* the style attribute of html tags
*
* @version $Id: Style.php 431 2010-03-29 20:42:04Z subjective $
* @license http://www.opensource.org/licenses/mit-license.php The MIT License
* @copyright Copyright (c) 2009 Bastian Feder, Thomas Weinert
*
* @package FluentDOM
*/

/**
* include the parent class (FluentDOM)
*/
require_once(dirname(__FILE__).'/../FluentDOM.php');

/**
* Function to create a new FluentDOMStyleinstance and loads data into it if
* a valid $source is provided.
*
* @param mixed $source
* @param string $contentType optional, default value 'text/xml'
* @return object FluentDOMStyle
*/
function FluentDOMStyle($source = NULL, $contentType = 'text/xml') {
  $result = new FluentDOMStyle();
  if (isset($source)) {
    return $result->load($source, $contentType);
  } else {
    return $result;
  }
}

/**
* FluentDOMStyle extends the FluentDOM class with a function to edit
* the style attribute of html tags
*
* @package FluentDOM
*/
class FluentDOMStyle extends FluentDOM {

  /**
  * Pattern to decode the stlye property string
  */
  const STYLE_PATTERN = '((?:^|;)\s*(?P<name>[-\w]+)\s*:\s*(?P<value>[^;]+))';

  /**
  * get or set CSS values in style attributes
  *
  * @param string|array $property
  * @param NULL|string|object Closure $value
  * @return string|object FluentDOMStyle
  */
  public function css($property, $value = NULL) {
    if (is_array($property)) {
      //set list of properties to all elements
      foreach ($this->_array as $node) {
        if ($node instanceof DOMElement) {
          $options = $this->_decodeStyleAttribute($node->getAttribute('style'));
          foreach ($property as $name => $value) {
            if ($this->_isCSSProperty($name)) {
              if (isset($options[$name]) && empty($value)) {
                unset($options[$name]);
              } elseif (!empty($value)) {
                $options[$name] = $value;
              }
            } else {
              throw new InvalidArgumentException('Invalid css property name: '.$property);
            }
          }
          $styleString = $this->_encodeStyleAttribute($options);
          if (empty($styleString) && $node->hasAttribute('style')) {
            $node->removeAttribute('style');
          } elseif (!empty($styleString)) {
            $node->setAttribute('style', $styleString);
          }
        }
      }
    } elseif (is_null($value)) {
      //get value from first DOMElement
      $firstNode = NULL;
      foreach ($this->_array as $node) {
        if ($node instanceof DOMElement) {
          $firstNode = $node;
          break;
        }
      }
      if (empty($firstNode)) {
        return NULL;
      } else {
        $options = $this->_decodeStyleAttribute($firstNode->getAttribute('style'));
        if (isset($options[$property])) {
          return $options[$property];
        }
      }
      return NULL;
    } else {
      //set value to all nodes
      if ($this->_isCSSProperty($property)) {
        foreach ($this->_array as $index => $node) {
          if ($node instanceof DOMElement) {
            $options = $this->_decodeStyleAttribute($node->getAttribute('style'));
            if (empty($value)) {
              if (isset($options[$property])) {
                unset($options[$property]);
              }
            } elseif (is_string($value)) {
              $options[$property] = $value;
            } elseif ($this->_isCallback($value, FALSE, FALSE)) {
              $options[$property] = call_user_func(
                $value,
                $node,
                $index,
                empty($options[$property]) ? '' : $options[$property]
              );
            }
            $styleString = $this->_encodeStyleAttribute($options);
            if (empty($styleString) && $node->hasAttribute('style')) {
              $node->removeAttribute('style');
            } elseif (!empty($styleString)) {
              $node->setAttribute('style', $styleString);
            }
          }
        }
      } else {
        throw new InvalidArgumentException('Invalid css property name: '.$property);
      }
    }
  }

  /**
  * check if string is an valid css property name
  *
  * @param string $propertyName
  * @return boolean
  */
  private function _isCSSProperty($propertyName) {
    $pattern = '(^-?(?:[a-z]+-)*(?:[a-z]+)$)D';
    if (preg_match($pattern, $propertyName)) {
      return TRUE;
    }
    return FALSE;
  }

  /**
  * decode style attribute to css properties array
  *
  * @param string $styleString
  * @return array
  */
  private function _decodeStyleAttribute($styleString) {
    $result = array();
    if (!empty($styleString)) {
      $matches = array();
      if (preg_match_all(self::STYLE_PATTERN, $styleString, $matches, PREG_SET_ORDER)) {
        foreach ($matches as $match) {
          if (isset($match['name']) &&
              $this->_isCSSProperty($match['name']) &&
              !empty($match['value'])) {
            $result[$match['name']] = $match['value'];
          }
        }
      }
    }
    return $result;
  }

  /**
  * encode css options array for the style string
  *
  * @param array $properties
  * @return string
  */
  private function _encodeStyleAttribute($properties) {
    $result = '';
    if (is_array($properties) && count($properties) > 0) {
      uksort($properties, array($this, '_compareCSSProperties'));
      foreach ($properties as $name => $value) {
        $result .= ' '.$name.': '.$value.';';
      }
    }
    return substr($result, 1);
  }

  /**
  * compare to css property names
  *
  * by name, browser-prefix, level
  *
  * @param string $propertyNameOne
  * @param string $propertyNameTwo
  * @return integer
  */
  private function _compareCSSProperties($propertyNameOne, $propertyNameTwo) {
    $propertyOne = $this->_getCSSPropertyElements($propertyNameOne);
    $propertyTwo = $this->_getCSSPropertyElements($propertyNameTwo);
    $propertyOneLevels = count($propertyOne);
    $propertyTwoLevels = count($propertyTwo);
    $maxLevels = ($propertyOneLevels > $propertyTwoLevels)
      ? $propertyOneLevels : $propertyTwoLevels;
    for ($i = 0; $i < $maxLevels; ++$i) {
      if (isset($propertyOne[$i]) &&
          isset($propertyTwo[$i])) {
        $compare = strnatcasecmp(
          $propertyOne[$i],
          $propertyTwo[$i]
        );
        if ($compare != 0) {
          return $compare;
        }
      } else {
        break;
      }
    }
    if ($propertyOneLevels > $propertyTwoLevels) {
      return 1;
    } else {
      return -1;
    }
  }

  /**
  * decodes the css property name into an compareable array
  *
  * @return array
  */
  private function _getCSSPropertyElements($propertyName) {
    if (substr($propertyName, 0, 1) == '-') {
      $pos = strpos($propertyName, '-', 1);
      $items = explode('-', substr($propertyName, $pos + 1));
      $items[] = substr($propertyName, 1, $pos);
      return $items;
    } else {
      $items = explode('-', $propertyName);
      return $items;
    }
  }
}
<?php

/**
 * Subclass for representing a row from the 'role' table.
 *
 *
 *
 * @package lib.model
 */
class QubitRole extends BaseRole
{
  public function __toString()
    {
    return (string) $this->getName();
    }
}

<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * Qubit Toolkit is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Qubit Toolkit.  If not, see <http://www.gnu.org/licenses/>.
 */

class QubitSlug extends BaseSlug
{
  public static function random()
  {
    $slug = null;

    $alphabet = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    // Probability of collision is approximately the number of rows in slug
    // table over getrandmax(), so the probability increases with the number
    // of rows
    //
    // More accurately, probability is number of slugs containing only digits
    // and letters over getrandmax() - but this is most slugs
    //
    // For constant probability and increasing slug length, COUNT() the slug
    // table, but then it'd be better to use an SQL expression for the slug
    $rand = rand();
    while (62 < $rand)
    {
      $slug .= $alphabet[$rand % 62];
      $rand /= 62;
    }

    return $slug;
  }

  public static function slugify($slug)
  {
    // Handle exotic characters gracefully
    $slug = iconv('utf-8', 'ascii//TRANSLIT', $slug);

    $slug = strtolower($slug);

    // Allow only digits, letters, and dashes.  Replace sequences of other
    // characters with dash
    $slug = preg_replace('/[^0-9a-z]+/', '-', $slug);

    // Drop (English) articles
    $slug = "-$slug-";
    $slug = str_replace('-a-', '-', $slug);
    $slug = str_replace('-an-', '-', $slug);
    $slug = str_replace('-the-', '-', $slug);

    $slug = trim($slug, '-');

    return $slug;
  }
}

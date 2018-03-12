/*
    Some really funny web dev gave you an array of numbers from his API response as an array of strings!

    You need to cast the whole array to the correct type.

    Create the function that takes as a parameter an array of numbers represented as strings and outputs an array of numbers.

    ie:["1", "2", "3"] to [1, 2, 3]

    Note that you can receive floats as well.

    Url: https://www.codewars.com/kata/5783d8f3202c0e486c001d23
*/

function toNumberArray(array $stringArray) : array {
  return array_map(function($v) {
      return $v * 1;
    }, $stringArray);
}

/* or */

function toNumberArray(array $stringArray) : array {
  return array_map(function($v) {
      return +$v;
    }, $stringArray);
}
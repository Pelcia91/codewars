/*
    Build a function sumNestedNumbers/sum_nested_numbers that finds the sum of all numbers in a series of nested arrays raised to the power of their respective nesting levels. Numbers in the outer most array should be raised to the power of 1.

    For example,

    sum_nested_numbers([1, [2], 3, [4, [5]]]);
    should return 1 + 2*2 + 3 + 4*4 + 5*5*5 === 149

    Url: https://www.codewars.com/kata/5845e6a7ae92e294f4000315
*/

function sum_nested_numbers(array $array, $depth = 1): int {

  $sum = 0;

  array_map(function($element) use ($depth, &$sum) {
    if(is_array($element)) {
       $sum += sum_nested_numbers($element, ++$depth);
    }
    else {
      $sum += $element ** $depth;
    }
  }, $array);

  return $sum;
}
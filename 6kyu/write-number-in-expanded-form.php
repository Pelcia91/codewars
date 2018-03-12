/*
    Write Number in Expanded Form

    You will be given a number and you will need to return it as a string in Expanded Form. For example:

    expanded_form(12); // Should return "10 + 2"
    expanded_form(42); // Should return "40 + 2"
    expanded_form(70304); // Should return "70000 + 300 + 4"

    NOTE: All numbers will be whole numbers greater than 0.

    Url: https://www.codewars.com/kata/5842df8ccbd22792a4000245
*/


function expanded_form(int $n): string {
  $length = strlen($n);
  $array = str_split($n);
  $temp = [];

  array_walk($array, function($n) use (&$temp, &$length) {
    $number = $n * (10 ** --$length);
    if($number !== 0) {
      array_push($temp, $number);
    }
  });

  return implode(' + ', $temp);
}
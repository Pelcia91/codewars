/*
    Build Tower
    Build Tower by the following given argument:
    number of floors (integer and always greater than 0).

    Tower block is represented as *

    Python: return a list;
    JavaScript: returns an Array;
    C#: returns a string[];
    PHP: returns an array;
    C++: returns a vector<string>;
    Haskell: returns a [String];
    Ruby: returns an Array;
    Have fun!

    for example, a tower of 3 floors looks like below

    [
    '  *  ',
    ' *** ',
    '*****'
    ]
    and a tower of 6 floors looks like below

    [
    '     *     ',
    '    ***    ',
    '   *****   ',
    '  *******  ',
    ' ********* ',
    '***********'
    ]

    Url: https://www.codewars.com/kata/576757b1df89ecf5bd00073b
*/

function tower_builder(int $n): array {
  $top = 1;
  $array = [];
  for($i = $top; $i <= $n; $i++) {
      array_push($array, str_pad(str_pad("*",  $top , "*"),  ($n * 2 - 1), " ", STR_PAD_BOTH));
      $top += 2;
  }

  return $array;
}
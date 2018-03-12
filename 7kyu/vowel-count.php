/*
    Return the number (count) of vowels in the given string.

    We will consider a, e, i, o, and u as vowels for this Kata.

    The input string will only consist of lower case letters and/or spaces.

    Url: https://www.codewars.com/kata/54ff3102c1bad923760001f3
*/

function getCount($str) {
  $vowelsCount = 0;
  $vowels = ['a', 'e', 'i', 'o', 'u'];

  array_map(function($v) use (&$vowelsCount, $str) {
      if(substr_count($str, $v))
        $vowelsCount += substr_count($str, $v);
  }, $vowels);

  return $vowelsCount;
}
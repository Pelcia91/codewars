/*
    There is an array with some numbers. All numbers are equal except for one. Try to find it!

    findUniq([ 1, 1, 1, 2, 1, 1 ]) === 2
    findUniq([ 0, 0, 0.55, 0, 0 ]) === 0.55
    It’s guaranteed that array contains more than 3 numbers.

    The tests contain some very huge arrays, so think about performance.
*/

function find_uniq($array)
{
  $counter = [];

    foreach($array as $value)
    {
      $value = (string)$value; // array have only numbers, we must cast array keys, because "Floats and numeric string in key are truncated to integer."
      if( !isset ($counter[$value]) )
      {
        $counter[$value] = 1;
      } else {
        $counter[$value]++;
      }
    }

    foreach($counter as $key => $value) {
      if($value == 1) {
       return $key;
       }
    }
}
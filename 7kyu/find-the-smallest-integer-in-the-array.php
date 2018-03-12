/*
    Given an array of integers your solution should find the smallest integer.

    For example:
    Given [34, 15, 88, 2] your solution will return 2
    Given [34, -345, -1, 100] your solution will return -345
    You can assume, for the purpose of this kata, that the supplied array will not be empty.

    Url: https://www.codewars.com/kata/55a2d7ebe362935a210000b2
*/

function smallestInteger ($arr) {
    sort($arr, SORT_NUMERIC);
    return $arr[0] ?? null ;
}

/* or */

function smallestInteger ($arr) {
    return min($arr);
}
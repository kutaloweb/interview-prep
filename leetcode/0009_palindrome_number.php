<?php

// 9. Palindrome Number

// Easy
// Determine whether an integer is a palindrome. An integer is a palindrome when it reads the same backward as forward.
// Follow up: Could you solve it without converting the integer to a string?
// Example 1:
// Input: x = 121
// Output: true
// Example 2:
// Input: x = -121
// Output: false
// Explanation: From left to right, it reads -121. From right to left, it becomes 121-. Therefore it is not a palindrome.
// Example 3:
// Input: x = 10
// Output: false
// Explanation: Reads 01 from right to left. Therefore it is not a palindrome.
// Example 4:
// Input: x = -101
// Output: false

// Compare with Reversed Number Approach

//  1. We repeatedly pop the last digit off of $x and push it to the back of the result.
//  2. We compare the reverted number with the original argument "$x".

// Time complexity: O(log10(x)), because each iteration divides the input by 10

// Trace table

// $x = 121
// $temp = 121

// $temp > 0  $digit   $temp     $revertedNum        $x === $revertedNum
//    T         1        12    0 * 10 + 1 = 1              -
//    T         2        1     1 * 10 + 2 = 12             -
//    T         1        0     12 * 10 + 1 = 121           -
//    F         -        -          -                      T

function isPalindrome($x) {
    if ($x < 0) return false;
    $revertedNum = 0;
    $temp = $x;
    while ($temp > 0) {
        $digit = $temp % 10;
        $temp = floor($temp / 10);
        $revertedNum = $revertedNum * 10 + $digit;
    }
    return $x === $revertedNum;
}

var_dump(isPalindrome(121));

// Convert to String Approach (Two Pointers Approach)

// 1. After value of our argument has been converted into a string, we can find the middle.
// 2. We start traversing inwards until the pointers meet in the middle.
//     2.1. If the input is palindromic, both the pointers should point to equivalent characters, at all times.
//     2.2. If this condition is not met at any point of time, we break and return early.

// Time complexity: O(x)

// Trace table

// $x = 121
// $str = '121'
// $mid = 1

//  $i   $str[$i]    $str[strlen($str) - 1 - $i]     !==
//  0    $str[0] '1'        $str[2] '1'               F

function isPalindrome2($x) {
    if ($x < 0) return false;
    $str = (string) $x;
    $mid = floor(strlen($str) / 2);
    for ($i = 0; $i < $mid; $i++) {
        if ($str[$i] !== $str[strlen($str) - 1 - $i]) {
            return false;
        }
    }
    return true;
}

var_dump(isPalindrome2(121));

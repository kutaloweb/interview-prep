<?php

// 7. Reverse Integer

// Easy
// Given a 32-bit signed integer, reverse digits of an integer.
// Assume we are dealing with an environment that could only store integers within the 32-bit signed integer range: [−231,  231 − 1]. For the purpose of this problem, assume that your function returns 0 when the reversed integer overflows.
// Example 1:
// Input: x = 123
// Output: 321
// Example 2:
// Input: x = -123
// Output: -321
// Example 3:
// Input: x = 120
// Output: 21
// Example 4:
// Input: x = 0
// Output: 0

// Pop and Push Digits Approach (Modulo Operator Approach)

//  1. We repeatedly pop the last digit off of $x and push it to the back of the result.
//      1.1. We use "$d = $x % 10; $x = $x / 10" for the pop operation and "$res = $res * 10 + $d" for the push operation.
//      1.2. Before returning the result we check whether it can cause an overflow and whether is negative or not.

// Time complexity: O(log(x))

// Trace table

// $x = -123
// $sign = -1
// $temp = 123

// $temp > 0  $digit   $temp      $result          $sign * $result
//   T          3        12    0 * 10 + 3 = 3            -
//   T          2        1     3 * 10 + 2 = 32           -
//   T          1        0     32 * 10 + 1 = 321        -321

function reverse($x) {
    $result = 0;
    $sign = $x > 0 ? 1 : -1;
    $temp = $sign * $x;
    while ($temp > 0) {
        $digit = $temp % 10;
        $temp = floor($temp / 10);
        $result = $result * 10 + $digit;
    }
    return $result > 2 ** 31 - 1 ? 0 : $sign * $result;
}

print(reverse(-123));

// Naive Approach (Built-in Reverse Method Approach)

// 1. After absolute value of our argument has been converted into a string, we can call strrev() to reverse it.
// 2. Before returning the parseInt(result) we check whether it can cause an overflow and whether is negative or not.

// Time complexity: O(x)

// Trace table

// $x = -123
// $sign = -1

//  abs()   strval()    strrev()   $sign * intval()
//   123     "123"       "321"          -321

function reverse2($x) {
    $sign = $x > 0 ? 1 : -1;
    $result = strrev(strval(abs($x)));
    return intval($result) > 2 ** 31 - 1 ? 0 : $sign * intval($result);
}

print(reverse2(-123));

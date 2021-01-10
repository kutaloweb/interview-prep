<?php

// 13. Roman to Integer

// Easy
// Roman numerals are represented by seven different symbols: I, V, X, L, C, D and M.
// Symbol       Value
// I             1
// V             5
// X             10
// L             50
// C             100
// D             500
// M             1000
// For example, 2 is written as II in Roman numeral, just two one's added together. 12 is written as XII, which is simply X + II. The number 27 is written as XXVII, which is XX + V + II.
// Roman numerals are usually written largest to smallest from left to right. However, the numeral for four is not IIII. Instead, the number four is written as IV.
// Because the one is before the five we subtract it making four.
// The same principle applies to the number nine, which is written as IX. There are six instances where subtraction is used:
// I can be placed before V (5) and X (10) to make 4 and 9.
// X can be placed before L (50) and C (100) to make 40 and 90.
// C can be placed before D (500) and M (1000) to make 400 and 900.
// Given a roman numeral, convert it to an integer.
// Example 1:
// Input: s = "III"
// Output: 3
// Example 2:
// Input: s = "IV"
// Output: 4
// Example 3:
// Input: s = "IX"
// Output: 9
// Example 4:
// Input: s = "LVIII"
// Output: 58
// Explanation: L = 50, V= 5, III = 3.
// Example 5:
// Input: s = "MCMXCIV"
// Output: 1994
// Explanation: M = 1000, CM = 900, XC = 90 and IV = 4.

// Hashing Approach

// 1. We traverse a string and pick each character at a time and convert each character into the value it represents.
// 2. If current value of numeral is less than the value of next numeral, then we subtract this value from the running result.
// 3. Else we add this value to the result.

// Time complexity: O(s)

// Trace table

// $s = "MCMXCIV"
// $result = 0

// $i   $current   $next   $current < $next   $result
// 0      1000      100         F               1000
// 1      100       1000        T               900
// 2      1000      10          F               1900
// 3      10        100         T               1890
// 4      100       1           F               1990
// 5      1         5           T               1989
// 6      5         0           F               1994

function romanToInt($s) {
    $map = ['I' => 1, 'V' => 5, 'X' => 10, 'L' => 50, 'C' => 100, 'D' => 500, 'M' => 1000];
    $result = 0;
    for ($i = 0; $i < strlen($s); $i++) {
        $current = isset($map[$s[$i]]) ? $map[$s[$i]] : 0;
        $next = isset($s[$i + 1]) && isset($map[$s[$i + 1]]) ? $map[$s[$i + 1]] : 0;
        if ($current < $next) {
            $result -= $current;
        } else {
            $result += $current;
        }
    }
    return $result;
}

var_dump(romanToInt("MCMXCIV"));

// Switch Case Approach (Brute Force Approach)

//  1. We traverse a string and pick each character at a time.
//  2. For characters "I", "X", "C" we add or subtract value, based on the value of the next character.
//  3. For other characters we only add value to result.

// Time complexity: O(s)

// Trace table

// $s = "MCMXCIV"
// $result = 0

//  $i    $j  $s[$i] $next  $result
//  0     1     M      C      1000
//  1     2     C      M      900
//  2     3     M      X      1900
//  3     4     X      C      1890
//  4     5     C      I      1990
//  5     6     I      V      1989
//  6     7     V     NULL    1994

function romanToInt2($s) {
    $result = 0;
    for ($i = 0; $i < strlen($s); $i++) {
        $next = isset($s[$i + 1]) ? $s[$i + 1] : null;
        switch ($s[$i]) {
            case "I":
                if ($next === "V" || $next === "X") {
                    $result -= 1;
                } else {
                    $result += 1;
                }
                break;
            case "V":
                $result += 5;
                break;
            case "X":
                if ($next === "L" || $next === "C") {
                    $result -= 10;
                } else {
                    $result += 10;
                }
                break;
            case "L":
                $result += 50;
                break;
            case "C":
                if ($next === "D" || $next === "M") {
                    $result -= 100;
                } else {
                    $result += 100;
                }
                break;
            case "D":
                $result += 500;
                break;
            case "M":
                $result += 1000;
                break;
            default:
                $result = 0;
                break;
        }
    }
    return $result;
}

var_dump(romanToInt2("MCMXCIV"));

<?php

// 28. Implement strStr()

// Easy
// Implement strStr().
// Return the index of the first occurrence of needle in haystack, or -1 if needle is not part of haystack.
// Clarification:
// What should we return when needle is an empty string? This is a great question to ask during an interview.
// For the purpose of this problem, we will return 0 when needle is an empty string. This is consistent to C's strstr() and Java's indexOf().
// Example 1:
// Input: haystack = "hello", needle = "ll"
// Output: 2
// Example 2:
// Input: haystack = "aaaaa", needle = "bba"
// Output: -1
// Example 3:
// Input: haystack = "", needle = ""
// Output: 0

// Substring Approach

// 1. We specify a fixed sliding window (based on the needle length) that checks each substring in the haystack if it matches needle.
// 2. We return the index that we had in the loop.

// Time complexity: O(n²)

// Trace table

// $haystack = "hello"
// $needle = "ll"

// $i  substr === $needle   substr($haystack, $i, strlen($needle))
//  0          F                        he
//  1          F                        el
//  2          T                        ll

function strStr1($haystack, $needle) {
    if (strlen($needle) === 0) return 0;
    for ($i = 0; $i <= strlen($haystack) - strlen($needle); $i++) {
        if (substr($haystack, $i, strlen($needle)) === $needle) {
            return $i;
        }
    }
    return -1;
}

var_dump(strStr1("hello", "ll"));

// Brute Force Approach

// 1. For each character in the haystack we check if its succeeding characters match each character of the needle.
//     1.1. We use $haystack[$i + $j] in the inner loop.
//     1.2. If there is a mismatch with $needle[$j] then we just break out of the loop.
//     1.3. When inner loop finishes we should have a check if strlen($needle) === $j, in which we can return the index that we had in the outer loop.

// Time complexity: O(mn)

// Trace table

// $haystack = "hello"
// $needle = "ll"

// $i  $haystack[$i] === $needle[0]   j    $haystack[$i + $j] !== $needle[$j]   strlen($needle) === $j
// 0            F                     -                  -                              -
// 1            F                     -                  -                              -
// 2            T                     0               l !== l  F                     2 === 0 F
// 2            -                     1               l !== l  F                     2 === 1 F
// 2            -                     2               l !== o  T                     2 === 2 T

function strStr2($haystack, $needle) {
    if (strlen($needle) === 0) return 0;
    for ($i = 0; $i <= strlen($haystack) - strlen($needle); $i++) {
        if ($haystack[$i] === $needle[0]) {
            for ($j = 0; $j < strlen($needle); $j++) {
                if ($haystack[$i + $j] !== $needle[$j]) {
                    break;
                }
            }
            if (strlen($needle) === $j) {
                return $i;
            }
        }
    }
    return -1;
}

var_dump(strStr2("hello", "ll"));

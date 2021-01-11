<?php

// 20. Valid Parentheses

// Easy
// Given a string s containing just the characters '(', ')', '{', '}', '[' and ']',
// determine if the input string is valid.
// An input string is valid if:
// Open brackets must be closed by the same type of brackets.
// Open brackets must be closed in the correct order.
// Example 1:
// Input: s = "()"
// Output: true
// Example 2:
// Input: s = "()[]{}"
// Output: true
// Example 3:
// Input: s = "(]"
// Output: false
// Example 4:
// Input: s = "([)]"
// Output: false
// Example 5:
// Input: s = "{[]}"
// Output: true

// Stack Naive Approach

// 1. We initialize a stack to be used in the algorithm.
// 2. We process each bracket of the expression one at a time.
// 3. If we encounter an opening bracket, we simply push it onto the stack. We will process it later.
// 4. If we encounter a closing bracket, we check the element on top of the stack.
//     4.1. If the element at the top of the stack is an opening bracket of the same type then we pop it off the stack.
//     4.2. Else, this implies an invalid expression.
// 5. In the end, if we are left with a stack still having elements, then this implies an invalid expression.

// Time complexity: O(n)

// Trace table

// $s = "{[]}"

// $char  $char === '{'  $char === '['   $char === '('  peek === '{'  peek === '('  peek === '['    $data
//  '{'        T              -               -              -             -            -          [ '{' ]
//  '['        -              T               -              -             -            -          [ '{', '[' ]
//  ']'        F              F               F              -             -            T          [ '{' ]
//  '}'        F              F               F              T             -            -          [ ]

class Stack
{
    private $data = [];

    public function push($val)
    {
        array_push($this->data, $val);
    }

    public function pop()
    {
        return array_pop($this->data);
    }

    public function peek()
    {
        return isset($this->data[count($this->data) - 1]) ? $this->data[count($this->data) - 1] : null;
    }

    public function isEmpty()
    {
        return count($this->data) === 0;
    }
}

function isValid($s) {
    $stack = new Stack();
    foreach (str_split($s) as $char) {
        if ($char === '{' || $char === '[' || $char === '(') {
            $stack->push($char);
        } else if ($char === '}' && $stack->peek() === '{') {
            $stack->pop();
        } else if ($char === ')' && $stack->peek() === '(') {
            $stack->pop();
        } else if ($char === ']' && $stack->peek() === '[') {
            $stack->pop();
        } else {
            return false;
        }
    }
    return $stack->isEmpty();
}

var_dump(isValid("{[]}"));

// Stack with Mapping Approach

// 1. We initialize a stack and the mapping where key is the closing bracket and value is the opening bracket.
// 2. We process each bracket of the expression one at a time.
// 3. If we encounter an opening bracket, we simply push it onto the stack. We will process it later.
// 4. If we encounter a closing bracket, we check the element on top of the stack (whether the mapping for this bracket matches)
//     4.1. If the element at the top of the stack is an opening bracket of the same type then we pop it off the stack.
//     4.2. Else, this implies an invalid expression.
// 5. In the end, if we are left with a stack still having elements, then this implies an invalid expression.

// Time complexity: O(n)

// Trace table

// s = "{[]}"

// $char  key_exists  $topElement  $topElement !== $map[$char]    $data
//  '{'      F            -                 -                    [ '{' ]
//  '['      F            -                 -                    [ '{', '[' ]
//  ']'      T           '['                F                    [ '{' ]
//  '}'      T           '{'                F                    [ ]

class Stack2
{
    private $data = [];

    public function push($val)
    {
        array_push($this->data, $val);
    }

    public function pop()
    {
        return array_pop($this->data);
    }

    public function isEmpty()
    {
        return count($this->data) === 0;
    }
}

function isValid2($s) {
    $map = [')' => '(', '}' => '{', ']' => '['];
    $stack = new Stack2();
    foreach (str_split($s) as $char) {
        if (array_key_exists($char, $map)) {
            $topElement = $stack->pop();
            if ($topElement !== $map[$char]) {
                return false;
            }
        } else {
            $stack->push($char);
        }
    }
    return $stack->isEmpty();
}

var_dump(isValid2("{[]}"));

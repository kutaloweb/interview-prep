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

// s = "{[]}"

// char  char === '{'  char === '['   char === '('  peek === '{'  peek === '(' peek === '['  this.data
//  '{'       T              -              -            -             -           -          [ '{' ]
//  '['       -              T              -            -             -           -          [ '{', '[' ]
//  ']'       F              F              F            -             -           T          [ '{' ]
//  '}'       F              F              F            T             -           -          [ ]

class Stack {
    constructor() {
        this.data = []
    }

    push(val) {
        this.data.push(val)
    }

    pop() {
        return this.data.pop()
    }

    peek() {
        return this.data[this.data.length - 1]
    }

    isEmpty() {
        return this.data.length === 0
    }
}

function isValid(s) {
    let stack = new Stack()
    for (let char of s) {
        if (char === '{' || char === '[' || char === '(') {
            stack.push(char)
        } else if (char === '}' && stack.peek() === '{') {
            stack.pop()
        } else if (char === ')' && stack.peek() === '(') {
            stack.pop()
        } else if (char === ']' && stack.peek() === '[') {
            stack.pop()
        } else {
            return false
        }
    }
    return stack.isEmpty()
}

console.log(isValid("{[]}"))

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

// char  in map  topElement  topElement !== map[char]  this.data
//  '{'    F          -             -                   [ '{' ]
//  '['    F          -             -                   [ '{', '[' ]
//  ']'    T         '['            F                   [ '{' ]
//  '}'    T         '{'            F                   [ ]

class Stack2 {
    constructor() {
        this.data = []
    }

    push(val) {
        this.data.push(val)
    }

    pop() {
        return this.data.pop()
    }

    isEmpty() {
        return this.data.length === 0
    }
}

function isValid2(s) {
    let map = {')': '(', '}': '{', ']': '['}
    let stack = new Stack2()
    for (let char of s) {
        if (char in map) { // map.hasOwnProperty(char)
            let topElement = stack.pop()
            if (topElement !== map[char]) {
                return false
            }
        } else {
            stack.push(char)
        }
    }
    return stack.isEmpty()
}

console.log(isValid2("{[]}"))

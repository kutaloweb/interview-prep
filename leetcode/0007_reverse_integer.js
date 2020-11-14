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

//  1. We repeatedly pop the last digit off of x and push it to the back of the result.
//      1.1. We use "d = x % 10; x = x / 10" for the pop operation and "res = res * 10 + d" for the push operation.
//      1.2. Before returning the result we check whether it can cause an overflow and whether is negative or not.

// Time complexity: O(log(x))

// Trace table

// x = -123
// sign = -1
// temp = 123

// temp > 0  digit   temp     result             sign * result
//   T        3       12    0 * 10 + 3 = 3            -
//   T        2       1     3 * 10 + 2 = 32           -
//   T        1       0     32 * 10 + 1 = 321        -321

function reverse(x) {
    let result = 0
    let sign = x > 0 ? 1 : -1
    let temp = sign * x
    while (temp > 0) {
        let digit = temp % 10
        temp = Math.floor(temp / 10)
        result = result * 10 + digit
    }
    return result > 2 ** 31 - 1 ? 0 : sign * result
}

console.log(reverse(-123))

// Naive Approach (Built-in Reverse Method Approach)

// 1. After absolute value of our argument has been converted into a string, we can call split('') on it which turns it into an array.
// 2. Once split, we can then call reverse() on the new array to reverse it.
// 3. Lastly, we’ll join our array back into a string with join('').
// 4. Before returning the parseInt(result) we check whether it can cause an overflow and whether is negative or not.

// Time complexity: O(x)

// Trace table

// x = -123
// sign = -1

//  Math.abs(x)   toString()    split('')         reverse()      join('')  sign * parseInt
//     123          "123"   [ '1', '2', '3' ]  [ '3', '2', '1' ]  "321"         -321

function reverse2(x) {
    let sign = x > 0 ? 1 : -1
    const result = Math.abs(x).toString().split('').reverse().join('')
    return parseInt(result) > 2 ** 31 - 1 ? 0 : sign * parseInt(result)
}

console.log(reverse2(-123))

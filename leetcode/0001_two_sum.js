// 1. Two Sum

// Easy
// Given an array of integers nums and an integer target, return indices of the two numbers such that they add up to target.
// You may assume that each input would have exactly one solution, and you may not use the same element twice.
// You can return the answer in any order.
// Example 1:
// Input: nums = [2,7,11,15], target = 9
// Output: [0,1]
// Output: Because nums[0] + nums[1] == 9, we return [0, 1].
// Example 2:
// Input: nums = [3,2,4], target = 6
// Output: [1,2]
// Example 3:
// Input: nums = [3,3], target = 6
// Output: [0,1]

// Hashing Approach (Two-pass Hash Table Approach)

// 1. In the first iteration, we add each element's value and its index to the hash table.
// 2. Then, in the second iteration we check if each element's complement (target − nums[i]) exists in the table.
//     2.1. We take the current number, determining what needs to be added to reach the target, and checking if that exists in the hash table.
//     2.2. If it does exist, and isn’t the same index as the current number, we are done. Otherwise, we check the next number in the list.

// Time complexity: O(n)

// Trace table

// nums = [6, 8, 2, 11, 7]
// target = 9
// map = { 2: 2, 6: 0, 7: 4, 8: 1, 11: 3 }

// i            j                j && j !== i  [i, j]
// 0     map[9 - 6] undefined         F          -
// 1     map[9 - 8] undefined         F          -
// 2     map[9 - 2] 4                 T       [ 2, 4 ]

function twoSum(nums, target) {
    let map = {}
    for (let i = 0; i < nums.length; i++) {
        map[nums[i]] = i
    }
    for (let i = 0; i < nums.length; i++) {
        let j = map[target - nums[i]]
        if (j && j !== i) {
            return [i, j]
        }
    }
}

console.log(twoSum([6, 8, 2, 11, 7], 9))

// Naive Approach (Brute Force Approach)

// 1. We start at the first number, and try adding it to every possible number in the list.
//     1.1 When we pick an i value, we set j to be i + 1, since we don’t want to start checking at the value i, but rather the next available value.
//     1.2 We check if the number at the index i, plus the number at index j is equal to the target.
// 2. Then we repeat the same with the next number, until either a solution is found, or we run out of numbers.

// Time complexity: O(n²)

// Trace table

// nums = [6, 8, 2, 11, 7]
// target = 9

// i  j  nums[i] + nums[j]
// 0  1          14
// 0  2          8
// 0  3          17
// 0  4          13
// 1  2          10
// 1  3          19
// 1  4          15
// 2  3          13
// 2  4          9

function twoSum2(nums, target) {
    for (let i = 0; i < nums.length; i++) {
        for (let j = i + 1; j < nums.length; j++) {
            if (nums[i] + nums[j] === target) {
                return [i, j]
            }
        }
    }
}

console.log(twoSum2([6, 8, 2, 11, 7], 9))

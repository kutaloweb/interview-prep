// 26. Remove Duplicates from Sorted Array

// Easy
// Given a sorted array nums, remove the duplicates in-place such that each element appears only once and returns the new length.
// Do not allocate extra space for another array, you must do this by modifying the input array in-place with O(1) extra memory.
// Example 1:
// Input: nums = [1,1,2]
// Output: 2, nums = [1,2]
// Explanation: Your function should return length = 2, with the first two elements of nums being 1 and 2 respectively. It doesn't matter what you leave beyond the returned length.
// Example 2:
// Input: nums = [0,0,1,1,1,2,2,3,3,4]
// Output: 5, nums = [0,1,2,3,4]
// Explanation: Your function should return length = 5, with the first five elements of nums being modified to 0, 1, 2, 3, and 4 respectively. It doesn't matter what values are set beyond the returned length.

// Two Pointers Approach (Constant Extra Space Approach)

// 1. We keep two pointers cur and prev, where cur is the slow-runner while prev is the fast-runner.
// 2. When we encounter nums[cur] !== nums[prev], we increment prev to skip the duplicate and assign nums[cur] to nums[prev].

// Time complexity: O(n)

// Trace table

// nums = [0, 0, 1, 1, 1, 2, 2, 3, 3, 4]
// prev = 0

// cur   nums[cur] !== nums[prev]    prev                    nums
//  0          0 !== 0  F             0         [ 0, 0, 1, 1, 1, 2, 2, 3, 3, 4 ]
//  1          0 !== 0  F             0         [ 0, 0, 1, 1, 1, 2, 2, 3, 3, 4 ]
//  2          1 !== 0  T             1         [ 0, 1, 1, 1, 1, 2, 2, 3, 3, 4 ]
//  3          1 !== 1  F             1         [ 0, 1, 1, 1, 1, 2, 2, 3, 3, 4 ]
//  4          1 !== 1  F             1         [ 0, 1, 1, 1, 1, 2, 2, 3, 3, 4 ]
//  5          2 !== 1  T             2         [ 0, 1, 2, 1, 1, 2, 2, 3, 3, 4 ]
//  6          2 !== 2  F             2         [ 0, 1, 2, 1, 1, 2, 2, 3, 3, 4 ]
//  7          3 !== 2  T             3         [ 0, 1, 2, 3, 1, 2, 2, 3, 3, 4 ]
//  8          3 !== 3  F             3         [ 0, 1, 2, 3, 1, 2, 2, 3, 3, 4 ]
//  9          4 !== 3  T             4         [ 0, 1, 2, 3, 4 ]

function removeDuplicates(nums) {
    let prev = 0
    for (let cur = 0; cur < nums.length; cur++) {
        if (nums[cur] !== nums[prev]) {
            prev++
            nums[prev] = nums[cur]
        }
    }
    nums = nums.slice(0, prev + 1);
    console.log(nums)
    return prev + 1
}

console.log(removeDuplicates([0, 0, 1, 1, 1, 2, 2, 3, 3, 4]))

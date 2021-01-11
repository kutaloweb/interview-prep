// 14. Longest Common Prefix

// Easy
// Write a function to find the longest common prefix string amongst an array of strings.
// If there is no common prefix, return an empty string "".
// Example 1:
// Input: strs = ["flower","flow","flight"]
// Output: "fl"
// Example 2:
// Input: strs = ["dog","racecar","car"]
// Output: ""
// Explanation: There is no common prefix among the input strings.

// Vertical Scanning Approach

// 1. We compare characters from top to bottom on the same column (same character index of the strings) before moving on to the next column.
//     1.1. We scan all the characters at index 0 then index 1 then index 2 and so on.
//     1.2. We return substring of the first string from 0 to i when we find different character.
//     1.3. We return strs[0] in case if there is just one string or same strings in the array.

// Time complexity: O(S), where S is the sum of all characters in all strings.

// Trace table

// strs = ["flower","flow","flight"]

// i   j   current  strs[j][i] !== current   strs[0].substring(0, i)
// 0   1      f           f !== f F                      -
// 0   2      f           f !== f F                      -
// 1   1      l           l !== l F                      -
// 1   2      l           l !== l F                      -
// 2   1      o           o !== o F                      -
// 2   2      o           i !== o T         "flower".substring(0, 2) fl

function longestCommonPrefix(strs) {
    if (strs.length === 0 || strs[0] === "") return ""
    for (let i = 0; i < strs[0].length; i++) {
        let current = strs[0][i]
        for (let j = 1; j < strs.length; j++) {
            if (strs[j][i] !== current) {
                return strs[0].substring(0, i)
            }
        }
    }
    return strs[0]
}

console.log(longestCommonPrefix(["flower", "flow", "flight"]))

// Horizontal Scanning Approach

// 1. We iterate through the strings, finding at each iteration the longest common prefix.
//     1.1. We find the longest common prefix of strs[0] with strs[1] with strs[2] and so on.
//     1.2  We compare the prefix of each string with the prefix variable and update the prefix accordingly cutting it from the end.
//     1.3. When prefix is empty string or when we found the common prefix in the last string, the algorithm ends.

// Time complexity: O(S), where S is the sum of all characters in all strings.

// Trace table

// strs = ["flower", "flow", "flight"]
// prefix = "flower"

// i    strs[i].indexOf(prefix)       prefix
// 1  "flow".indexOf("flower") -1     flowe
// 1  "flow".indexOf("flowe") -1      flow
// 1  "flow".indexOf("flow") 0        flow
// 2  "flight".indexOf("flow") -1     flo
// 2  "flight".indexOf("flo") -1      fl
// 2  "flight".indexOf("fl") 0        fl

function longestCommonPrefix2(strs) {
    if (strs.length === 0 || strs[0] === "") return ""
    let prefix = strs[0]
    for (let i = 1; i < strs.length; i++) {
        while (strs[i].indexOf(prefix) !== 0) {
            prefix = prefix.substring(0, prefix.length - 1)
        }
    }
    return prefix
}

console.log(longestCommonPrefix2(["flower", "flow", "flight"]))

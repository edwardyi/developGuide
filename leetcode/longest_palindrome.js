var longestPalindrome = function(s) {
  if(s.length < 2) {
    return s;
  }

  // left 0
  // right 0
  let left =0, right=0;
  for(let i=0; i <= s.length;i++) {
    // 找左邊
    let leftLen = findPair(s, i, i);
    // 找右邊
    let rightLen = findPair(s, i, i+1);
    // 取最大長度
    
    let maxLen = Math.max(leftLen, rightLen);
    if (maxLen > right - left){
      left = i - Math.floor((maxLen -1) / 2);
      right = i + Math.floor(maxLen / 2);
    }
    // console.log(maxLen,left,right,s.substring(left,right+1));
  }
  // console.log(left,right,s.substring(left,right+1));
  
  return (left==right) ? s.charAt(0) : s.substring(left, right+1);
};

var findPair = function(s, left, right){
  // 左右兩邊的字元相同
  while(left >= 0 && right <= s.length && s.charAt(left)== s.charAt(right)) {
    left = left - 1;
    right = right + 1;
  }
  return right - left - 1;
}


console.log(longestPalindrome("bbb")=="bbb")
console.log(longestPalindrome("bb")=="bb");
console.log(longestPalindrome("a")=="a");
console.log(longestPalindrome("ac")=="a");
console.log(longestPalindrome("")=="");
console.log(longestPalindrome("babad") == "bab");
console.log(longestPalindrome("cbbd") == "bb");
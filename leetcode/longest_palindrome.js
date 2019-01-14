var longestPalindrome = function(s) {
  if(s.length <= 1) {
    return s;
  }
  let table = [];
  // 把回文字串放到table中(Time Limit Exceeded)
  for(let i= 0; i <= s.length;i++) {
    for(let j=0; j <= s.length;j++) {
      var str = s.substring(i,j);
      if (str.length > 0 && str == str.split("").reverse().join("")) {
        table.push(str);
      }
    }
  }
  // console.log('test',table.sort(function(a,b) {return b.length - a.length}));
  return table.sort(function(a,b) {return b.length - a.length})[0];
};


console.log(longestPalindrome("bbb")=="bbb")
console.log(longestPalindrome("bb")=="bb");
console.log(longestPalindrome("a")=="a");
console.log(longestPalindrome("")=="");
console.log(longestPalindrome("babad") == "bab");
console.log(longestPalindrome("cbbd") == "bb");
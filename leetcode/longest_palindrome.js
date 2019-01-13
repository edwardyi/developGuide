var longestPalindrome = function(s) {
  if(s.length < 0) {
    return s;
  }
  let table = [];
  // 把回文字串放到table中
  for(let i= 0; i < s.length;i++) {
    for(let j=0;j<s.length;j++) {
      var str = s.substring(i,j);
      if (str.length > 0 && str == str.split("").reverse().join("")) {
        table.push(str);
      }
    }
  }

  // 找出最長的回文字串
  // let result = table[0];
  // for(let i=0; i<table.length; i++) {
  //   if(table[i]) {
  //     result = table[i];
  //     return true;
  //   }
  // }
  console.log(table, table.concat().sort());
  // console.log('test',table.sort(function(a,b) {return b.length - a.length}));
  return table.sort(function(a,b) {return b.length - a.length})[0];
};

console.log(longestPalindrome("babad") == "bab");
console.log(longestPalindrome("cbbd") == "bb");
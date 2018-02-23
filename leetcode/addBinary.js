/**
 * @param {string} a
 * @param {string} b
 * @return {string}
 */
var addBinary = function(a, b) {
    if (a.length == 0) return b;
    if (b.length == 0) return a;
    var longNum = a;
    var shortNum = b;
    if (a.length < b.length) {
        longNum = b;
        shortNum = a;
    } 
    
    // 反轉字串
    longNum = longNum.split("").reverse().join("");
    shortNum = shortNum.split("").reverse().join("");
    
    var sum = "";
    var carry = 0;
    
    // 先處理小的數
    for (var i=0; i<shortNum.length; i++) {
        var li = Number(longNum.charAt(i));
        var si = Number(shortNum.charAt(i));
        var cal = li + si + carry;
        
        // 用相加的結果來判斷進位與串接數字預處理
        carry = (cal > 1) ? 1 : 0;
        if (cal > 1) {
            cal = cal % 2;
        }
        
        // 串接字反串起來
        sum =  cal.toString() + sum;
    }
    
    // 處理剩下來比較長的字串數值(一樣長的情況不處理)
    for (var i=shortNum.length; i<longNum.length; i++) {
        var li = Number(longNum.charAt(i));
        var cal = li + carry;
        
        // 用相加的結果來判斷進位與串接數字預處理
        carry = (cal > 1) ? 1 : 0;
        if (cal > 1) {
            cal = cal % 2;
        }
        
        // 串接字反串起來
        sum =  cal.toString() + sum;
    }
    // 看還有沒有多的進位，有的話往前面加(要判斷大於等於1的情況)
    return (carry >= 1) ? carry.toString() + sum : sum;
    
};

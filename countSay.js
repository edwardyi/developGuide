/**
 * @param {number} n
 * @return {string}
 */
var countAndSay = function(n) {
    var str_result = "1";
    if (n <= 1) return str_result;
    
    // 目前只到第幾個元素(從第3個開始)
    var curr = 2;
    while (curr <= n)
    {
       // 每一次都取第一個[0]
       var str_num = str_result.charAt(0);
       // 第二個迴圈要判斷
       var str_tmp = str_result;
       var int_repeat_num = 1;
       // 清空輸出結果
       str_result = "";

        // 不從第一個元素開始(從第二個元素當第一個)
        // 不用比最後一個元素
       for (var i=1; i < str_tmp.length; i++)
       {
            if (str_num == str_tmp.charAt(i))
            {
                // 一樣就加1，不要append
                int_repeat_num = int_repeat_num + 1;
                
            }
            else
            {
                // 先append連續幾個數字
                str_result = str_result + int_repeat_num;
               // 接著append那個相同的數字上次
                str_result = str_result + str_num;
                // 往下移動
                str_num = str_tmp.charAt(i);
                // 初始化回1
                int_repeat_num = 1;
            }
       }
			 
         // *********key還要再複寫一次
         // 先append連續幾個數字
            str_result = str_result + int_repeat_num;
         // 接著append那個相同的數字上次
            str_result = str_result + str_num;
       curr  = curr + 1;
    }
    
    return str_result;
};

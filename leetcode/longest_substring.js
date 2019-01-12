/**
 * @param {string} s
 * @return {number}
 */
var lengthOfLongestSubstring = function(s) {
    if(s.length == 0) {
        return s;
    }
    var chars = s.split("");
    var hash = {};
    // 不存在hash中的字串不一定是最長的,需要再和最長的做比較
    var tmp_compare_str = "";
    var longest_str = "";
    for(let i=0;i < chars.length; i++)
    {
        cur_char = chars[i];
        if(!hash[cur_char]) {
            // 如果當前的字元不存在hash中
            hash[cur_char] = {'index': i};
            tmp_compare_str = tmp_compare_str + cur_char;
            // longest_str = hash['index'] + cur_char;
        } else {
            if(longest_str.length <= tmp_compare_str.length) {
                longest_str = tmp_compare_str;
            }
            
            // 把hash清空,從原來的字串取下一個可能最長字串的出來
            var tmp_hash_cur_index = hash[cur_char].index;
            var next_possible_longest_str = 
                s.substring(tmp_hash_cur_index+1, i);
            hash = {};
            // console.log('debug=>',next_possible_longest_str,tmp_hash_cur_index, i);
            // 修改str的值
            tmp_compare_str = next_possible_longest_str + cur_char ;
            
            // 把字串再拆成字元存回hash物件中
            for(let j=tmp_hash_cur_index+1; j <= i ; j++) {
                // hash[s.substring(j,1)] = {'index': j};
                hash[s.charAt(j)] = {'index': j};
            }
        }
    }
    
    console.log(longest_str, tmp_compare_str,hash);
    
    return longest_str.length > tmp_compare_str.length ? 
        longest_str.length : tmp_compare_str.length;
    
};

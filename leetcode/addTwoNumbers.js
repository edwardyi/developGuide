/**
 * Definition for singly-linked list.
 * function ListNode(val) {
 *     this.val = val;
 *     this.next = null;
 * }
 */
/**
 * @param {ListNode} l1
 * @param {ListNode} l2
 * @return {ListNode}
 */
var addTwoNumbers = function(l1, l2) {
    // 最前面的listNode預設為0，用next作為回傳的最後結果
    var resultList = new ListNode(0); 
    var curList = resultList;
    var p1 = l1, p2 = l2;
    var sum = 0;
    while (p1 != null || p2 != null) {
        
        // 如果各自都不為空就加到sum的結果中
        if (p1 != null) {
            sum = sum + p1.val;
            p1 = p1.next;
        }
        if (p2 != null) {
            sum = sum + p2.val;
            p2 = p2.next;
        }
    
        
        // 要取整數，否則會進位，影響結果
        curList.next = new ListNode(parseInt(sum % 10));
        curList = curList.next;
        // 下一次loop會用到(進位用)
        sum = parseInt(sum / 10);    
        if (sum > 0) {
            // 處理進位的情況
            curList.next = new ListNode(parseInt(sum));
        }
    }
    
    return resultList.next;
};

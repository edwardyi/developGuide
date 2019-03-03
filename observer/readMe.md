## Observer Pattern
- storeWindow和reportWindow為兩個observer負責Customer和Store兩個Model的變化
- 使用adapter pattern隔離變化
  - 換成其他儲存方式可以用到

## TODO
- 將購物清單的存放機制從Session改成cookie
- 用member_id來區別不同的消費者
- Long Polling的寫法，而不是用setInterval的方式取得資料
  - socket.io
- javascript操作
  - table input的在重新取得新資料input資料會被清掉
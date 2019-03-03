<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title;?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    .container {
      width: 400px;
    }
    table {
      border-collapse: collapse;
    }
    table tr th, table tr td {
      border: 1px solid black;
    }
    input[type="button"] {
      float:right;
    }
  </style>
  <script src="../web/base.js"></script>
  <script>
    var onBuyIt = function(e){
      var item = "buyit=true";
      var result = ajaxPostRequest("../controllers/IndexController.php?action=reportBuyList", item);
      console.log(e, result.responseText)
    }
    var onClearList = function(e) {
      var item = "clear=true";
      ajaxPostRequest("../controllers/IndexController.php?action=reportReoveList", item);
      removeRowByCellValue(document.querySelector('table'));
    }

    function onGetCustomerList()
    {
      var item = "getList=true";
      var table = document.querySelector('table');
      var xhr = ajaxPostRequest("../controllers/IndexController.php?action=getAjaxList", item);
      xhr.onload = function(){
        // var fields = new Array('name','price','amount','total_price');
        var fields = [
            {"name":"name", "type":"td"},
            {"name":"stock", "type":"td"},
            {"name":"price", "type":"td"},
            {"name":"total_price", "type":"td"}
          ];
        removeRowByCellValue(table);
        data = xhr.responseText;
        addDataToCell(table, data, fields);
      }
    }

    // Long Polling Basic
    setInterval(function(){
      onGetCustomerList();
    },  5000)
  </script>
</head>
<body>
    <div class="container">
      <table>
        <tr>
            <th>商品名稱</th>
            <th>價格</th>
            <th>購買數量</th>
            <th>金額</th>
        </tr>
        <tbody>
          <?php foreach($customers as $customer){ ?>
            <tr>
              <td><?php echo $customer['name'];?></td>
              <td><?php echo $customer['price'];?></td>
              <td><?php echo $customer['amount'];?></td>
              <td><?php echo $customer['total_price'];?></td>
            </tr>
          <?php }?>
        </tbody>
        <tr>
          <td colspan="4">
            <input type="button" class="buyit" value="購買" onclick="onBuyIt(this)" />
            <input type="button" class="clear" value="清空" onclick="onClearList(this)"/>
            <input type="button" class="getList" value="取得清單" onclick="onGetCustomerList(this)"/>
          </td>
        </tr>
      </table>
    </div>
</body>
</html>
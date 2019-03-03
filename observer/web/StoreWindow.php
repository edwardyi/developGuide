
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title;?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="../web/base.js"></script>
  <script>
      window.onload = function() {
        onStoreRefresh();
      }
      function onListClick(e, id) {
        var row = e.parentElement.parentNode;
        var inputVal = row.querySelector('input').value;
        if(Number.isNaN(parseInt(inputVal)))
        {
          console.log('購買數量需要為數字!')
          return false;
        }
        var item = {
          'id': id,
          'amount': inputVal
        }

        ajaxPostRequest("../controllers/IndexController.php?action=addCustomerList", item);
      }

      function onStoreRefresh(e) {
        console.log(e);
        var uri = document.getElementById("productForm").action;
        uri = "../controllers/IndexController.php?action=getStoreList";
        var item = "storeRefresh=true";
        var xhr = ajaxPostRequest(uri, item);
        var table = document.querySelector('table');
        xhr.onload = function(){
          // {{"name":"name", "value":"value"}}
          // <input type="button" class="addToCustomerList" onclick="onListClick(this, 2)" value="添加">
          // var fields = new Array('name','stock','price','amount', 'buyit');
          var fields = [
            {"name":"name", "type":"td"},
            {"name":"price", "type":"td"},
            {"name":"stock", "type":"td"},
            {"name":"amount", "type":"input", "value":"", "typeAttribute":"text"},
            {"name":"buyit", "type":"input","typeAttribute":"button", "class":"addToCustomerList","onclick":"onListClick(this, 'placeholder')", "value":"添加"}
          ];
          removeRowByCellValue(table);
          data = xhr.responseText;
          addDataToCell(table, data, fields);
          // console.log(xhr.responseText);
        }
      }
  </script>
  <style>
    .container {
      width: 35%;
    }
    table {
      border-collapse: collapse;
    }
    table tr td {
      border: 1px solid black;
    }
    table tr td input.addToCustomerList {
      width: 100%;
    }
    input.purchase {
      float: right;
      width: 100px;
    }
  </style>
</head>
<body>
    <div class="container">
      <form id="productForm" action="../controllers/IndexController.php?action=report" method="POST" target="_blank">
        <table>
          <tr>
            <th>商品名稱</th>
            <th>價格</th>
            <th>庫存</th>
            <th>購買數量</th>
            <th>加入購物清單</th>
          </tr>
          <tbody>
            <?php foreach($stores as $store) {?>
              <tr>
                <td><?php echo $store['name']?></td>
                <td><?php echo $store['price']?></td>
                <td><?php echo $store['stock']?></td>
                <td><input type="text" value=""/></td>
                <td><input type="button" class="addToCustomerList" onclick="onListClick(this, <?php echo $store['id'];?>)" value="添加"/></td>
              </tr>
            <?php }?>
          </tbody>
          <tr>
              <td colspan="5">
                <input type="button" class="refresh" value="重新取得資料" onclick="onStoreRefresh(this)" />
                <input type="submit" class="purchase" value="結帳" />
              </td>
          </tr>
        </table>
      </form>
    </div>
</body>
</html>
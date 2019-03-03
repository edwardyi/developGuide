function ajaxPostRequest(uri, item) {
  var xhttp = new XMLHttpRequest();
  var responseText;
  xhttp.open("POST", uri, true);
  // xhttp.setRequestHeader("Content-type","application/json");
  xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhttp.onload = function() {
    if (this.status === 200 && this.readyState == 4) {
      // console.log(this.responseText);
      if (this.responseText === "success") {
        // console.log('成功加入購物清單')
      }
    }
  }
  
  var params =  typeof item == 'string' ? item : Object.keys(item).map(
      function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(item[k]) }
  ).join('&');

  xhttp.send(encodeURI(params));
  return xhttp;
}


function removeRowByCellValue(table) 
{
  var cells = table.getElementsByTagName("TD");
  if (cells.length < 2) {
    return false;
  }
  for(var x = 0; x < cells.length; x++) {

      // check if cell has a childNode, prevent errors
      if(!cells[x].firstChild) {
          continue;
      }
      var row = cells[x].parentNode;
      row.parentNode.removeChild(row);
  }
}

function addDataToCell(table, data, fields) {
  if (data) {
    data = JSON.parse(data);
    var tbody = table.querySelector('tbody');
    for(var i = 0; i < data.length; i++) {
      var row = document.createElement('tr');

      for (var j = 0; j < fields.length; j++) {
        var fieldObj = fields[j];
        // 根據傳入的類型建立元素
        var cell = document.createElement(fieldObj.type);
        
        // 判斷input tag begin
        let isInput = fieldObj.type == "input";
        if (isInput && typeof fieldObj.onclick != "undefined") {
          let pid = fieldObj.onclick.replace('placeholder', data[i]['id']);
          cell.setAttribute("onclick", pid);
        }
        if (isInput && typeof fieldObj.class != "undefined") {
          cell.setAttribute("class", fieldObj.class);
        }

        if (isInput && typeof fieldObj.typeAttribute != "undefined") {
          cell.setAttribute("type", fieldObj.typeAttribute);
        }
        var inputVal = table.querySelector(`tr:nth-child(2)`);

        if (isInput && typeof fieldObj.value != "undefined") {
          cell.setAttribute("value", fieldObj.value);
        }

        if (!isInput) {
          var nodeData  = document.createTextNode(data[i][fieldObj.name]);
          cell.appendChild(nodeData);
          row.appendChild(cell);
        } else {
          // 如果是其他元素的話，需要再創建TD的格子給他存放
          var td = document.createElement('td');
          td.appendChild(cell);
          row.append(td)
        }
        // 判斷input tag end
      }
      tbody.appendChild(row);
    }
  }
}

<!DOCTYPE html>
<html>
<head>
    <title>My Store</title>
    <script>
        function loadDoc() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("myTable").innerHTML = "";
                    let products = JSON.parse(this.responseText);
                    products.forEach(myFunction);

                    function myFunction(item, index) {
                        if (item[1] === item[0]) {
                            item[1] = "-"
                        }
                        if (item[2] === item[0] || item[2] === item[1]) {
                            item[2] = "-"
                        }
                        var row = "<tr> <td style='font-size: 20px;padding: 10px;font-weight: bold;'><img src='"+item[0]['image']+"'><br>"+item[0]['name']+"</td>";
                        if(document.getElementById("myNumberSelect").value > 1) {
                            row += "<td style='font-size: 20px;padding: 10px;font-weight: bold;'><img src='"+item[1]['image']+"'><br>" + item[1]['name'] + "</td>";
                        }
                        if(document.getElementById("myNumberSelect").value > 2) {
                            row += "<td style='font-size: 20px;padding: 10px;font-weight: bold;'><img src='"+item[2]['image']+"'><br>" + item[2]['name'] + "</td>";
                        }
                        row += "</tr>";
                        document.getElementById("myTable").innerHTML += row;

                    }
                }
            };
            let url = "product.php?product="+document.getElementById("mySelect").value;
            xhttp.open("GET", url, true);
            xhttp.send();
        }
        document.addEventListener('DOMContentLoaded', loadDoc, false);

    </script>
    <style>
        table, th, td {
            border: 1px solid black;
            padding: 0px 5px;
        }
        img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 80px;
            height: 80px;
        }

        img:hover {
            box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
        }
    </style>

</head>
<body style="text-align: center; padding-top: 50px;background: #e5e2e2;">

<h1>My Grocery Store</h1>
    <table align="center" style="border: none;">
    <tr>
        <td>
            <div>
    Select Antecedents
            </div>
    <select id="mySelect" onchange="loadDoc()">
        <?php
        require_once ("vendor/autoload.php");
        if ( $xlsx = SimpleXLSX::parse('DataSheet.xlsx') ) {
            $rows = array_slice($xlsx->rows(), 1);
            $itemsName = array();
            foreach ($rows as $row) {
                $itemsName[] = $row[0];
            }
            $itemsName = array_unique($itemsName);
            foreach ($itemsName as $itemName) {
                echo '<option>'.$itemName. '</option>';
            }
        }
        else {
            echo SimpleXLSX::parseError();
        }
        ?>
    </select>
        </td>
        <td>
            <div>Select Number</div>
        <select id="myNumberSelect" onchange="loadDoc()">
            <option value="1">1 Item</option>
            <option value="2">2 Item</option>
            <option value="3">3 Item</option>
        </select>
        </td>
    </tr>
</table>

    <table id="myTable" style="margin-left: auto;margin-right: auto;color: green;">
    </table>

</body>
</html>

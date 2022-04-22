
<?php
$servername = "localhost";
$username = "uts";
$password = "internet";
$dbName = "assignment1";
//Estanblish connnection with database
$link = mysqli_connect($servername, $username, $password, $dbName) or die("Could not connect to Server");
$id = $_GET['product_id'];
$query_list = "select * from products where product_id = $id";
$result = mysqli_query($link, $query_list);
$num_rows = mysqli_num_rows($result);


//Display the product infomation
print "<center>";
    if(isset($id)){
        if($num_rows > 0) {
            print "<table border='0'>";

            while($a_row = mysqli_fetch_assoc($result)){
    
                if($a_row['product_id'] == $id){
                    $name = $a_row['product_name'];
                    $unit_price = $a_row['unit_price'];
                    $unit_quantity = $a_row['unit_quantity'];
                    $in_stock = $a_row['in_stock'];
                    
                }
            }
  
            print "<tr><td>Product_ID</td>
            <td>Product_name</td>
            <td>Unit_price</td>
            <td>Unit_quantity</td>
            <td>In_stock</td></tr>"; 
            print "<tr>";
            print "<td>$id</td>
                <td>$name</td>
                <td>$unit_price</td>
                <td>$unit_quantity</td>
                <td>$in_stock</td>";
            print "</tr>";
            print "</table>";
            print "<br>";
           
        }
         
    }
    else {
        print "Please select the product";
    }
    print "</center>";
    mysqli_close($link);
?>
<html>
    <head>
        <style type="text/css">
        </style>
        <link rel="stylesheet" href="productInfo.css">
        <script src="JS/display.js"></script> 
        <title>Product infomation</title>
    </head>
    <body style="background-color: rgb(204, 220, 215);">
        <center>
        <div>
            <?php if(isset($id)) { ?>
           <!-- when id is set, add product to shopping cart -->
            <form method="GET" onsubmit="return validate()" action="cart.php" target="cart">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="hidden" name="name" value="<?php echo $name ?>">
                <input type="hidden" name="unit_price" value="<?php echo $unit_price?>">
                <input type="hidden" name="unit_quantity" value="<?php echo $unit_quantity?>">
                <input type="hidden" name="in_stock" value="<?php echo $in_stock?>">
                <label>Purchase quantity: </label>
                <input type="number" id="quantity" name="quantity" min="1" max="200">
                <input type="submit" value="Add to cart">
            </form>
            <?php }?>
            </center>

        </div>
    </body>
</html>
<?php
require('connection.php');
require('data_list.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <title>store_Product</title>
</head>
<body>
<?php

if (isset($_GET['store_product_name'])) {
    $store_product_name= $_GET['store_product_name'];
    $store_quantity= $_GET['store_quantity'];
    $store_entry = $_GET['store_entry'];
    $sql="INSERT INTO product_store (store_product_name,store_quantity,store_entry) VALUES ('$store_product_name', '$store_quantity', '$store_entry')";    
    if ($conn->query($sql)!= false) {
        echo "insert data successfully";
    } else {
        echo "not insert the product";
    }
}
?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
    Product:<br>
    <select name="store_product_name">
        <?php
            data_list('product','product_id','product_name');
        ?>
    </select><br><br>
    product Quantity:<br>
    <input type="text" name="store_quantity" id="" placeholder="store_quantity"><br><br>
    Product store Entry_date:<br>
    <input type="date" name="store_entry" id="store_entry"><br>
    <br>
    <input type="submit" value="ADD">
</form>

</body>

</html>
<?php
require('connection.php');
require('data_list.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <title>Product spend</title>
</head>
<body>
<?php

if (isset($_GET['spend_product_name'])) {
    $spend_product_name= $_GET['spend_product_name'];
    $spend_quantity= $_GET['spend_quantity'];
    $spend_date = $_GET['spend_date'];
    $sql="INSERT INTO spend_product (spend_product_name,spend_quantity,spend_date) VALUES ('$spend_product_name', '$spend_quantity', '$spend_date')";    
    if ($conn->query($sql)!= false) {
        echo "insert data successfully";
    } else {
        echo "not insert the product";
    }
}
?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
    Product:<br>
    <select name="spend_product_name(id)">
        <?php
            data_list('product','product_id','product_name');
        ?>
    </select><br><br>
    product Quantity:<br>
    <input type="text" name="spend_quantity" id="" placeholder="spend_quantity"><br><br>
     Spend_date:<br>
    <input type="date" name="spend_date" id="spend_date"><br>
    <br>
    <input type="submit" value="ADD">
</form>

</body>

</html>
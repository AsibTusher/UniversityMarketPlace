<?php
require('connection.php');
//require('data_list.php');
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

if (isset($_GET['id'])) {
    $get_id = $_GET['id'];
    $sql="SELECT * FROM product_store where store_product_id=$get_id";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);

    $store_product_id = $row['store_product_id'];
    $store_product_name = $row['store_product_name'];
    $store_quantity = $row['store_quantity'];
    $store_entry= $row['store_entry'];
    
}
if (isset($_GET['store_product_name'])) {
    $new_store_product_name = $_GET['store_product_name'];
    $new_store_entry = $_GET['store_entry'];
    $new_store_quantity = $_GET['store_quantity'];
    $new_store_product_id = $_GET['store_product_id'];


    $sql1="UPDATE product_store SET store_product_name='$new_store_product_name',
    store_entry='$new_store_entry',store_quantity='$new_store_quantity',
    store_product_id='$new_store_product_id' WHERE store_product_id='$new_store_product_id'
    ";
    if ($conn->query($sql1)==TRUE) {
        echo "update successfully";
    }else {
        echo "not update";
    }

}
?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
    Product:<br>
    <select name="store_product_name">
        <?php
            $sql1 = "SELECT * FROM product";
            $result1 = $conn->query($sql1);
            while ($row = mysqli_fetch_assoc($result1)) {
                $product_id = $row['product_id'];
                $product_name = $row['product_name'];
                
                ?>
                <option value='<?php echo $product_id ?>'<?php if($store_product_name==$product_id){echo 'selected';}?>>
                <?php echo $product_name?></option>
            <?php
        }
        ?>
    </select><br><br>
    product Quantity:<br>
    <input type="number" name="store_quantity" id="" placeholder="store_quantity"value="<?php echo $store_quantity;?>"><br><br>
    Product store Entry_date:<br>
    <input type="date" name="store_entry" id="store_entry"value="<?php echo $store_entry;?>"><br>
    <input type="text" name="store_product_id" id="" placeholder="store_product_id"value="<?php echo $store_product_id;?>"hidden><br><br>

    <br>
    <input type="submit" value="ADD">
</form>

</body>

</html>
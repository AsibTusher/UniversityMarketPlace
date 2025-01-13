<?php
require('connection.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <title>Product database</title>
</head>
<body>
    
<?php

if (isset($_GET['product_name'])) {
    $product_name= $_GET['product_name'];
    $p_category_id= $_GET['p_category_id'];
    $entry_date = $_GET['entry_date'];
    $product_price = $_GET['product_price'];
    $product_description = $_GET['product_description'];
    $product_img = $_GET['product_img'];

    $sql="INSERT INTO product (product_name,p_category_id,entry_date,product_price,product_description,product_img) VALUES ('$product_name', '$p_category_id', '$entry_date', '$product_price', '$product_description','$product_img')";    
    if ($conn->query($sql)!= false) {
        echo "insert product";
    } else {
        echo "not insert the product";
    }
}
?>
<?php
$sql1 = "SELECT * FROM add_category";
$result1 = $conn->query($sql1);
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
    Product:<br>
    <input type="text" name="product_name" id="" placeholder="product_name"><br><br>
    Select Category:<br>
    <select name="p_category_id">
        <?php
        while ($row = mysqli_fetch_assoc($result1)) {
            $category_id = $row["category_id"];
            $category_name = $row["category_name"];
            echo"<option value='$category_id'>$category_name</option>";
        }

        ?>
    </select><br><br>
    Add description:<br>
    <input type="text" name="product_description" id="" placeholder="description"><br><br>
    Add Price:<br>
    <input type="text" name="product_price" id="" placeholder="price"><br><br>
    Upload your product picture:<br>
    <input type="blob" name="product_img" id="" placeholder="upload-picture"><br><br>
    Entry_date:<br>
    <input type="date" name="entry_date" id="entry_date"><br>
    <br>
    <input type="submit" value="ADD">
</form>

</body>

</html>
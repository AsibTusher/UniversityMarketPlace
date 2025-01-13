<?php
require('connection.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit Product </title>
</head>
<body>
<?php
if (isset($_GET['id'])) {
    $get_id = $_GET['id'];
    $sql="SELECT * FROM product where product_id=$get_id";
    $result = $conn->query($sql);

    $row = mysqli_fetch_array($result);
    $product_id = $row['product_id'];
    //var_dump( $category_id);
    $product_name = $row['product_name'];
    $p_category_id = $row['p_category_id'];
    $product_price = $row['product_price'];
    $entry_date= $row['entry_date'];
    $product_img= $row['product_img']; 
    $product_description = $row['product_description'];
}
if (isset($_GET['product_name'])) {
    $new_product_id = $_GET['product_id'];
    $new_p_category_id = $_GET['p_category_id'];
    $new_product_name = $_GET['product_name'];
    $new_product_price = $_GET['product_price'];
    $new_product_img = $_GET['product_img'];
    $new_entry_date = $_GET['entry_date'];
    $new_entry_description = $_GET['product_description'];
    $sql1="UPDATE product SET product_name='$new_product_name',
    p_category_id='$new_p_category_id',product_price='$new_product_price',
    product_img='$new_product_img',entry_date='$new_entry_date',product_description='$new_entry_description' WHERE product_id='$new_product_id'
    ";
    if ($conn->query($sql1)==TRUE) {
        echo "update successfully";
    }else {
        echo "not update";
    }

}
?>
<?php
$sql = "SELECT * FROM `add_category`";
$result = $conn->query($sql);
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
    Product:<br>
    <input type="text" name="product_name" id="" placeholder="name" value="<?php echo $product_name?>"><br><br>
    Select Category:<br>
    <select name="category_id" id="category_id">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            $category_id = $row["category_id"];
            $category_name = $row["category_name"];
            ?>
            <option value='<?php echo $category_id ?>'<?php if($category_id==$p_category_id){echo 'selected';}?>>
                <?php echo $category_name?></option>
            <?php
        }
        ?>
        

    
    </select><br><br>
    update description:<br>
    <input type="text" name="product_description" id="" placeholder="product_description" value="<?php echo $product_description?>"><br><br>
    update Price:<br>
    <input type="text" name="product_price" id="" placeholder="price" value="<?php echo $product_price?>"><br><br>
    Upload your update picture:<br>
    <input type="blob" name="product_img" id="" placeholder="upload-picture" value="<?php echo $product_img?>"><br><br>
    update Entry_date:<br>
    <input type="date" name="entry_date" id="entry_date" value="<?php echo $entry_date?>"><br>
    <br>
    <input type="text" name="product_id" id="product_id" value="<?php echo $product_id?> "hidden>
    <input type="submit" value="update">
</form>

</body>

</html>
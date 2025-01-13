<?php
require('connection.php');

$sql2="select* From add_category";
$result2=mysqli_query($conn,$sql2);
$data_list=array();
while($row2=mysqli_fetch_array($result2)){
    $category_id=$row2['category_id'];
    $category_name=$row2['category_name'];

    $data_list[$category_id]=$category_name;

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list of products</title>
</head>
<body>
    <?php
    echo " <h3>product list Table</h3>";
    $sql="SELECT * FROM product";
    $result=$conn->query($sql); 
    echo"<table border='1'><tr><th>ProductName</th><th>Category</th><th>Price</th><th>Action</></tr>";
    while($row=mysqli_fetch_array($result)){
        $product_id =$row["product_id"];
        $p_category_id=$row["p_category_id"];
        $product_price=$row["product_price"];
        $product_name=$row["product_name"];
       
        

        echo"<tr>
              <td> $product_name</td>
              <td> $data_list[$category_id]</td>
              <td>$product_price</td>
              <td><a href='edit_product.php?id=$product_id'> Edit</a></td>
              </tr>
              ";
    }
    

       
    ?>
    
    
</body>
</html>
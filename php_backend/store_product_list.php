<?php
require('connection.php');

$sql2="select* From product";
$result2=mysqli_query($conn,$sql2);
$data_list=array();
while($row2=mysqli_fetch_array($result2)){
    $product_id=$row2['product_id'];
    $product_name=$row2['product_name'];

    $data_list[$product_id]=$product_name;

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Product List</title>
</head>
<body>
    <?php
    echo " <h3>product list Table</h3>";
    $sql="SELECT * FROM product_store";
    $result=$conn->query($sql); 
    echo"<table border='1'><tr><th>ProductName</th><th>quantity</th><th>entry date</th><th>Action</></tr>";
    while($row=mysqli_fetch_array($result)){
        $store_product_id =$row["store_product_id"];
        $store_product_name=$row["store_product_name"];
        $store_quantity=$row["store_quantity"];
        $store_entry=$row["store_entry"];
       
        

        echo"<tr>
              <td> $data_list[$store_product_name]</td>
              <td>$store_quantity</td>
              <td> $store_entry</td>
              <td><a href='edit_store_product.php?id=$store_product_id'> Edit</a></td>
              </tr>
              ";
    }
    

       
    ?>
    
    
</body>
</html>
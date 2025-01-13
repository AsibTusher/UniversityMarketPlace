<?php
require('connection.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list of category</title>
</head>
<body>
    <?php
    echo " <h3>Category list Table</h3>";
    $sql="SELECT * FROM `add_category`";
    $result=$conn->query($sql); 
    echo"<table border='1'><tr><th>category</th><th>date</th><th>Action</></tr>";
    while($row=mysqli_fetch_array($result)){
        $category_id=$row["category_id"];
        $category_date=$row["category_date"];
        $category_name=$row["category_name"];

        echo"<tr>
              <td> $category_name</td>
              <td> $category_date</td>
              <td><a href='edit_category.php?id=$category_id'> Edit</a></td>
              </tr>
              ";
    }
    

       
    ?>
    
    
</body>
</html>
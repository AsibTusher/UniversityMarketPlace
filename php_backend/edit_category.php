<?php
require('connection.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit_Category</title>
</head>
<body>
    <?php
    if(isset($_GET['id'])){
        $get_id = $_GET['id'];
        $sql="SELECT * FROM add_category where category_id=$get_id";
        $result = $conn->query($sql);
        $row = mysqli_fetch_array($result);

        $category_id = $row['category_id'];
        //var_dump( $category_id);
        $category_name = $row['category_name'];
        $category_date = $row['category_date'];
        
    }

    if(isset($_GET['category_name'])){
        $new_category_name = $_GET['category_name'];
        $new_category_date= $_GET['category_date'];
        $new_category_id = $_GET['category_id'];
        
        

        $sql1="UPDATE add_category SET category_name = '$new_category_name',category_date='$new_category_date' WHERE category_id='$new_category_id'";
        $result1 = $conn->query($sql1);
        //$row1 = mysqli_fetch_array($result1);
        //if($result1->num_rows > 0){}else{}

        if($conn->query( $sql1) == TRUE){
            echo"update successful";
        }
        else{
            echo "not updated";
        }


    }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>"method="GET">
        Category:<br>
        <input type="text" name="category_name" id="" placeholder="category-name" value="<?php echo $category_name?>"><br><br>
        Entry_date:<br>
        <input type="date" name="category_date" id="category_date"value="<?php echo $category_date?>"><br>
        <input type="text" name="category_id" id="category_id"value="<?php echo $category_id ?> "hidden><br>
        <input type="submit" value="Update">
        
    </form>
    
</body>
</html>
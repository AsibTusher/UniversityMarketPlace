<?php
require('connection.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category database</title>
</head>
<body>
    <?php
       if(isset($_GET['category_name'])) {
        $category_name=$_GET['category_name'];
        $category_date=$_GET['category_date'];
       
       $sql="INSERT INTO add_category (category_name, category_date)VALUES ('$category_name', '$category_date')";

     if($conn->query($sql)==TRUE) {
        echo "insert category";
       }else{
        echo "not insert the category";
       }
    }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>"method="GET">
        Category:<br>
        <input type="text" name="category_name" id="" placeholder="category-name"><br><br>
        Entry_date:<br>
        <input type="date" name="category_date" id="category_date" placeholder="Date"><br>
        <input type="submit" value="submit">
    </form>
    
</body>
</html>
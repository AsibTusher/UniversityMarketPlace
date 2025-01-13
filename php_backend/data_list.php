<?php

function data_list($tablename, $column1, $column2)
{
    require('connection.php');
    $sql1 = "SELECT * FROM $tablename";
    $result1 = $conn->query($sql1);
    while ($row = mysqli_fetch_assoc($result1)) {
        $data_id = $row[$column1];
        $data_name = $row[$column2];
        echo "<option value=' $data_id'>$data_name</option>";
    }

}

?>
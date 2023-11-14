<?php
    require('config/config.php');
    require('config/db.php');

    if (isset($_GET['id'])){
        $del = $_GET['id'];

        $sql = "DELETE FROM employee WHERE id=$del";
        $result = mysqli_query($conn, $sql) or die("Connection failed: ". $conn->connect_error);

        if($result){
            header("Location: employees.php?msg=Record deleted.");

        }
        $conn->close();
    }
?>
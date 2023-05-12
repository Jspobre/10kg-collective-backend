<?php 

    include_once "../db_conn.php";


        $sql = "SELECT * FROM category";
    $result = query($conn, $sql);

    echo json_encode($result);

    ?>
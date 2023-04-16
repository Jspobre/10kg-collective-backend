<?php
    include_once "../db_conn.php";

    $isInsert = false;

    if(isset($_POST['item_name'])){
        $item_name = $_POST['item_name'];
        $item_price = $_POST['item_price'];
        $item_category = $_POST['item_category'];
        $size_name = $_POST['size_name'];
        $variation_name = $_POST['variation_name']; //get the converted array of objects to string
        
        // insert to items table
        $sql = "INSERT INTO items (item_name, item_price, item_category) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sis", $item_name, $item_price, $item_category);
        $stmt->execute();
        $item_id = $stmt->insert_id;
        $stmt->close();

        foreach($size_name as $size){
            $sql = "INSERT INTO item_sizes (item_id, size_name) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $item_id, $size);
            $stmt->execute();
            $stmt->close();
        }

        //insert into item_variation table sheesh
        foreach($variation_name as $variation){
            $sql = "INSERT INTO item_variation (item_id, variation_name) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $item_id, $variation);
            $stmt->execute();
            $stmt->close();

            $isInsert = true;
        }

        // if(mysqli_stmt_affected_rows($stmt) > 0){
        //     echo 1;
        // }else{
        //     echo 2;
        // }
        if($isInsert){
            echo 1;
            $isInsert = false;
        }else {
            echo 0;
        }
    }
?>

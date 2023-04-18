<?php
    include_once "../db_conn.php";

    if(isset($_POST['item_name'])){
        $item_name = $_POST['item_name'];
        $item_price = $_POST['item_price'];
        $item_category = $_POST['item_category'];
        $size_name = implode(",", $_POST['size_name']); 
        $variation_name = implode(",", $_POST['variation_name']); 

        // Insert to items table
        $sql = "INSERT INTO items (item_name, item_price, item_category) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sis", $item_name, $item_price, $item_category);
        $stmt->execute();
        $item_id = $stmt->insert_id;
        $stmt->close();

        // Insert size_name into item_sizes table as a JSON array
        if (!empty($size_name)) {
            $sql = "INSERT INTO item_sizes (item_id, size_name) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $item_id, $size_name);
            $stmt->execute();
            $stmt->close();
        }

        
        // Insert variation_name into item_variation table as a JSON array
        if (!empty($variation_name)) {
            $sql = "INSERT INTO item_variation (item_id, variation_name) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $item_id, $variation_name);
            $stmt->execute();
            $stmt->close();
        }

        echo "1"; 
    }
?>

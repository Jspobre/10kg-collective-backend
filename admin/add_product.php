<?php
    include_once "../db_conn.php";

    if(isset($_POST['item_name'])){
        $item_name = $_POST['item_name'];
        $item_price = $_POST['item_price'];
        $item_category = $_POST['item_category'];
        $size_name = $_POST['size_name'];
        $variation_name = json_decode($_POST['variation_name']); //get the converted array of objects to string
        
        // insert to items table
        $sql = "INSERT INTO items (item_name, item_price, item_category) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sis", $item_name, $item_price, $item_category);
        $stmt->execute();
        $item_id = $stmt->insert_id;
        $stmt->close();

        // insert size data into item_sizes table
        $sql = "INSERT INTO item_sizes (item_id, size_name) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $item_id, $size_name);
        $stmt->execute();
        $stmt->close();

        // convert $variation_name to JSON string if it's an array of objects
        $variation_name = is_array($variation_name) ? json_encode($variation_name) : $variation_name;
        
        // insert  into 'item_variation' table bro
        $sql = "INSERT INTO item_variation (item_id, variation_name) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $item_id, $variation_name);
        $stmt->execute();
        $stmt->close();
        
        if(mysqli_stmt_affected_rows($stmt) > 0){
            echo 1;
        }else{
            echo "uy gegi";
        }
    }
?>


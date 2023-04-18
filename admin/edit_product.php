<?php

include_once "../db_conn.php";

if(isset($_POST['item_id']) && isset($_POST["item_name"]) && isset($_POST["item_price"]) && isset($_POST["item_category"]) && isset($_POST["size_name"]) && isset($_POST["variation_name"])) {
    $item_id = $_POST["item_id"];
    $item_name = $_POST["item_name"];
    $item_price = $_POST["item_price"];
    $item_category = $_POST["item_category"];
    $size_name = $_POST["size_name"];
    $variation_name = $_POST["variation_name"];

    // Update item_name, item_price, and item_category in items table based on item_id
    $stmt = $conn->prepare("UPDATE items SET item_name = ?, item_price = ?, item_category = ? WHERE item_id = ?");
    $stmt->bind_param("sdsi", $item_name, $item_price, $item_category, $item_id); // Fix parameter types
    if ($stmt->execute()) {
        $stmt->close();

        // Delete existing data in item_sizes table based on item_id
        $stmt = $conn->prepare("DELETE FROM item_sizes WHERE item_id = ?");
        $stmt->bind_param("i", $item_id);
        $stmt->execute();
        $stmt->close();

        // Delete existing data in item_variation table based on item_id
        $stmt = $conn->prepare("DELETE FROM item_variation WHERE item_id = ?");
        $stmt->bind_param("i", $item_id);
        $stmt->execute();
        $stmt->close();

        // Insert new data into item_sizes table
        $stmt = $conn->prepare("INSERT INTO item_sizes (item_id, size_name) VALUES (?, ?)");
        foreach ($size_name as $size) {
            $stmt->bind_param("is", $item_id, $size);
            $stmt->execute();
        }
        $stmt->close();

        // Insert new data into item_variation table
        $stmt = $conn->prepare("INSERT INTO item_variation (item_id, variation_name) VALUES (?, ?)");
        foreach ($variation_name as $variation) {
            $stmt->bind_param("is", $item_id, $variation);
            $stmt->execute();
        }
        $stmt->close();

        $conn->close();

        echo 1;
    } else {
        echo "Error updating items table: " . $stmt->error; // Add error handling for update query
    }
} else {
    echo "Missing form data"; // Add error handling for missing form data
}
?>

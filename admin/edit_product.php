<?php
include_once "db_conn.php";

if(isset($_POST['item_id'])){
    $item_id = $_POST["item_id"];
    $item_name = $_POST["item_name"];
    $item_price = $_POST["item_price"];
    $item_category = $_POST["item_category"];
    $size_name = $_POST["size_name"];
    $variation_name = $_POST["variation_name"];

    // Update the "items" table
    $sql = "UPDATE items SET item_name = ?, item_price = ?, item_category = ? WHERE item_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("siii", $item_name, $item_price, $item_category, $item_id);
    $stmt->execute();

    // Delete existing data from "item_sizes" table based on item_id
    $sql = "DELETE FROM item_sizes WHERE item_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $item_id);
    $stmt->execute();

    // Insert new data into "item_sizes" table
    if (!empty($size_name)) {
        foreach ($size_name as $size) {
            $sql = "INSERT INTO item_sizes (item_id, size_name) VALUES (?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("is", $item_id, $size);
            $stmt->execute();
        }
    }

    // Delete existing data from "item_variation" table based on item_id
    $sql = "DELETE FROM item_variation WHERE item_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $item_id);
    $stmt->execute();

    // Insert new data into "item_variation" table
    if (!empty($variation_name)) {
        foreach ($variation_name as $variation) {
            $sql = "INSERT INTO item_variation (item_id, variation_name) VALUES (?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("is", $item_id, $variation);
            $stmt->execute();
        }
    }

    // Delete existing data from "item_variation" table for variations not included in the new data
    $sql = "DELETE FROM item_variation WHERE item_id = ? AND variation_name NOT IN (?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("is", $item_id, implode(",", $variation_name));
    $stmt->execute();

    $stmt->close();
    $mysqli->close();

}
?>

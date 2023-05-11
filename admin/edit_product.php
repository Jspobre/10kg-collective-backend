<?php

include_once "../db_conn.php";

if(isset($_POST['item_id'])) {
    $item_id = $_POST["item_id"];
    $item_name = $_POST["item_name"];
    $item_price = $_POST["item_price"];
    $item_category = $_POST["item_category"];
    $size_name = $_POST["size_name"];
    $variation_name = $_POST["variation_name"];
    $thumbnail = $_FILES['thumbnail']; 
    $showcase_files = $_FILES['showcase'];

    // Retrieve existing thumbnail image for the item
    $stmt = $conn->prepare("SELECT image_src FROM items WHERE item_id = ?");
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $existing_thumbnail_image = $row['image_src'];
    $stmt->close();

    // Delete existing thumbnail image from the server
    if (file_exists($existing_thumbnail_image)) {
        unlink($existing_thumbnail_image);
    }

    // Update thumbnail image source in the items table
    $stmt = $conn->prepare("UPDATE items SET image_src = ? WHERE item_id = ?");
    $stmt->bind_param("si", $thumbnail_location_thumbnail, $item_id);
    $thumbnail_name = uniqid() . '-' . $thumbnail['name'];

    $thumbnail_location_thumbnail = 'https:localhost/10kg-collective/uploads/thumbnail/' . $thumbnail_name;
    $thumbnail_location = '../uploads/thumbnail/' . $thumbnail_name;
    move_uploaded_file($thumbnail['tmp_name'], $thumbnail_location);
    $stmt->execute();
    $stmt->close();

    // Retrieve existing showcase images for the item
    $stmt = $conn->prepare("SELECT image_location FROM item_image WHERE item_id = ?");
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $existing_showcase_images = [];
    while ($row = $result->fetch_assoc()) {
        $existing_showcase_images[] = $row['image_location'];
    }
    $stmt->close();

    // Delete existing showcase images from the server and database
    $stmt = $conn->prepare("DELETE FROM item_image WHERE item_id = ? ");
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $stmt->close();

    // Handle new showcase files
    foreach ($showcase_files['tmp_name'] as $key => $tmp_name) {
        $showcase_name = uniqid() . '-' . $showcase_files['name'][$key];
        $showcase_location = '../uploads/showcase/' . $showcase_name;
        $showcase_location_showcase = 'https:/localhost/10kg-collective/uploads/showcase/' . $showcase_name;
        move_uploaded_file($tmp_name, $showcase_location);

        // Insert new showcase image information into item_image table
        $stmt = $conn->prepare("INSERT INTO item_image (item_id, image_location) VALUES (?, ?)");
        $stmt->bind_param("is", $item_id, $showcase_location_showcase);
        $stmt->execute();
        $stmt->close();
    }

    // Delete existing showcase images from the server
    foreach ($existing_showcase_images as $existing_showcase_image) {
        if (file_exists($existing_showcase_image)) {
            unlink($existing_showcase_image);
        }
    }

    // Delete existing data in item_sizes table based on item_id
    $stmt = $conn->prepare("DELETE FROM item_sizes WHERE item_id = ?");
    $stmt->bind_param("i", $item);
        $stmt->execute();
    $stmt->close();

    // Delete existing data in item_variation table based on item_id
    $stmt = $conn->prepare("DELETE FROM item_variation WHERE item_id = ?");
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $stmt->close();

    // Insert new data into item_sizes table
    foreach ($size_name as $size) {
        $stmt = $conn->prepare("INSERT INTO item_sizes (item_id, size_name) VALUES (?, ?)");
        $stmt->bind_param("is", $item_id, $size);
        $stmt->execute();
        $stmt->close();
    }

    // Insert new data into item_variation table
    foreach ($variation_name as $variation) {
        $stmt = $conn->prepare("INSERT INTO item_variation (item_id, variation_name) VALUES (?, ?)");
        $stmt->bind_param("is", $item_id, $variation);
        $stmt->execute();
        $stmt->close();
    }

    $conn->close();

    echo 1; // Success status
}
?>


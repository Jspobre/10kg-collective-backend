<?php
    include_once "../db_conn.php";

    $itemInserted = false;
    $sizeInserted = false;
    $variationInserted = false;
    $fileInserted = false;


    if(isset($_POST['item_name'])){
        $item_name = $_POST['item_name'];
        $item_price = $_POST['item_price'];
        $item_category = $_POST['item_category'];
        $size_name = implode(",", $_POST['size_name']); 
        $variation_name = implode(",", $_POST['variation_name']);
        $thumbnail = $_FILES['thumbnail']; 
    
    
            // Handle thumbnail file
            $image_location_thumbnail = 'http://localhost/10kg-collective/uploads/thumbnail/';
            $thumbnail_name = uniqid() . '-' . $thumbnail['name'];
            $thumbnail_location = $image_location_thumbnail . $thumbnail_name;
            move_uploaded_file($thumbnail['tmp_name'], '../uploads/thumbnail/' . $thumbnail_name);
    
            // Insert item into database
            $sql = "INSERT INTO items (item_name, item_price, item_category, image_src) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("siss", $item_name, $item_price, $item_category, $thumbnail_location);
    
            // Check if the statement was executed successfully
            if ($stmt->execute()) {
                $item_id = $stmt->insert_id;
                $stmt->close();
                $itemInserted = true;
            } else {
              echo 0;
            }
    

        // Insert size_name into item_sizes table as a JSON array
        if (!empty($size_name)) {
            $sql = "INSERT INTO item_sizes (item_id, size_name) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $item_id, $size_name);
            $stmt->execute();
            $stmt->close();
            $sizeInserted = true;
        }

        
        // Insert variation_name into item_variation table as a JSON array
        if (!empty($variation_name)) {
            $sql = "INSERT INTO item_variation (item_id, variation_name) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $item_id, $variation_name);
            $stmt->execute();
            $stmt->close();
            $variationInserted = true;
        }

        // echo "1"; 


        // HANDLE FILES
        if (isset($_FILES['showcase'])) {
        
        $showcase = $_FILES['showcase'];

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO item_image (item_id, image_location, image_name) VALUES (?, ?, ?)");

        // Bind the parameters
        $image_location_showcase = 'http://localhost/10kg-collective/uploads/showcase/';

        // Handle showcase files
        $showcase_files = [];
        $showcase_names = [];

        // Iterate over each showcase file
        foreach ($showcase['tmp_name'] as $key => $tmp_name) {
            $showcase_name = uniqid() . '-' . $showcase['name'][$key];
            $showcase_files[] = $tmp_name;
            $showcase_names[] = $showcase_name;

            $showcase_location = $image_location_showcase . $showcase_name;
            $stmt->bind_param("iss", $item_id, $showcase_location, $showcase_name);
            $stmt->execute();
        }

        // Move the uploaded showcase files to the uploads folder
        foreach ($showcase_files as $key => $tmp_name) {
            move_uploaded_file($tmp_name, '../uploads/showcase/' . $showcase_names[$key]);
        }
        // Close the prepared statement and database connection
        $stmt->close();
        // $conn->close();

        $fileInserted = true;


    } 
    if($itemInserted && $sizeInserted && $variationInserted && $fileInserted){
        echo 1;
    }else {
        echo 2;
    }
    // else {
    //     die("Maintenance Mode");
    // }
    }
?>

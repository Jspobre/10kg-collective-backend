<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, user_id");

include_once '../db_conn.php';


$user_id = $_GET['user_id'];

if (isset($_GET['user_id'])) {
  // Sanitize and validate the user input
  $user_id = filter_input(INPUT_GET, 'user_id', FILTER_SANITIZE_NUMBER_INT);
  if (!$user_id || !is_numeric($user_id)) {
    // Handle invalid input
    die('Invalid user ID');
  }

  $stmt = $conn->prepare("SELECT * FROM orders 
                        JOIN items ON orders.item_id = items.item_id 
                        JOIN user ON orders.user_id = user.user_id 
                        WHERE orders.user_id = ?
                        ORDER BY orders.date_ordered DESC");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

  if($orders) {
    $json_orders = json_encode($orders);
    echo $json_orders;
  }else {
    echo die("could not fetch user orders");
  }
}












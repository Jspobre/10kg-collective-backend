<?php

   include_once "db_conn.php";


   if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    echo json_encode(['user_id' => $userId]);
  } else {
    echo json_encode(['error' => 'User ID not found']);
  }

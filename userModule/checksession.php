<?php
    include_once "../db_conn.php";


if(isset($_SESSION['user_id'])) {


  echo "uy gagi";

    // User is not logged in, redirect to login page
    exit();
}
  echo "logged in";
// User is logged in, display the page content
// ...
?>
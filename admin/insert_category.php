<?php

    include_once "../db_conn.php";

    if(isset($_POST['category_name'])){
         $category_name = $_POST['category_name'];


            $sql = "INSERT INTO category (category_name) VALUES (?)";
            $stmt=$conn->prepare($sql);
            $stmt->bind_param("s", $category_name);
           if($stmt->execute()){

            echo 1;
           }else {
            echo 2;
           }
          
       

    }

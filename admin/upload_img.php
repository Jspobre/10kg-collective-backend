<?php
        
include_once "../db_conn.php";

$allowed_ext = array ('jpg', 'png', 'jpeg', 'gif');
        if(isset($_POST['submit'])) {

                   if(!empty($_FILES['file'] ['name'])){
                        $file_name = $_FILES['file'] ['name'];
                        $file_size = $_FILES['file'] ['size'];
                        $file_tmp = $_FILES['file'] ['tmp_name'];
                        
                        $target_dir = "uploads/{$file_name}";
                        $file_ext = explode ('.', $file_name);
                        $file_ext = strtolower(end($file_ext));
                   
                        if(in_array($file_ext, $allowed_ext)) {
                            // Validate file size
                            if($file_size <= 5000000) { // 5000000 bytes = 1MB
                              // Upload file
                              move_uploaded_file($file_tmp, $target_dir);
                      
                              echo '<p style="color: green;">File uploaded!</p>';
                              header("location: index.php");
                            } else {
                              echo '<p style="color: red;">File too large!</p>';
                            }
                                         
                     }  
        }
    }
        if(empty($FILES['file'] ['name'])){

            echo "please choose a file <br>";

        }


?>
<?php 

include_once "../db_conn.php";

if(isset($_POST['logout'])){
    if($_POST['logout'] == 1){

        session_destroy();
        echo 1;
    }
}
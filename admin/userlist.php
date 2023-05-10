<?php

include_once '../db_conn.php';


$result = query($conn, "SELECT user.user_id, user.full_name, user.address, user.email_address, user.contact_no
FROM user
GROUP BY user.full_name");


echo json_encode($result);
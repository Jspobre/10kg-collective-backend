<?php
//Assume that $conn is the variable for the database connection

function query($conn, $sql, $params = array()){
        $errmsg = false;
        $stmt=mysqli_stmt_init($conn);
        if(mysqli_stmt_prepare($stmt, $sql)){
            $str = NULL;
            $cnt_p = count($params);
            
            if($cnt_p > 0){
                foreach($params as $param){
                    $str .= "s";
                }
                 mysqli_stmt_bind_param($stmt, "{$str}" , ...$params );
            }
            //echo $sql;
            if(mysqli_stmt_execute($stmt)){
               
                 $resultData = mysqli_stmt_get_result($stmt);
                 if(!empty($resultData)){
                      $arr=array();
                      while($row = mysqli_fetch_assoc($resultData)){
                          array_push($arr,$row);
                      }
                      return $arr;
                 }
                  else{
                     return true;
                 }
            }
            else{
               return false;
            }
        }
        return false;
            
    }



  function insert($conn, $table, $fields = array()){
        
        if(count($fields)){
            $keys = array_keys($fields);
            $values = null;
            $x = 1;
            $val_arr=array();
                foreach($fields as $field => $val){
                    $values .= "?";
                    if($x < count($fields)){
                        $values .= ', ';
                    }
                array_push($val_arr,$val);
                $x++;
                
                }
            
            $sql = "INSERT INTO {$table} (`" . implode('`,`', $keys) . "`) VALUES ({$values})";
    
           if(query($conn, $sql, $val_arr ) !== false){
               return true;
           }
        }
        return false;
    }


    
function update($conn, $table, $fields = array(), $filter = array(), $op = array() ){
     //update($conn, $table, $fields, $filter = array(), $op = array() ){
     
    $set = '';
        $where = '';
        $x = 1;
        $new_fields = array();
        
        foreach($fields as $name => $value){
            array_push($new_fields, $value);
            $set .= " {$name} = ? ";
            if($x < count($fields)){
                $set .= ', ';
            }
            $x++;
        }
         $x = 0;
         if(!empty($filter)){
             $where = ' WHERE ';
             foreach($filter as $col => $f_val){
                 array_push($new_fields, $f_val);
                 $where .= " {$col} = ? ";
                 if($x < count($op) ){
                     $where .= $op[$x]; //and , or
                 }
             $x++;
             }
        
         }
        $sql = "UPDATE $table SET $set $where; ";

        if(query($conn,$sql,$new_fields)){
               return true;
           }
        return false;
        
    }

/*
This is a PHP function called update that can be used to update records in a database table. The function takes four parameters:

$conn is a required parameter that represents the database connection object.
$table is a required parameter that specifies the name of the database table to be updated.
$fields is an optional parameter that takes an array of column names and values to be updated.
$filter is an optional parameter that takes an array of column names and their corresponding values to filter the records that will be updated.
$op is an optional parameter that takes an array of logical operators (e.g., AND, OR) to be used in between the filters.
The function begins by initializing several variables that will be used in constructing the SQL query. The $set variable is used to construct the SET clause of the SQL UPDATE statement, which sets the new values for the columns. The $where variable is used to construct the WHERE clause of the SQL UPDATE statement, which filters the rows to be updated based on the specified criteria.

The function then iterates over the $fields array and constructs the SET clause of the SQL UPDATE statement. It also pushes the values of the $fields array into a new array called $new_fields.

Next, the function checks if the $filter array is not empty. If it is not empty, it constructs the WHERE clause of the SQL UPDATE statement by iterating over the $filter array and appending the column names and values to the $where variable. It also adds any logical operators specified in the $op array.

Finally, the function constructs the complete SQL UPDATE statement by combining the $table, $set, and $where variables. It then calls another function called query() to execute the SQL statement, passing the database connection object $conn and the $new_fields array as parameters. If the query is successful, the function returns true; otherwise, it returns false.

Let's say we have a users table in our database with columns id, name, email, and age, and we want to update the email of a user with a given id to a new value. We can use the update() function to accomplish this like so:

// assume $conn is a valid database connection object

// specify the table and the fields to update
$table = 'users';
$fields = array(
    'email' => 'newemail@example.com'
);

// specify the filter to select the user with the given id
$filter = array(
    'id' => 123
);

// call the update() function to update the email of the user with id 123
if (update($conn, $table, $fields, $filter)) {
    echo "Email updated successfully";
} else {
    echo "Error updating email";
}

This will execute an SQL query that looks like this:
UPDATE users SET email = ? WHERE id = ?

The ? placeholders are placeholders for the actual values that will be supplied to the query() function via the $new_fields array. In this case, the $new_fields array will contain the values 'newemail@example.com' and 123.
*/


function get($conn, $table, $where = array() ){
    return que($conn ,'SELECT' , $table, $where );
}
function del($conn, $table, $where = array() ){
    return que($conn ,'DELETE' , $table, $where );
}

function que($conn ,$action , $table, $where = array() ){
    //$action = 'S' 
    //$where = array('item_id', '=', 1);
    $where_condition = NULL;
    $value = NULL;
    if(!empty($where)){
        if(count($where) === 3 ){
            $column = $where[0];
            $op     = $where[1];
            $value  = $where[2];
            
            $operators = array('=','>','<','>=','<=');
            
            if(in_array($op, $operators)){
               $where_condition = " AND " . $column . " " . $op . " ? ";
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    
    switch($action){
            CASE 'SELECT': $sql = " SELECT * FROM " . $table . $where_condition; 
            break;
            CASE 'DELETE': $sql = " DELETE FROM " . $table . $where_condition;
            break;
    }
    
    
    $stmt=mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($stmt, $sql)){
           return false;
     }
    
    if($value !== NULL){
        mysqli_stmt_bind_param($stmt, "s" , $value);
    }
    
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if(!empty($resultData)){
         $arr=array();
         while($row = mysqli_fetch_assoc($resultData)){
             array_push($arr,$row);
         }
         return $arr;
    }
    else{
        return false;
    }
}

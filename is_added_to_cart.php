<?php
function check_if_added_to_cart($item_id) {
    if(!isset($_SESSION['user_id'])){
        return 0;
    }

    $user_id = $_SESSION['user_id']; 


    require("conn.php");
   
    $query = "SELECT * FROM cart WHERE product_id='$item_id' AND user_id ='$user_id'";
    $result = mysqli_query($con, $query);
    

    return (mysqli_num_rows($result) >= 1) ? 1 : 0;
}

?>
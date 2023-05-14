<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php

require('admin/db.php');
require('admin/alert.php');
require('return.php');


require 'config.php';

include_once 'dbconnection.php';


date_default_timezone_set("Asia/Manila");


session_start();

if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
    redirect('index.php');


}   



if(isset($_POST['pay_now'])) {
    header("Pragma: no-cache");
    header("Cache-Control: no-cache");
    header("Expires: 0");

    $checkSum = "";

    $ORDER_ID = 'ORD_'.$_SESSION['uId'].random_int(11111,9999999);
    $CUST_ID = $_SESSION['uId'];
    $TXN_AMOUNT = $_SESSION['room']['payment'];

    $frm_data = filteration($_POST);
    

    $room_id = $_SESSION['room']['id'];
    $quantity = $frm_data['quantity'];

    if($quantity <= 0) {
        // Display error message and prevent booking
        echo "Error: Invalid quantity.";
        exit;
    }

    // Check if the requested quantity is available in the room
    $res = select("SELECT `avail` FROM `rooms` WHERE `id`=? AND `avail`>=?", [$room_id, $quantity], 'is');
    if(mysqli_num_rows($res) == 0) {
        // Display error message and prevent booking
        echo "Error: Not enough availability in the Apparatus.";
        exit;
    }

    // Make the booking
    $query1 = "INSERT INTO `booking_order` (`user_id`, `room_id`, `check_in`, `check_out`, `order_id`,`booking_status`) VALUES (?,?,?,?,?,'approved')";
    insert($query1, [$CUST_ID, $room_id, $frm_data['checkin'], $frm_data['checkout'], $ORDER_ID], 'issss');
    $booking_id = mysqli_insert_id($con);

    $query2 = "INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, `total_pay`, `user_name`, `course`,`year`,`teacher`, `email`,`quantity`,`group_no`,`apr_no`,`lab`, `group_mate`) 
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    insert($query2, [$booking_id, $_SESSION['room']['name'], $_SESSION['room']['price'], $TXN_AMOUNT, $frm_data['name'], $frm_data['course'], $frm_data['year'], $frm_data['teacher'], $frm_data['email'], $quantity, $frm_data['group_no'], $frm_data['room_no'], $frm_data['lab'], $frm_data['group_mate']], 'isssssssssssss');

    // Update the room quantity
    $query3 = "UPDATE `rooms` SET `avail`=`avail`-? WHERE `id`=?";
    update($query3, [$quantity, $room_id], 'is');

    redirect('pay_status.php');
}


?>







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

if(isset($_POST['pay_now_chemical'])){


    header("Pragma: no-cache");
    header("Cache-Control: no-cache");
    header("Expires: 0");

    $checkSum = "";

    $ORDER_ID = 'ORD_'.$_SESSION['uId'].random_int(11111,9999999);
    $CUST_ID = $_SESSION['uId'];
    // $TXN_AMOUNT = $_SESSION['chemical']['payment'];

    $frm_data = filteration($_POST);    
  
    $chemical_id = $_SESSION['chemical']['id'];
    $quantity = $frm_data['volume'];

    // Check if the requested quantity is available in the room
    $res = select("SELECT `quantity` FROM `chemical` WHERE `id`=? AND `quantity`>=?", [$chemical_id, $quantity], 'is');
    if(mysqli_num_rows($res) == 0) {
        // Display error message and prevent booking
        echo "Error: Not enough availability in the Chemical.";
        exit;
    }
   



    $frm_data =filteration($_POST);

    $query1 = "INSERT INTO `chemical_order_final` (`user_id`, `chemical_id`, `check_in`, `check_out`, `order_id`,`booking_status`) VALUES (?,?,?,?,?,'approved')";

    insert($query1,[$CUST_ID,$chemical_id,$frm_data['checkin'],$frm_data['checkout'],$ORDER_ID],'issss');
    

    $chemical = mysqli_insert_id($con);
    

    $query2 = "INSERT INTO `chemical_details_final` (`booking_id`, `chemical_name`, `username`, `course`, `year`, `teacher`, `email`, `group_no`, `state`, `volume`, `apr_no`,`lab`,`group_mate`)
     VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

    insert($query2,[$chemical,$_SESSION['chemical']['name'],$frm_data['name'],$frm_data['course'],$frm_data['year'],
    $frm_data['teacher'],$frm_data['email'],$frm_data['group_no'],$frm_data['state'],$quantity,$frm_data['room_no'],$frm_data['lab'],$frm_data['group_mate']],'issssssssssss');

      // Update the room quantity
      $query3 = "UPDATE `chemical` SET `quantity`=`quantity`-? WHERE `id`=?";
      update($query3, [$quantity, $chemical_id], 'is');


  
    redirect('pay_status_chemical.php');
  


 }


 


?>







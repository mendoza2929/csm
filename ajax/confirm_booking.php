<?php 

require('../admin/db.php');
require('../admin/alert.php');


date_default_timezone_set("Asia/Manila"); 




if(isset($_POST['check_availability'])){
    $frm_data = filteration($_POST);
    $status = "";
    $result = "";

    //check in and out validations

    // $checkin_date = new DateTime($frm_data['check_in']);
    // $checkout_date = new DateTime($frm_data['check_out']);
    // $today_date = $checkin_date->diff($checkout_date);

    // $yearsInMonths = $today_date->format('%r%y') * 12;
    // $months = $today_date->format('%r%m');

    // $totalMonths = $yearsInMonths + $months;

    $today_date = new DateTime(date("Y-m-d"));
    $checkin_date = new DateTime($frm_data['check_in']);
    $checkout_date= new DateTime($frm_data['check_out']);
    
  
   



    if($checkin_date == $checkout_date){
        $status = 'check_in_out_equal';
        $result = json_encode(["status" => $status]);
    }
    else if($checkout_date < $checkin_date){
        $status = 'check_out_earlier';
        $result = json_encode(["status" => $status]);
    }
    else if($checkin_date < $today_date){
        $status = 'check_in_earlier';
        $result = json_encode(["status" => $status]);
    }

    // check booking availability if status is blank else return the error

    if($status!= ''){
        echo $result;
    }else{
        session_start();
        $_SESSION['room'];
        

            // // // run query to check the room is available or not
            // $res = select("SELECT `avail` FROM `rooms` WHERE `id`=? AND `avail`>=?", [$room_id, $quantity], 'is');
            // if(mysqli_num_rows($res) == 0) {
            //     // Display error message and prevent booking
            //     echo "Error: Not enough availability in the Apparatus.";
            //     exit;
            // }


        // $count_months =   $totalMonths;
        // $payment = $_SESSION['room']['price'] * $count_months;
        $count_days = date_diff($checkin_date,$checkout_date)->days;
        $payment = $_SESSION['room']['price'] * $count_days;
        


 
        $_SESSION['room']['payment'] = $payment;
        $_SESSION['room']['available'] = true;
        
    $result = json_encode(["status"=>'',"days"=>$count_days,"payment"=>$payment]);
        echo $result;
        
    }

}



?>
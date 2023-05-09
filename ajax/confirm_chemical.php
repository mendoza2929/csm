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
        $_SESSION['chemical'];
        
        $count_days = date_diff($checkin_date,$checkout_date)->days;
        // $payment = $_SESSION['chemical']['price'] * $count_days;
        


 
        // $_SESSION['chemical']['payment'] = $payment;
        $_SESSION['chemical']['available'] = true;
        
    $result = json_encode(["status"=>'available']);
        echo $result;
        
    }

}



?>
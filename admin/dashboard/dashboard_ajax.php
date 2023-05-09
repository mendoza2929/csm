

<?php 



    require("../db.php");
    require("../alert.php");
    adminLogin();


   
    if(isset($_POST['booking_analytics'])){  

        $frm_data = filteration($_POST);

        $condition = "";

        if($frm_data['period']==1){
          $condition = "WHERE datentime BETWEEN NOW() - INTERVAL 5 MONTH AND NOW()";
        }
        else if($frm_data['period']==2){
          $condition = "WHERE datentime BETWEEN NOW() - INTERVAL 5 MONTH AND NOW()";
        }
        else if($frm_data['period']==3){
          $condition = "WHERE datentime BETWEEN NOW() - INTERVAL 1 YEAR AND NOW()";
        }

        $results = mysqli_fetch_assoc(mysqli_query($con,"SELECT  SUM(trans_amt) AS `total_amt`,  
        COUNT(CASE WHEN booking_status!='pending' AND booking_status!='breakage' THEN 1 END) 
        AS `total_bookings`, SUM(CASE WHEN booking_status!='pending' AND booking_status!='breakage'  
         THEN `trans_amt` END) AS `total_amt`,   COUNT(CASE WHEN booking_status='approved' AND arrival=1 THEN 1 END) 
         AS `active_bookings`, SUM(CASE WHEN booking_status='approved' AND arrival=1 THEN `trans_amt` END) AS `active_amt`, 
         COUNT(CASE WHEN booking_status='breakage' then 1 END) AS `cancelled_bookings` ,
          SUM(CASE WHEN booking_status='breakage' AND refund=1 then `trans_amt` END) AS `cancelled_amt` FROM `booking_order` $condition"));
      
        $output = json_encode($results);

        echo $output;


}



 
?>  
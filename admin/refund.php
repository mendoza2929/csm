

<?php 

    require("db.php");
    require("alert.php");
    adminLogin();


   
    if(isset($_POST['get_bookings'])){  

        $frm_data = filteration($_POST);
        
        $query = "SELECT bo.*, bd.*  FROM `booking_order` bo INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id WHERE (bo.order_id LIKE ? OR bd.course LIKE ? OR bd.user_name LIKE ? ) AND  (bo.booking_status =?  AND bo.refund=?) ORDER BY bo.booking_id DESC ";

        $res = select($query,["%$frm_data[search]%","%$frm_data[search]%","%$frm_data[search]%","cancelled",0],'sssss');

        $i=1;

        $table_data = "";

        if(mysqli_num_rows($res)==0){
          echo"<b>No Data Found!</b>";
          exit;
        }

        while($data = mysqli_fetch_array($res)){

            $date = date("d-m-Y",strtotime($data['datentime']));
            
            $checkin= date("d-m-Y g:i a",strtotime($data['check_in']));
                        
            $checkout= date("d-m-Y g:i a",strtotime($data['check_out']));

            $table_data .="
            
            <tr>
                <td>$i</td>
                <td>
                <span class='badge bg-info'>
                    Order ID: $data[order_id]
                </span>
                <br>
                <b>Name: </b> $data[user_name]
                <br>
                <b>Course/Year: </b> $data[course]
                <br>
                <b>Teacher: </b> $data[teacher]
                </td>
            
                <td>
                    <b>Item: </b> $data[room_name]
                    <br>
                    <b>Quantity: </b> $data[quantity]
                    <br>
                    <b>Check in: </b> $checkin
                    <br>
                    <b>Check out: </b> $checkout
                    <br>
                    <b>Date: </b> $date
                </td>
                
             
                
                <td>
            

                <button type='button' onclick='refund_booking($data[booking_id])' class='btn mt-2 btn-outline-success  btn-sm fw-bold shadow-none'>
                <i class='bi bi-cash'></i> Approved Breakage
              </button>
                </td>
            </tr>
            
            ";

            $i++;
        }

        echo $table_data;

}



if(isset($_POST['assign_room'])){  
        
  $frm_data = filteration($_POST);

  $query = "UPDATE `booking_order` bo INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id SET bo.arrival = ?, bo.rate_review=?, bd.room_no = ? WHERE bo.booking_id = ? ";

  $values = [1,0,$frm_data['room_no'],$frm_data['booking_id']];

  $res = update($query,$values,'iisi');

  echo ($res==2) ? 1 : 0;  //it will update 2 rows so it will return 2 

}

  

    if(isset($_POST['refund_booking'])){
        $frm_data = filteration($_POST);
        
        
        

        $query = "UPDATE `booking_order` SET `refund`=? WHERE `booking_id`=? ";

        $values = [1,$frm_data['booking_id']];

        $res = update($query,$values,'ii');

        echo $res;
    
     
    
}





 
?>  
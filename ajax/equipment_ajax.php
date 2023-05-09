







<?php 



require('../admin/db.php');
require('../admin/alert.php');


date_default_timezone_set("Asia/Manila"); 
session_start();


if(isset($_GET['fetch_equipment'])){

      //count no of rooms and out variables to store rooms cards
      $count_equipment = 0 ; 
      $output = "";

        //fetching settings table to check website is shutdown or not 
        $home_q = "SELECT * FROM `settings` WHERE `sr_no`=1";
        $home_r = mysqli_fetch_assoc(mysqli_query($con,$home_q));
        

      $equipment_res =  select("SELECT * FROM `equipment` WHERE  `status`=?", [1],'i');

      while($equipment_data = mysqli_fetch_assoc($equipment_res)){
     
        $equipment_btn="";

        if(!$home_r['shutdown']){
          $login=0;
          if(isset($_SESSION['login']) && $_SESSION['login']==true){
            $login=1;
          }
          $equipment_btn = "  <button onclick='checkLoginToBook($login,$equipment_data[id])' class='btn btn-success w-100 text-white shadow-none mb-2'>Borrowing Now</button>";
        } 

        $output.="


        <div class='col-lg-3 col-md-3 my-4 p-4'>
        <div class='card border-0 shadow' style='width: 18rem;'>
        <div class='card-body'>
          <h5 class='card-title text-center'>$equipment_data[name]</h5>
          <h5 class='card-title text-center'>$equipment_data[brand]</h5>
          <h5 class='card-title text-center'>$equipment_data[unit]</h5>
          <div class='guests mb-2'>
          <span class='badge rounded-pill bg-light text-dark text-wrap mb-2'>Date Added: $equipment_data[date_added] </span>
          </div>
          $equipment_btn
        </div>
      </div>
    </div>
    </div>

        ";
        $count_equipment++;
      }

      if($count_equipment>0){
        echo $output;
    }else{
        echo "<h3 class='text-center text-danger'>No Stock available</h3>";
    }
      

}


if(isset($_POST['search_equipment'])){

  $frm_data = filteration($_POST);
  $query = "SELECT * FROM `equipment` WHERE `name` LIKE ?";
  $res = select($query,["%$frm_data[name]%"],'s');

       //count no of rooms and out variables to store rooms cards
       $count_chemical = 0 ; 
       $output = "";
 
         //fetching settings table to check website is shutdown or not 
         $home_q = "SELECT * FROM `settings` WHERE `sr_no`=1";
         $home_r = mysqli_fetch_assoc(mysqli_query($con,$home_q));
         
 
      //  $chemical_res =  select("SELECT * FROM `chemical` WHERE  `status`=?", [1],'i');
 
       while($equipment_data = mysqli_fetch_assoc($res)){
 
         $equipment_btn="";
 
         if(!$home_r['shutdown']){
           $login=0;
           if(isset($_SESSION['login']) && $_SESSION['login']==true){
             $login=1;
           }
           $equipment_btn = "  <button onclick='checkLoginToBook($login,$equipment_data[id])' class='btn btn-success w-100 text-white shadow-none mb-2'>Borrowing Now</button>";
         } 
 
         $output.="
         <div class='col-lg-3 col-md-3 my-4 p-4'>
         <div class='card border-0 shadow' style='width: 18rem;'>
         <div class='card-body'>
           <h5 class='card-title text-center'>$equipment_data[name]</h5>
           <h5 class='card-title text-center'>$equipment_data[brand]</h5>
           <h5 class='card-title text-center'>$equipment_data[unit]</h5>
           <div class='guests mb-2'>
           <span class='badge rounded-pill bg-light text-dark text-wrap mb-2'>Date Added: $equipment_data[date_added] </span>
           </div>
           $equipment_btn
         </div>
       </div>
     </div>
     </div>
         ";
         $count_chemical++;
       }
 
       if($count_chemical>0){
         echo $output;
     }else{
         echo "<h3 class='text-center text-danger'>No Stock available</h3>";
     }

}



?>


































     
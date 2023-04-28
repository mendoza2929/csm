

<?php 

require('admin/db.php');
require('admin/alert.php');

include_once 'config.php';

include_once 'dbconnection.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowing</title>
    <link rel = "stylesheet" href="main.css" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="img/logo.jpg">
    <!-- Link Swiper's CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"
    />
  <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">


</head>

<body class="bg-light">

<?php 

require("./header/header.php")

?>
    


    


    <div class="container">
        <div class="row">
            
    <div class="col-12 my-5 px-4">
        <div class="h2 fw-bold text-center">Borrowing</div>
        <div class="h-line bg-dark"></div>
        <div style="font-size:15px;">
        <a href="index.php" class="text-secondary text-decoration-none">Home</a>
        <span class="text-secondary"> > </span>
        <a href="#" class="text-secondary text-decoration-none">Borrowing</a>
    </div>
    </div>


    
          <?php 
          
          $query = "SELECT bo.*, bd.*  FROM `booking_order` bo INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id WHERE  ((bo.booking_status ='approved') OR (bo.booking_status='breakage') OR (bo.booking_status='payment failed')) AND  (bo.user_id=?)  ORDER BY bo.booking_id DESC ";


          $result = select($query,[$_SESSION['uId']],'i');

          while($data = mysqli_fetch_assoc($result)){
            
            $date = date("d-m-Y",strtotime($data['datentime']));
            
            $checkin= date("d-m-Y g:i a",strtotime($data['check_in']));
                        
            $checkout= date("d-m-Y g:i a",strtotime($data['check_out']));

            
            $status_bg = "";
            $btn = "";

            if($data['booking_status']=='approved'){
              
              if($data['arrival']==1){
                $btn="  <div class='text-center'>
              <span class='badge rounded-pill bg-light text-success mb-3 text-wrap lh-base'>
                Success Return
              </span>
              </div>";
              //   $btn="<button type='button' class='btn btn-outline-dark btn-sm fw-bold shadow-none'>
              //   Rate & Review
              // </button>"; 

              // if($data['rate_review']==0){
              //   $btn.="<button type='button' onclick='review_room($data[booking_id],$data[room_id])' data-bs-toggle='modal' data-bs-target='#reviewModal' class='btn btn-outline-dark btn-sm fw-bold shadow-none'>
              //   Rate & Review
              // </button>"; 
              // }
                
              }else{
              
              }
            }else if($data['booking_status']=='breakage'){
            
        
              if($data['refund']==0){
                $btn="  <div class='text-center'>
              <span class='badge rounded-pill bg-light text-danger mb-3 text-wrap lh-base'>
                Breakge: Contact the professor for the manual breakage process.
              </span>
              </div>";
              }else{
                $btn="  <div class='text-center'>
                <span class='badge rounded-pill bg-light text-success mb-3 text-wrap lh-base'>
                  Done Complied Breakage Item
                </span>
                </div>";
              }
          //     else{
          //       $btn = "<a href='generate_pdf.php&gen_pdf&id=$data[booking_id]' onclick='download($data[booking_id])' class='btn btn-outline-success btn-sm fw-bold shadow-none'>
          //         Booking Receipt
          //     </a>";
          //     }
          //   }else{
          //     $status_bg = "bg-warning";
          //     $btn = "<a href='generate_pdf.php&gen_pdf&id=$data[booking_id]' onclick='download($data[booking_id])' class='btn btn-outline-success btn-sm fw-bold shadow-none'>
          //     Booking Receipt
          // </a>";
            }
            echo<<<bookings
              <div class='col-md-4 px-4 mb-4 w-30'>
                <div class="bg-white p-3 rounded shadown-sm">
                    <h5 class="fw-bold text-center">$data[room_name]</h5>
                    <b>Date: </b> $date <br>
                    <b>Borrow: $data[quantity] pcs</b>
                    <br>
                    <b>Remarks Breakage: $data[quantity_no] pcs</b>
                    <br>
                    <b>Volume: $data[volume] Needed</b>
                    <br>
                    <b>Group No: $data[group_no]</b>
                    <br>
                    <b>Room No: $data[apr_no]</b>
                    <p>
                      <b>Start Time: </b> $checkin <br>
                      <b>End Time: </b> $checkout 

                    </p>
                    <p>
                    
                   
                  </p>
                  <p>
                  <span class='badge $status_bg'>$data[booking_status]</span>
                  </p>
                  $btn
                </div>
              </div>
            bookings;

          }

          
          ?>
    
      
      
   </div>
  </div>












  <?php 

$contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
$values = [1];
$contact_r = mysqli_fetch_assoc(select($contact_q, $values,'i'));
// print_r($contact_r);
?>


 

  <h6 class="text-center bg-dark text-white p-3m m-0">Develop by reuel mendoza</h6>










    
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  <!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



  





      <script>


  

 
  function cancel_booking(id){
    if(confirm('Are you sure you want to cancel this booking?')){
      let data = new FormData();
      data.append('booking_id',id);
      data.append('cancel_booking','');
      let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/cancel_bookings.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
    
        if(this.responseText==1){
          window.location.href="bookings.php?cancel_status=true";
        }else{
          Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Cancellation Failed!',
                })
        }

    }

    xhr.send('cancel_booking&id='+id);
    }
  }




  let review_form = document.getElementById('review-form');

  function review_room(bid,rid){
    review_form.elements['booking_id'].value = bid;
    review_form.elements['room_id'].value = rid;
  }


  review_form.addEventListener('submit', function(e){
    e.preventDefault();

    let data = new FormData();

    data.append('review_form','');
    data.append('rating',review_form.elements['rating'].value);
    data.append('review',review_form.elements['review'].value);
    data.append('booking_id',review_form.elements['booking_id'].value);
    data.append('room_id',review_form.elements['room_id'].value);

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/review_room.php",true);

    xhr.onload = function(){
        
      if(this.responseText == 1){
        window.location.href='bookings.php?review_status=true';
      }else{
        var myModal = document.getElementById('reviewModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

      alert('error',"Rating & Review Failed");
      }
 
    }


    xhr.send(data);

  })





    

     

      </script>




</body>
</html>

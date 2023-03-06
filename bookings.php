

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
    <title>Barrowing</title>
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
session_start();
date_default_timezone_set("Asia/Manila");

$home_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
$values = [1];
$home_r = mysqli_fetch_assoc(select($home_q, $values,'i'));


if($home_r['shutdown']==1){
  echo<<<alertbar
  <div class='bg-secondary text-center p-2 fw-bold text-white'>
  <i class='bi bi-exclamation-triangle'></i> Reservations are temporarily closed because there are no available rooms!
  </div>
  alertbar;

  
}

?>





    <nav class="navbar navbar-expand-lg bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3" href="index.php"><i class="bi bi-house-fill"></i><?php echo $home_r['site_title']?></a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active me-3 fw-bold" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item"> 
              <a class="nav-link me-3 fw-bold" href="rooms.php">Apparatus</a>
            </li>
            <!--<li class="nav-item">
              <a class="nav-link me-3 fw-bold" href="about.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-3 fw-bold" href="contact.php">Contact Us</a>
            </li>-->
    
          </ul>
          <div class="d-flex">
          <?php 
          
          if(isset($_SESSION['login']) && $_SESSION['login']==true){
            echo<<<data
            
            <div class="btn-group">
            <button type="button" class="btn btn-outline-dark dropdown-toggle shadow-none" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                
                $_SESSION[uName]
                </button>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                  <li><a class="dropdown-item" href="bookings.php">Your Barrowing Item</a></li>
                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
              </div>


            data;
          }else{
            echo<<<data

            <button type="button" class="btn btn-outline-dark shadow-none me-lg-2 me-3"  data-bs-toggle="modal" data-bs-target="#loginModal">
            Login
            </button>

            data;
          }
          
          
          ?>
          </div>
        </div>
      </div>
    </nav>


    


    


    <div class="container">
        <div class="row">
            
    <div class="col-12 my-5 px-4">
        <div class="h2 fw-bold text-center">Barrowing</div>
        <div class="h-line bg-dark"></div>
        <div style="font-size:15px;">
        <a href="index.php" class="text-secondary text-decoration-none">Home</a>
        <span class="text-secondary"> > </span>
        <a href="#" class="text-secondary text-decoration-none">Barrowing</a>
    </div>
    </div>


    
          <?php 
          
          $query = "SELECT bo.*, bd.*  FROM `booking_order` bo INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id WHERE  ((bo.booking_status ='booked') OR (bo.booking_status='cancelled') OR (bo.booking_status='payment failed')) AND  (bo.user_id=?)  ORDER BY bo.booking_id DESC ";


          $result = select($query,[$_SESSION['uId']],'i');

          while($data = mysqli_fetch_assoc($result)){
            
            $date = date("d-m-Y",strtotime($data['datentime']));
            
            $checkin= date("d-m-Y g:i a",strtotime($data['check_in']));
                        
            $checkout= date("d-m-Y g:i a",strtotime($data['check_out']));

            
            $status_bg = "";
            $btn = "";

            if($data['booking_status']=='booked'){
              
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
            }else if($data['booking_status']=='cancelled'){
            
        
              if($data['refund']==0){
                $btn="  <div class='text-center'>
              <span class='badge rounded-pill bg-light text-danger mb-3 text-wrap lh-base'>
                Breakge: Contact the professor for the manual breakage process.
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
                    <b>Quantity: $data[quantity_no] pcs</b>
                    <br>
                    <b>Volume: $data[quantity] Needed</b>
                    <br>
                    <b>Group No: $data[group_no]</b>
                    <p>
                      <b>Start Time: </b> $checkin <br>
                      <b>End Time: </b> $checkout 

                    </p>
                    <p>
                    
                    <b>Order ID:  </b> $data[order_id] <br>
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


 

  <h6 class="text-center bg-dark text-white p-3m m-0">Designed and Develop by riyuuu dev</h6>

    <!-- Rate Review Modal -->
 <div class="modal fade" id="reviewModal"  data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <form id="review-form" method="POST">
            <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center"><i class="bi bi-clipboard2-pulse"></i> Rate & Review </h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Rating Room </label>
                
                  <select class="form-select shadow-none" name="rating">
                    
                  <option value="5">Excellent</option>
                  <option value="4">Good</option>
                  <option value="3">Okay</option>
                  <option value="2">Poor</option>
                  <option value="1">Bad</option>

                  </select>
                      

                </div>

                <div class="mb-4">

                <label class="form-label">Review</label>
                <textarea  class="form-control shadow-none mb-2" row="3" name="review" required ></textarea>
                </div>
                  <input type="hidden" name="booking_id">
                  <input type="hidden" name="room_id">
                
                  <div class="text-end text-center">
                    <button type="submit" class="btn btn-success shadow-none">Submit</button>
                  </div>
               
             
              </div>
            </form>
          </div>
        </div>
      </div>







<!-- Login Modal -->
<div class="modal fade" id="loginModal"  data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <form id="login-form" method="POST">
            <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-check-fill fs-3 me-2"></i>User login</h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Email/PhoneNumber</label>
                <input type="text" class="form-control shadow-none" required name="email_mob" >
                </div>
                <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" class="form-control shadow-none" required name="loginpass" >
                </div>

                <div class="mb-4"><button type="submit" class="btn btn-success mb-2 w-100 ">Login</button></div>
                <div class="mb-2 text-center text-decoration-none">
                  <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#forgotModal" >Forgot Password?</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success " style="margin-right:120px;"  data-bs-toggle="modal" data-bs-target="#registerModal">Create New Account</button>
                 </div>
             
              </div>
            </form>
          </div>
        </div>
      </div>


          
      <!---Forgot modal -->
 <div class="modal fade" id="forgotModal"  data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <form id="forgot-form">
            <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center"><i class="bi bi-shield-exclamation"></i> Forgot Password</h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-4">
              <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                Note: A link will be send to your email to reset your password!
              </span>
                <input type="email" class="form-control shadow-none" required name="email" placeholder="Email....">
                </div>
                <div class="mb-4"><button type="submit" class="btn btn-success mb-2 w-100 ">Get Reset link</button></div>
              </div>
            </form>
          </div>
        </div>
      </div>

            <!---recovery password modal -->
 <div class="modal fade" id="recoveryModal"  data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <form id="recovery-form">
            <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center"><i class="bi bi-shield-plus"></i>Set New Password</h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-4">
                <input type="password" class="form-control shadow-none" required name="pass" placeholder="New Password..">
                <input type="hidden" name="email">
                <input type="hidden" name="token">
                </div>
                <div class="mb-4"><button type="submit" class="btn btn-success mb-2 w-100 ">Submit</button></div>
              </div>
            </form>
          </div>
        </div>
      </div>
            



  

        <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form id="register-form" method="POST">
                    <div class="modal-content">
                    <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-plus-fill fs-3 me-2"></i></i>User Registration</h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="text-center">
              <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base ">
                Note: Your Details must match with your ID that will be required  during check-in.
              </span>
              </div>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control shadow-none" required name="name">
                  </div>
                  <div class="col-md-6 p-0 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control shadow-none" required name="email">
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="number" class="form-control shadow-none" required name="phonenum">
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control shadow-none" required name="address">
                   <!-- <textarea class="form-control shadow-none" name="address" rows="3" style="resize: none;" required></textarea>-->
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Password<span class="badge rounded-pill bg-light text-dark text-wrap lh-base ">
                    (8 characters minimum)
              </span></label>
                    <input type="password" class="form-control shadow-none" required name="pass" minlength="8">
                  </div>
                  <div class="col-md-6 p-0 mb-3">
                    <label class="form-label">Confirm Password  <span class="badge rounded-pill bg-light text-dark text-wrap lh-base ">
                    (8 characters minimum)
              </span></label>
                    <input type="password" class="form-control shadow-none" required name="cpass" minlength="8">
                  </div>
                </div>
                <div class="text-center my-1">
                  <button type="submit" class="btn btn-success shadow-none w-100">Register</button>
                </div>
              </div>
                    </div>
                </form>
            </div>
        </div>

      


       

    
 
<?php

if(isset($_GET['account_recovery'])){
  $data = filteration($_GET);

  $t_date = date("Y-m-d");

  $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1",[$data['email'],$data['token'],$t_date],'sss');


  if(mysqli_num_rows($query)==1){
    echo <<<showModal
      <script>
    var myModal = document.getElementById('recoveryModal')

    myModal.querySelector("input[name='email']").value = '$data[email]';
    myModal.querySelector("input[name='token']").value = '$data[token]';

    var modal = bootstrap.Modal.getOrCreateInstance(myModal) // Returns a Bootstrap modal instanceof
    modal.show();
    </script>
    showModal;
  }else{
    echo '<script>alert("Invalid Link")</script>';
  }

}

?>



 



    
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

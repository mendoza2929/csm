<?php 

require("alert.php");
require("db.php");
adminLogin();
// session_regenerate_id(true);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM - DASHBOARD</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="dash.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">


  </head>
<body class="bg-light">
 

  <?php require('header.php');

  
  
  $is_shutdown = mysqli_fetch_assoc(mysqli_query($con,"SELECT `shutdown` FROM `settings`"));

  $current_bookings = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(CASE WHEN booking_status='booked' AND arrival=0 THEN 1 END) AS `new_bookings`, COUNT(CASE WHEN booking_status='cancelled' AND refund=0 then 1 END) AS `refund_bookings` FROM `booking_order`"));
  
  $unread_queries = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(sr_no) AS `count` FROM `user_queries` WHERE `seen`=0"));
 
  $unread_reviews = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(sr_no) AS `count` FROM `rating_review` WHERE `seen`=0"));


  $current_user = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(id) AS `total`, COUNT(CASE WHEN `status`=1 THEN 1 END) AS `active`, COUNT(CASE WHEN `status`=0  then 1 END) AS `inactive`, COUNT(CASE WHEN `is_verified`=0  then 1 END) AS `unverified` FROM `user_cred`"));

 
  $username = "root";
  $password = "";
  $database = "klc";

  try{
    $pdo = new PDO("mysql:host=localhost;database=$database",$username,$password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(PDOException $e){
    die("ERROR: Could not connect".$e->getMessage());
  }
  
 
  
  

?>
  







  

    <div class="container-fluid" id="main-content">
      <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
          <div class="d-flex align-items-center justify-content-between mb-4">
            <h3><i class="bi bi-people"></i> Dashboard</h3>
            <?php 
            if($is_shutdown['shutdown']){
              echo<<<data
              <h6 class="badge bg-danger py-2 px-3">Shutdown Mode is Active!</h6>
              data;
            }
            ?>
            
          </div>
          <div class="text-end mb-4">
                        <button type="button" class="btn btn-warning btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#email">
                        <i class="bi bi-envelope-check"></i> Send Message
                            </button>
                        </div>

                    
          
          <div class="chartMenu">
    
    </div>
    <div class="chartCard">
      <div class="chartBox">
        <canvas id="myChart" width="600" height="400"></canvas>
     
        
      </div>
    </div>
            

            <?php 
            
            try{
              $sql = "SELECT bo.*, bd.*  FROM klc.booking_order bo INNER JOIN klc.booking_details bd ON bo.booking_id = bd.booking_id";
              $result = $pdo->query($sql);
              if($result->rowCount()>0){
              
                $dateArray = [];
                while($row = $result->fetch()){
                  $dateArray[] = $row["datentime"];
                  $amountArray[] = $row["total_pay"];
                  
                }
             
                unset($result);
              }else{
                echo "No Records Found";
              }
            }catch(PDOException $e){
              die("ERROR: Could not able to execute query" . $e->getMessage());
            }
            
            unset($pdo);



            



            
            ?>



    

            
          
            <div class="row mt-5">
              <div class="col-md-3 mb-4">
                  <a href="new_bookings.php" class="text-decoration-none">
                    <div class="card text-center p-3 text-success">
                        <h5><i class="bi bi-house-add"></i> New Reservation</h5>
                        <h1 class="mt-2 mb-0"><?php echo $current_bookings['new_bookings'] ?></h1>
                    </div>
                  </a>
              </div>
              <div class="col-md-3 mb-4">
                  <a href="refund_bookings.php" class="text-decoration-none">
                    <div class="card text-center p-3 text-success">
                        <h5><i class="bi bi-emoji-expressionless"></i> Refund Booking</h5>
                        <h1 class="mt-2 mb-0"><?php echo $current_bookings['refund_bookings'] ?></h1>
                    </div>
                  </a>
              </div>
              <div class="col-md-3 mb-4">
                  <a href="user_queries.php" class="text-decoration-none">
                    <div class="card text-center p-3 text-success">
                        <h5><i class="bi bi-chat"></i> User Inquiry</h5>
                        <h1 class="mt-2 mb-0"><?php echo $unread_queries['count']?></h1>
                    </div>
                  </a>
              </div>
              <div class="col-md-3 mb-4">
                  <a href="rating_reviews.php" class="text-decoration-none">
                    <div class="card text-center p-3 text-success">
                        <h5><i class="bi bi-chat-square-heart"></i> Rate & Review</h5>
                        <h1 class="mt-2 mb-0"><?php echo $unread_reviews['count']?></h1>
                    </div>
                  </a>
              </div>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-3">
            <h5><i class="bi bi-journals"></i> Booking Analytics</h5>
            <select class="form-select shadow-none bg-light w-auto" onchange="booking_analytics(this.value)">
              <option value="1">Past 30 Days</option>
              <option value="2">Past 90 Days</option>
              <option value="3">Past 1 Year</option>
              <option value="4">All Time</option>
            </select>
          </div>


          <div class="row mb-3">
             <div class="col-md-3 mb-4">
                    <div class="card text-center p-3 text-primary">
                      <h6><i class="bi bi-cash-stack"></i> Total Bookings</h6>
                      <h1 class="mt-2 mb-0" id="total_bookings">0</h1>
                      <h4 class="mt-2 mb-0" id="total_amt">0</h4>
                    </div>
              </div>
              <div class="col-md-3 mb-4">
                    <div class="card text-center p-3 text-primary">
                      <h6><i class="bi bi-wallet"></i> Active Bookings</h6>
                      <h1 class="mt-2 mb-0" id="active_bookings">0</h1>
                      <h4 class="mt-2 mb-0" id="active_amt">0</h4>
                    </div>
              </div>
              
              <div class="col-md-3 mb-4">
                    <div class="card text-center p-3 text-primary">
                      <h6><i class="bi bi-x-square"></i> Cancelled Bookings</h6>
                      <h1 class="mt-2 mb-0" id="cancelled_bookings">0</h1>
                      <h4 class="mt-2 mb-0" id="cancelled_amt"> 0</h4>
                    </div>
              </div>
            </div>


            <div class="d-flex align-items-center justify-content-between mb-4">
            <h5><i class="bi bi-chat-right-heart"></i> User, Inquiry , Review </h5>
            <select class="form-select shadow-none bg-light w-auto" onchange="user_analytics(this.value)">
              <option value="1">Past 30 Days</option>
              <option value="2">Past 90 Days</option>
              <option value="3">Past 1 Year</option>
              <option value="4">All Time</option>
            </select>
          </div>  

          <div class="row mb-3">
              <div class="col-md-3 mb-4">
                    <div class="card text-center p-3 text-secondary">
                      <h6><i class="bi bi-cash-stack"></i> New Registration</h6>
                      <h1 class="mt-2 mb-0" id="total_new_reg">5</h1>
                 
                    </div>
              </div>
              <div class="col-md-3 mb-4">
                    <div class="card text-center p-3 text-secondary">
                      <h6><i class="bi bi-wallet"></i> Inquiry</h6>
                      <h1 class="mt-2 mb-0" id="total_queries">5</h1>
               
                    </div>
              </div>
              <div class="col-md-3 mb-4">
                    <div class="card text-center p-3 text-secondary">
                      <h6><i class="bi bi-x-square"></i> Reviews</h6>
                      <h1 class="mt-2 mb-0" id="total_review">5</h1>
                 
                    </div>
              </div>
            </div>

            <h5><i class="bi bi-people"></i> Users</h5>
            <div class="row mb-3">
              <div class="col-md-3 mb-4">
                    <div class="card text-center p-3 text-primary">
                      <h6><i class="bi bi-person-check"></i> Total</h6>
                      <h1 class="mt-2 mb-0"><?php echo $current_user['total']?></h1>
                 
                    </div>
              </div>
              <div class="col-md-3 mb-4">
                    <div class="card text-center p-3 text-success">
                      <h6><i class="bi bi-person-lock"></i> Active</h6>
                      <h1 class="mt-2 mb-0"><?php echo $current_user['active']?></h1>
               
                    </div>
              </div>
              <div class="col-md-3 mb-4">
                    <div class="card text-center p-3 text-danger">
                      <h6><i class="bi bi-person-x"></i> Unvarified</h6>
                      <h1 class="mt-2 mb-0"><?php echo $current_user['unverified']?></h1>
                 
                    </div>
              </div>
            </div>



        </div>
      </div>
    </div>


        
        <!----email Modal-->

        <div class="modal fade" id="email" data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="send.php" id="email_form" method="post" enctype="multipart/form-data">
                    <div class="modal-content">
                    <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-plus-fill fs-3 me-2"></i></i>User Registration</h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="text-center">
              <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base ">
                Note: Sending a message to every registered user regarding an important announcement.
              </span>
              </div>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6 ps-0 mb-3">
                    <label for="sender_name" class="form-label">Sender Name</label>
                    <input type="text" class="form-control shadow-none" id="sender_name" name="sender_name" required >
                  </div>
                  <div class="col-md-6 p-0 mb-3">
                    <label for="sender_email" class="form-label">Sender Email</label>
                    <input type="email" class="form-control shadow-none" required id="sender" name="sender">
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control shadow-none" required id="subject" name="subject">
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label for="attachments" class="form-label">Attachments (multiple)</label>
                    <input type="file" class="form-control shadow-none" multiple id="attachments" name="attachments[]">
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                 
                    <label for="recipient" class="form-label">Recipient Emails</label>
                    <textarea class="form-control shadow-none" name="recipient" id="recipient" style="resize:none;" rows="3" cols="50" placeholder="Type a user email..."></textarea>
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label for="recipient" class="form-label">Message</label>
                    <textarea class="form-control shadow-none" id="body" name="body" style="resize:none;" rows="3" cols="50" placeholder="Type a message to be sent to the user..."></textarea>
                  </div>
                </div>
                <div class="text-center my-1">
                  <button type="submit" name="send" class="btn btn-success shadow-none w-100">Send Message</button>
                </div>
              </div>
                    </div>
                </form>
            </div>
        </div>


 <!-- JavaScript Bundle with Popper -->
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>





<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>






    <script>
      const dataArrayJS= <?php echo json_encode($dateArray);?>;
      console.log(dataArrayJS);

      const dataChartJS= dataArrayJS.map((day,index)=>{
        let dayjs = new Date(day);
        console.log(dayjs)
        return dayjs.setHours(0,0,0,0); 
      })
    
      console.log(dataChartJS);

      const  $amountArray = <?php echo json_encode($amountArray);?>;
      console.log($amountArray);




    const data = {
      labels: dataChartJS,
      datasets: [{
        label: 'Business Analytics',
        data:$amountArray,
        backgroundColor: [
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(0, 0, 0, 0.2)'
        ],
        borderColor: [
          'rgba(255, 26, 104, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(0, 0, 0, 1)'
        ],
        borderWidth: 1
      }]
    };

    // config 
    const config = {
      type: 'bar',
      data,
      options: {
        scales: {
          x:{
            type: 'time',
            time:{
              unit: 'day',
            }
          },
          y: {
            beginAtZero: true
          }
        }
      }
    };

    // render init block
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );

    // function filterChart(months){
    //   console.log(months.value)
    //   myChart.config.options.scales.x.min =luxon.DateTime.now().plus({months:-months.value}).toISODate() ;
    //   myChart.config.options.scales.x.max = luxon.DateTime.now();
    //   myChart.update();

    // }

    </script>






<script>




function booking_analytics(period=1){
        
        let xhr = new XMLHttpRequest();
            xhr.open("POST","./dashboard/dashboard_ajax.php",true);
            xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    
            xhr.onload = function(){
                let data = JSON.parse(this.responseText);
                document.getElementById('total_bookings').textContent = data.total_bookings;
                document.getElementById('total_amt').textContent = '₱'+ data.total_amt;
    
                document.getElementById('active_bookings').textContent = data.active_bookings;
                // document.getElementById('active_amt').textContent = '₱'+ data.active_amt;
    
                document.getElementById('cancelled_bookings').textContent = data.cancelled_bookings;
                document.getElementById('cancelled_amt').textContent = '₱'+ data.cancelled_amt;
            }
            xhr.send('booking_analytics&period='+period);
    
    }
    



function user_analytics(period=1){
        
        let xhr = new XMLHttpRequest();
            xhr.open("POST","dashboard/dashboard_ajax.php",true);
            xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    
            xhr.onload = function(){
                let data = JSON.parse(this.responseText);
                document.getElementById('total_new_reg').textContent = data.total_new_reg;
        
    
                document.getElementById('total_queries').textContent = data.total_queries;
      
    
                document.getElementById('total_review').textContent = data.total_review;
                
            }
            xhr.send('user_analytics&period='+period);
    
    }
    



    window.onload = function(){
      booking_analytics();
      user_analytics();
    }


    




</script>











</body>
</html>
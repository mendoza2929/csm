
<?php 

 require("db.php");
 require("alert.php");

        session_start();
        if((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true)){
           redirect('dashboard.php');
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin CSM</title>
    <!-- CSS only -->
    
<Link rel="stylesheet" href="main.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>

  <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>


</head>

<body class="bg-light">


<?php 




$home_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
$values = [1];
$home_r = mysqli_fetch_assoc(select($home_q, $values,'i'));





?>
    
  <div class="login-form text-center rounded bg-white shadow overflow-hidden">
      <form method="POST" autocomplete="off">
          <h4 class="bg-secondary text-white py-3 "><?php echo $home_r['site_title']?></h4>
          <div class="p-4">
              <div class="mb-3">
                  
                  <input name="admin_name" required type="text" class="form-control shadow-none text-center" placeholder="Email" > 
              </div>
              <div class="mb-4">
      
                  <input name="admin_pass" required   type="password" class="form-control shadow-none text-center" placeholder="Password" >
              </div>
            
              <button name="login" type="submit" class="btn btn-success shadow-none me-lg-2 me-3 w-100" data-bs-toggle="modal" data-bs-target="#loginModal">
        Login   
        </button>
          </div>
      </form>
  </div>


    <?php 
    
    // admin login 
    
    if(isset($_POST['login']))
    
    {
        $frm_data=filteration($_POST);
        
        $query = "SELECT * FROM `admin_cred` WHERE `admin_name`=? AND `admin_pass`=? " ;
        $values = [$frm_data['admin_name'],$frm_data['admin_pass']];
       

       $res = select($query,$values,"ss");
       if($res -> num_rows==1){
            $row = mysqli_fetch_assoc($res);
            $_SESSION['adminLogin'] = true;
            $_SESSION['adminId'] = $row['sr_no'];
            redirect('dashboard.php');
       }
       else{
            alert('error', 'Login Failed - Invalid Admin!');
       }
    }
    
    ?>




<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
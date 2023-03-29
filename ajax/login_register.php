<?php 

require('../admin/db.php');
require('../admin/alert.php');
require('../sendgrid-php/sendgrid-php.php');

date_default_timezone_set("Asia/Manila"); 


// function send_Mail($uemail,$token,$type){

//     if($type == "email_confirmation"){
//         $page = 'email_confirm.php';
//         $subject = "Account Verification Link";
//         $content = "Confirm your Email";
//     }
//     else{
//         $page = 'index.php';
//         $subject = "Account Reset Link";
//         $content = "Confirm Reset Password";
//     }
    

//     $email = new \SendGrid\Mail\Mail(); 
//     $email->setFrom(SENDGRID_EMAIL,SENDGRID_NAME);
//     $email->setSubject($subject);

//     $email->addTo($uemail);

  
//     $email->addContent(
//         "text/html", "Click the link to $content: <br> <a href='".SITE_URL."$page?$type&email=$uemail&token=$token"."'>Click Here</a>"
//     );

//     $sendgrid = new \SendGrid(SENDGRID_API_KEY);
    
//     try{
//         $sendgrid->send($email);
//         return 1;
//     }catch (Exception $e){
//         return 0;
//     }
// }


if(isset($_POST['register'])){    
      
    $data = filteration($_POST);

    // if($data['pass'] != $data['cpass']){
    //     echo 'password_mismatch';
    //     exit;
    // }
     
    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1",[$data['email'],$data['phonenum']],"ss");

    if(mysqli_num_rows($u_exist)!=0){
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
  
        exit;
    }
    // send comfirmation link to the users email
    $token = bin2hex(random_bytes(16));

    // if(!send_Mail($data['email'],$token,"email_confirmation")){
    //     echo 'mail_failed';
    //     exit;
    // }

    // $enc_pass = password_hash($data['pass'],PASSWORD_BCRYPT);

    $query = "INSERT INTO `user_cred`(`name`,`student_id`, `email`,`phonenum`,`course`,`year`, `token`) VALUES (?,?,?,?,?,?,?)"; // insert `profile`

    $values = [$data['name'],$data['student_id'],$data['email'],$data['phonenum'],$data['course'],$data['year'],$token]; //$img insert before phonenum

    if(insert($query,$values,'sssssss')){
        echo 1;
    }else {
        echo 'ins_failed';
    }    
}


// if(isset($_POST['login'])){
    
//     $data = filteration($_POST);

//     $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1",[$data['email_mob'],$data['email_mob']],"ss");

//     if(mysqli_num_rows($u_exist)==0){
//         echo 'inv_email_mob'; 
//     }
//     else{
//         $u_fetch = mysqli_fetch_assoc($u_exist);
//             if(!password_verify($data['loginpass'],$u_fetch['password'])){
//                 echo 'invalid_pass';
//             }else{
//                 session_start();
//                 $_SESSION['login']=true;
//                 $_SESSION['uId']=$u_fetch['id'];
//                 $_SESSION['uName']=$u_fetch['name'];
//                 $_SESSION['uPhone']=$u_fetch['phonenum'];
//                 echo 1;
//             }
        
//     }
// }
if(isset($_POST['login'])){
    
    $data = filteration($_POST);

    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1",[$data['email_mob'],$data['email_mob']],"ss");

    if(mysqli_num_rows($u_exist)==0){
        echo 'inv_email_mob'; 
    }
    else{
        $u_fetch = mysqli_fetch_assoc($u_exist);
        session_start();
        $_SESSION['login']=true;
        $_SESSION['uId']=$u_fetch['id'];
        $_SESSION['uName']=$u_fetch['name'];
        $_SESSION['uPhone']=$u_fetch['phonenum'];
        echo 1;
    }
}



// if(isset($_POST['forgot'])){
//     $data = filteration($_POST);
    
    
//     $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? LIMIT 1",[$data['email']],"s");

//     if(mysqli_num_rows($u_exist)==0){
//         echo 'inv_email'; 
//     }
//     else{
//         $u_fetch = mysqli_fetch_assoc($u_exist);
//         if($u_fetch['is_verified']==0){
//             echo 'not_verified';
//         }
//         else if($u_fetch['status']==0){
//             echo 'inactive';
//         }
//         else{
//             //send reset link 
//             $token = bin2hex(random_bytes(16));

//             if(($data['email'],$token,'account_recovery')){
//                 echo 'email_failed';
//             }else{
               
//                 $date = date("Y-m-d");
//                 $query = mysqli_query($con,"UPDATE `user_cred` SET `token`='$token',`t_expire`='$date'  WHERE `id`='$u_fetch[id]'");
                
//                 if($query){
//                     echo 1;
//                 }else{
//                     echo 'upd_failed';
//                 }
//             }
//         }
//     }


// }



if(isset($_POST['recovery_pass'])){
    $data = filteration($_POST);
  
    $enc_pass = password_hash($data['pass'],PASSWORD_BCRYPT);
  
    $query = "UPDATE `user_cred` SET `password`=?, `token`=?,`t_expire`=?  WHERE `email`=? AND `token`=?";
  
    $values = [$enc_pass,null,null,$data['email'],$data['token']];
  
    if(update($query,$values,'sssss')){
      echo 1;
    }
    else{
      echo 'failed';
    }
  }
  
  
  





?>
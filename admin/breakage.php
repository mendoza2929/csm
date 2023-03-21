<?php 

require("alert.php");
require("db.php");

adminLogin();
// session_regenerate_id(true);


// if(isset($_GET['seen'])){
//     $frm_data =filteration($_GET);

//     if($frm_data['seen']=='all'){
//         $q = "UPDATE `user_queries` SET `seen`=?";
//         $values= [1];
//         if(update($q,$values,'i')){
//             alert('success','Mark all as read');
//         } 
//     }
//     else{
//         $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
//         $values= [1,$frm_data['seen']];
//         if(update($q,$values,'ii')){
//             alert('success','Mark as read');
//         } 
//     }
// }


// if(isset($_GET['del'])){
//     $frm_data =filteration($_GET);

//     if($frm_data['del']=='all'){
//         // $q = "DELETE FROM `user_queries`";
//         // if(mysqli_query($con,$q)){
//         //     alert('success','All inquiry Deleted');
//         // }
//     }
//     else{
//         $q = "DELETE FROM `user_queries` WHERE `sr_no`=?";
//         $values= [$frm_data['del']];
//         if(delete($q,$values,'i')){
//             alert('success','Inquiry Deleted');
//         }
        
//     }
// }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM - BREAKAGE SECTION</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="room.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body class="bg-light">
 

  <?php require('header.php') ?>



    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-y">
                <h3 class="mb-4"><i class="bi bi-people-fill"></i> All Breakage Records</h3>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">

                        <div class="text-end mb-4">
                           <input type="text"  id="search_input" oninput="get_breakage(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search.." >
                        </div>
                     

                

                           <div class="table-responsive">
                           <table class="table table-hover border text-center" style="min-width:1300px;">
                            <thead>
                                <tr class="bg-secondary text-white">
                                <th scope="col">#</th>
                                <th scope="col">Teacher</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Room Number</th>
                                <th scope="col">Date</th>
                                
                                </tr>
                            </thead>
                            <tbody id="breakage_data">
                          
                             
                           
                            </tbody>
                            </table>
                            </div>
                            
                            <nav >
                            <ul class="pagination mt-3" id="table-pagination">
                               
                            </ul>
                            </nav>

                        </div>
                    </div>
                    

                    
                    


            </div>
        </div>
    </div>



      

     


 <?php 
require ("script.php");
?> 
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>




<script>



function get_breakage(search='',page=1){
        
        let xhr = new XMLHttpRequest();
            xhr.open("POST","breakage_ajax.php",true);
            xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    
            xhr.onload = function(){
                let data = JSON.parse(this.responseText);
                document.getElementById('breakage_data').innerHTML = data.table_data;
                document.getElementById('table-pagination').innerHTML = data.pagination;
            }
            xhr.send('get_breakage&search='+search+'&page='+page);
    
    }
    
    
    
    function change_page(page){
       get_breakage(document.getElementById('search_input').value,page);
    }

    
    function search_user(username){
        let xhr = new XMLHttpRequest();
        xhr.open("POST","users_ajax.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        xhr.onload = function(){
            document.getElementById('user_data').innerHTML = this.responseText;
        }
        xhr.send('search_user&name='+username);
    }

    
window.onload = function(){
        get_breakage();
    }







    

    
    






</script>



<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
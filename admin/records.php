<?php 

require("alert.php");
require("db.php");

adminLogin();


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM - Records</title>
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
                <h3 class="mb-4"><i class="bi bi-journal-arrow-up"></i> Apparatus Records</h3>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">

                        <form action="excel.php" method="post">
                        <button type="submit" name="export_excel" class="btn btn-success btn-sm shadow-none mt-2 mb-2 text-start me-2">
                            <i class="bi bi-file-earmark-spreadsheet"></i> Export to excel
                            </button>
                        </form>

                        <div class="text-end mb-4">
                           <input type="text"  id="search_input" oninput="get_bookings(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search..">
                        </div>


                           <div class="table-responsive">
                           <table class="table table-hover border " style="min-width:300px;">
                            <thead>
                                <tr class="bg-secondary text-white">
                                <th scope="col">#</th>
                                <th scope="col">User Details</th>
                                <th scope="col">Item Discription</th>
                                <th scope="col">Time Details</th> 
                                <th scope="col">Status</th> 
                               
                                </tr>
                            </thead>
                            <tbody id="table-data">
                          
                             
                           
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

<script>




function get_bookings(search='',page=1){
        
    let xhr = new XMLHttpRequest();
        xhr.open("POST","booking_records.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        xhr.onload = function(){
            let data = JSON.parse(this.responseText);
            document.getElementById('table-data').innerHTML = data.table_data;
            document.getElementById('table-pagination').innerHTML = data.pagination;
        }
        xhr.send('get_bookings&search='+search+'&page='+page);

}



function change_page(page){
   get_bookings(document.getElementById('search_input').value,page);
}


function download(id){
    window.location.href = 'generate_pdf.php?gen_pdf&id='+id;
}











    

    
    // function remove_user(user_id){
        
    //     if(confirm("Are you sure you want to remove this tenant?")){
    //         let data = new FormData();
    //         data.append('user_id',user_id);
    //         data.append('remove_user','');
            
    //     let xhr = new XMLHttpRequest();
    //      xhr.open("POST","users_ajax.php",true);
    

    //         xhr.onload = function(){
    //             if(this.responseText== 1){
    //                  Swal.fire(
    //                 'Deleted!',
    //                 'Tenant has been deleted',
    //                 'success'
    //                 )
    //                 get_users();
    //             }else{
    //                 Swal.fire({
    //             icon: 'error',
    //             title: 'Oops...',
    //             text: 'Something went wrong!',
                
    //             })
    //             }
              
    //         }
    //         xhr.send(data);
    //     }

    // }




    function search_user(username){
        let xhr = new XMLHttpRequest();
        xhr.open("POST","users_ajax.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        xhr.onload = function(){
            document.getElementById('user_data').innerHTML = this.responseText;
        }
        xhr.send('search_user&name='+username);
    }


    
// function cancel_booking(id){

// if(confirm("Are your sure to checkout this booking?")){
//         let data = new FormData();
//         data.append('booking_id',id);
//         data.append('cancel_booking','');
        
//     let xhr = new XMLHttpRequest();
//      xhr.open("POST","new_reservation.php",true);


//         xhr.onload = function(){
//             if(this.responseText== 1){
//                  Swal.fire(
//                 'Success',
//                 'Checkout Successfully',
//                 'success'
//                 )
//                 get_bookings();
//             }else{
//                 Swal.fire({
//             icon: 'error',
//             title: 'Oops...',
//             text: 'Something went wrong!',
            
//             })
//             }
          
//         }
//         xhr.send(data);
//     }
// }




    window.onload = function(){
        get_bookings();
    }


    




</script>



<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
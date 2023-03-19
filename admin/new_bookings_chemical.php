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
    <title>CSM - New Chemical</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="dashmain.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body class="bg-light">
 

  <?php require('header.php') ?>



    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-y">
                <h3 class="mb-4"><i class="bi bi-people-fill"></i> All Chemical Borrowing</h3>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">

                        <div class="text-end mb-4">
                           <input type="text" oninput="get_booking_chemical(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search..">
                        </div>


                           <div class="table-responsive">
                           <table class="table table-hover border " style="min-width:1200px;">
                            <thead>
                                <tr class="bg-secondary text-white">
                                <th scope="col">#</th>
                                <th scope="col">User Details</th>
                                <th scope="col">Item Description</th>
                                <th scope="col">Time Details</th> 
                                <th scope="col">Action</th> 
                                </tr>
                            </thead>
                            <tbody id="table-data-chemical">
                          
                             
                           
                            </tbody>
                            </table>
                            </div>

                        </div>
                    </div>
                    

                    
                    


            </div>
        </div>
    </div>



               <!----assign Room Number Modal-->

               <div class="modal fade" id="assign-chemical" data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="assign_chemical_form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-title"><i class="bi bi-clipboard-check-fill"></i>Aproved Chemical</div>
                        </div>
                        <div class="modal-body"> 
                            <div class="mb-3">
                                <label class="form-label fw-bold">This chemical obtained confirmation</label>
                                <input type="hidden" name="chemical_no">
                            </div>
                         <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base ">
                            Note: Are you certain that this chemical has a permit?
                        </span>
                        <input type="hidden" name="booking_id">
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success shadow-none">Confirm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        
               <!----assign Room Number Modal-->

               <!--<div class="modal fade" id="quantity-room" data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="quantity_room_form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-title"><i class="bi bi-clipboard-check-fill"></i> Breakage Item</div>
                        </div>
                        <div class="modal-body"> 
                            <div class="mb-3">
                                <label class="form-label fw-bold">Breakage Quantity</label>
                                <input type="text" name="quantity_no" class="form-control shadow-none">
                            </div>
                         <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base ">
                            Note: Check first the Item Quantity
                        </span>
                        <input type="hidden" name="booking_id">
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success shadow-none">Approved</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>-->


      

     


 <?php 
require ("script.php");
?> 
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>




function get_booking_chemical(search=''){
        
    let xhr = new XMLHttpRequest();
        xhr.open("POST","new_chemical.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        xhr.onload = function(){
            document.getElementById('table-data-chemical').innerHTML = this.responseText;
        }
        xhr.send('get_booking_chemical&search='+search);

}





// let quantity_room_form = document.getElementById('quantity_room_form');

// function quantity_room(id){
//     quantity_room_form.elements['booking_id'].value=id;
// }

// quantity_room_form.addEventListener('submit',function(e){
//     e.preventDefault();

//     let data = new FormData();
//     data.append('quantity_no',quantity_room_form.elements['quantity_no'].value);
//     data.append('booking_id',quantity_room_form.elements['booking_id'].value);
//     data.append('quantity_room','');


//     let xhr = new XMLHttpRequest();
//     xhr.open("POST","new_reservation.php",true);

//     xhr.onload = function(){
//         var myModal = document.getElementById('quantity-room');
//         var modal = bootstrap.Modal.getInstance(myModal);
//         modal.hide();



//         if(this.responseText==1){
//             Swal.fire(
//                 'Good job!',
//                 'Breakage Item Update!',
//                 'success'
//                 )
//                 quantity_room_form.reset();
//                 get_bookings();
//         }else{
//             Swal.fire({
//                 icon: 'error',
//                 title: 'Oops...',
//                 text: 'Something went wrong!',
//                 })
//         }
//     }

//     xhr.send(data);
    
// });













let assign_chemical_form = document.getElementById('assign_chemical_form');

function assign_chemical(id){
    assign_chemical_form.elements['booking_id'].value=id;
}

assign_chemical_form.addEventListener('submit',function(e){
    e.preventDefault();

    let data = new FormData();

    data.append('chemical_no',assign_chemical_form.elements['chemical_no'].value);
    data.append('booking_id',assign_chemical_form.elements['booking_id'].value);
    data.append('assign_chemical','');


    let xhr = new XMLHttpRequest();
    xhr.open("POST","new_chemical.php",true);

    xhr.onload = function(){
        var myModal = document.getElementById('assign-chemical');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

    

        if(this.responseText==1){
            Swal.fire(
                'Good job!',
                'Chemical Confirmation!',
                'success'
                )
                assign_chemical_form.reset();
                get_booking_chemical();
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                })
        }
    }

    xhr.send(data);
    
});


// function cancel_booking(id){

//     if(confirm("Are you sure that this item has broken?")){
//             let data = new FormData();
//             data.append('booking_id',id);
//             data.append('cancel_booking','');
            
//         let xhr = new XMLHttpRequest();
//          xhr.open("POST","new_reservation.php",true);
    

//             xhr.onload = function(){
//                 if(this.responseText== 1){
//                      Swal.fire(
//                     'Reminder!',
//                     'Item has been broken',
//                     'success'
//                     )
//                     get_bookings();
//                 }else{
//                     Swal.fire({
//                 icon: 'error',
//                 title: 'Oops...',
//                 text: 'Something went wrong!',
                
//                 })
//                 }
              
//             }
//             xhr.send(data);
//         }
// }








    

    
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


    window.onload = function(){
        get_booking_chemical();
    }





</script>



<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
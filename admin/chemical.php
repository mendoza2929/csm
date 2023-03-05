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
    <title>CSM - Chemical</title>

    <link rel="stylesheet" href="dashmain.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>
<body>

<?php require('header.php') ?>


<div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-y">
                <h3 class="mb-4"><i class="bi bi-clipboard2-pulse"></i> Chemical</h3>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                     
                        <div class="text-end mb-4">
                            
                            <button type="button" class="btn btn-warning btn-sm shadow-none mb-2" data-bs-toggle="modal" data-bs-target="#add-chemical">
                            <i class="bi bi-file-plus"></i> Add
                            </button>
                            <input type="text" oninput="search_chemical(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search..">
                        </div>


                           <div class="table-responsive-lg" style="height:450px; overflow-y:scroll;">
                           <table class="table table-hover border text-center">
                            <thead>
                                <tr class="bg-secondary text-white">
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Size</th>
                                <th scope="col">Details</th> 
                                <th scope="col" >Quantity</th>
                                <th scope="col">Status</th> 
                                <th scope="col">Action</th> 
                                </tr>
                            </thead>
                            <tbody id="chemical_data">
                          
                             
                           
                            </tbody>
                            </table>
                            </div>

                        </div>
                    </div>
                    

                    
                    


            </div>
        </div>
    </div>


      <!----chemical Modal-->

      <div class="modal fade" id="add-chemical" data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form id="add_chemical_form" autocomplete="off">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-title fw-bold"><i class="bi bi-plus-square"></i> Add Chemical</div>
                        </div>
                        <div class="modal-body"> 
                            <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Name of Reagent</label>
                                <input type="text" name="name" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Size</label>
                                <input type="number" min="1" name="area" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Quantity</label>
                                <input type="number" name="quantity" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Available</label>
                                <input type="number" min="1"  name="avail" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Per Student</label>
                                <input type="number" min="1" name="student" class="form-control shadow-none">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Facilities</label>
                                <div class="row">
                                    <?php 
                                    
                                    $res = selectAll('features');
                                    while($opt = mysqli_fetch_assoc($res)){
                                        echo"
                                            <div class='col-md-3 mb-1'>
                                                <label>
                                                    <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none' >          
                                                    $opt[name]
                                                </label>
                                            </div>
                                        ";
                                    }
                                    
                                    ?> 
                                </div>
                            </div>
                          
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success shadow-none">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

            <!----edit Modal-->

            <div class="modal fade" id="edit-chemical" data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form id="edit_chemical" autocomplete="off">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-title fw-bold"><i class='i bi-pencil-square'></i> Edit Chemical</div>
                        </div>
                        <div class="modal-body"> 
                            <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Name of Reagent</label>
                                <input type="text" name="name" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Size</label>
                                <input type="number" min="1" name="area" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Quantity</label>
                                <input type="number" name="quantity" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Available</label>
                                <input type="number" min="1"  name="avail" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Per Student</label>
                                <input type="number" min="1" name="student" class="form-control shadow-none">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Size</label>
                                <div class="row">
                                    <?php 
                                    
                                    $res = selectAll('features');
                                    while($opt = mysqli_fetch_assoc($res)){
                                        echo"
                                            <div class='col-md-3 mb-1'>
                                                <label>
                                                    <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none' >          
                                                    $opt[name]
                                                </label>
                                            </div>
                                        ";
                                    }
                                    
                                    ?> 
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="desc" rows=4 class="form-control shadow-none" required></textarea>
                            </div>
                            <input type="hidden" name="chemical_id">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success shadow-none">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>



        <!-- Room Images Modal -->
<div class="modal fade" id="room_images" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-card-image"></i> Room Image</h5>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></button>
      </div>
      <div class="modal-body">
        <div id="image-alert">

        </div>
            <div class="border-bottom border-3 pb-3 mb-3">
                <form id="add_image_form">
                <label class="form-label fw-bold">Add Image</label>
                <input type="file" name="image" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none mb-3" required>
                <button type="submit" class="btn btn-success shadow-none">Add</button>
                <input type="hidden" name="room_id">
                 </form>
            </div>
            <div class="table-responsive-lg" style="height:350px; overflow-y:scroll;">
                           <table class="table table-hover border text-center">
                            <thead>
                                <tr class="bg-secondary text-white sticky-top">
                                <th scope="col" width="60%">Image</th>
                                <th scope="col">Select Image</th>
                                <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="room-image-data">
                            </tbody>
                            </table>
                            </div>
         </div>
     </div>
    </div>
</div>


<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>


<?php 
require ("script.php");
?> 
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

let add_chemical_form = document.getElementById('add_chemical_form');

add_chemical_form.addEventListener('submit', function(e){
    e.preventDefault();
    add_chemical();
});

function add_chemical(){
    let data= new FormData();
        data.append('add_chemical','');
        data.append('name',add_chemical_form.elements['name'].value);
        data.append('area',add_chemical_form.elements['area'].value);
        data.append('quantity',add_chemical_form.elements['quantity'].value);
        data.append('avail',add_chemical_form.elements['avail'].value);
        data.append('student',add_chemical_form.elements['student'].value);
        // data.append('desc',add_chemical_form.elements['desc'].value);


        let features = [];

        add_chemical_form.elements['features'].forEach(el => {
            if(el.checked){
                features.push(el.value);
            }
        });

        data.append('features',JSON.stringify(features));


        let xhr = new XMLHttpRequest();
        xhr.open("POST","chemical_ajax.php",true);

        xhr.onload = function(){
            var myModalEl = document.getElementById('add-chemical')
            var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
            modal.hide();

            if(this.responseText==1){
                Swal.fire(
                'Good job!',
                'Chemical Added',
                'success'
                )
                add_chemical_form.reset();
                get_chemical();
                
            }else{
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                })
            }

        }
        xhr.send(data);
}


function get_chemical(){
        
    let xhr = new XMLHttpRequest();
        xhr.open("POST","chemical_ajax.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        xhr.onload = function(){
            document.getElementById('chemical_data').innerHTML = this.responseText;
        }
        xhr.send('get_chemical');

}







function toggleStatus(id,val){
        
        let xhr = new XMLHttpRequest();
            xhr.open("POST","chemical_ajax.php",true);
            xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        
            xhr.onload = function(){
                if(this.responseText==1){
                    // alert('success','Status Active');
                    get_chemical();
                }
                else{
                    alert('error','Status Not Active');
                }
            }
            xhr.send('toggleStatus='+id+'&value='+val);
    
    }



window.onload = function(){
    get_chemical();
}





</script>



</body>
</html>
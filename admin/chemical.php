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
                                <th scope="col">Volume</th>
                                <th scope="col">Details</th> 
                                <th scope="col" >Quantity</th>
                                <th scope="col" >Expiration Date</th>
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
                <form id="add_chemical_form" autocomplete="off" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-title fw-bold"><i class="bi bi-plus-square"></i> Add Chemical</div>
                        </div>
                        <div class="modal-body"> 
                            <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Name of Reagent</label>
                                <input type="text" name="name" class="form-control shadow-none">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold">Volume</label>
                                <input type="number" min="1" name="area" class="form-control shadow-none">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold">Quantity</label>
                                <input type="number" name="quantity" class="form-control shadow-none">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">Available</label>
                                <input type="number" min="1"  name="avail" class="form-control shadow-none">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">Per Student</label>
                                <input type="number" min="1" name="student" class="form-control shadow-none">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold">Expiration date</label>
                                <select class='form-select shadow-none' aria-label='Default select example' name='months' required>
                                <option disabled selected value="">Select Month</option> <!-- placeholder option -->
                                    <option value="Jan">Jan</option>
                                    <option value="Feb">Feb</option>
                                    <option value="Mar">Mar</option>
                                    <option value="Apr">Apr</option>
                                    <option value="May">May</option>
                                    <option value="Jun">Jun</option>
                                    <option value="Jul">Jul</option>
                                    <option value="Aug">Aug</option>
                                    <option value="Sep">Sep</option>
                                    <option value="Oct">Oct</option>
                                    <option value="Nov">Nov</option>
                                    <option value="Dec">Dec</option>

                                </select>

                            </div>
                            <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold mb-4"></label>
                                <select class='form-select shadow-none' aria-label='Default select example' name='day' required>
                                <option disabled selected value="">Select Day</option> <!-- placeholder option -->
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>


                                </select>

                            </div>
                            <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold mb-4"></label>
                                <select class='form-select shadow-none' aria-label='Default select example' name='year' required>
                                <option disabled selected value="">Select Year</option> <!-- placeholder option -->
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                </select>

                            </div>
                            
                            <!--<div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Expiration Date</label>
                            <input type="date" class="form-control shadow-none mb-3" name="expiration_date" >
                            </div>-->
                  
                            
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Size / Volume</label>
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
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Name of Reagent</label>
                                <input type="text" name="name" class="form-control shadow-none">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold">Volume</label>
                                <input type="number" min="1" name="area" class="form-control shadow-none">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold">Quantity</label>
                                <input type="number" name="quantity" class="form-control shadow-none">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">Available</label>
                                <input type="number" min="1"  name="avail" class="form-control shadow-none">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">Per Student</label>
                                <input type="number" min="1" name="student" class="form-control shadow-none">
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold">Expiration date</label>
                                <select class='form-select shadow-none' aria-label='Default select example' name='months' required>
                                <option disabled selected value="">Select Month</option> <!-- placeholder option -->
                                    <option value="Jan">Jan</option>
                                    <option value="Feb">Feb</option>
                                    <option value="Mar">Mar</option>
                                    <option value="Apr">Apr</option>
                                    <option value="May">May</option>
                                    <option value="Jun">Jun</option>
                                    <option value="Jul">Jul</option>
                                    <option value="Aug">Aug</option>
                                    <option value="Sep">Sep</option>
                                    <option value="Oct">Oct</option>
                                    <option value="Nov">Nov</option>
                                    <option value="Dec">Dec</option>

                                </select>

                            </div>
                            <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold mb-4"></label>
                                <select class='form-select shadow-none' aria-label='Default select example' name='day' required>
                                <option disabled selected value="">Select Day</option> <!-- placeholder option -->
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>


                                </select>

                            </div>
                            <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold mb-4"></label>
                                <select class='form-select shadow-none' aria-label='Default select example' name='year' required>
                                <option disabled selected value="">Select Year</option> <!-- placeholder option -->
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                </select>

                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Size/Volume</label>
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
        data.append('months',add_chemical_form.elements['months'].value);
        data.append('day',add_chemical_form.elements['day'].value);
        data.append('year',add_chemical_form.elements['year'].value);
        // data.append('expiration_date',add_chemical_form.elements['expiration_date'].value);
        // data.append('expiration_date',add_chemical_form.elements['expiration_date'].value);
        // data.append('desc',add_chemical_form.elements['desc'].value);

        // let expiration_date = add_chemical_form.elements['month'].value;


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




let edit_chemical= document.getElementById('edit_chemical');

function chemical_details(id){
    

    
        let xhr = new XMLHttpRequest();
        xhr.open("POST","chemical_ajax.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        xhr.onload = function(){
        
            let data = JSON.parse(this.responseText);
            edit_chemical.elements['name'].value = data.chemicaldata.name;
            edit_chemical.elements['area'].value = data.chemicaldata.area;
            edit_chemical.elements['quantity'].value = data.chemicaldata.quantity;
            edit_chemical.elements['avail'].value = data.chemicaldata.avail;
            edit_chemical.elements['student'].value = data.chemicaldata.student;
            edit_chemical.elements['months'].value = data.chemicaldata.months;
            edit_chemical.elements['day'].value = data.chemicaldata.day;
            edit_chemical.elements['year'].value = data.chemicaldata.year;
            edit_chemical.elements['chemical_id'].value = data.chemicaldata.id;
            
            
            edit_chemical.elements['features'].forEach(el => {
            if(data.features.includes(Number(el.value))){
               el.checked = true;
            }
        });

        }
        xhr.send('edit_chemical='+id);
}


edit_chemical.addEventListener('submit', function(e){
    e.preventDefault();
    submit_edit_chemical();
});


function submit_edit_chemical(){
    let data= new FormData();
        data.append('submit_edit_chemical','');
        data.append('chemical_id',edit_chemical.elements['chemical_id'].value);
        data.append('name',edit_chemical.elements['name'].value);
        data.append('area',edit_chemical.elements['area'].value);
        data.append('quantity',edit_chemical.elements['quantity'].value);
        data.append('avail',edit_chemical.elements['avail'].value);
        data.append('student',edit_chemical.elements['student'].value);
        data.append('months',edit_chemical.elements['months'].value);
        data.append('day',edit_chemical.elements['day'].value);
        data.append('year',edit_chemical.elements['year'].value);
        // data.append('desc',add_chemical_form.elements['desc'].value);


        let features = [];

        edit_chemical.elements['features'].forEach(el => {
            if(el.checked){
                features.push(el.value);
            }
        });

        data.append('features',JSON.stringify(features));


        let xhr = new XMLHttpRequest();
        xhr.open("POST","chemical_ajax.php",true);

        xhr.onload = function(){
            var myModalEl = document.getElementById('edit-chemical')
            var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
            modal.hide();

            if(this.responseText==1){
                Swal.fire(
                'Good job!',
                'Chemical Edit Successfully',
                'success'
                )
                edit_chemical.reset();
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


        
    function search_chemical(apparatusname){
        let xhr = new XMLHttpRequest();
        xhr.open("POST","chemical_ajax.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        xhr.onload = function(){
            document.getElementById('chemical_data').innerHTML = this.responseText;
        }
        xhr.send('search_chemical&name='+apparatusname);
    }




window.onload = function(){
    get_chemical();
}





</script>



</body>
</html>
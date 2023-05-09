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
    <title>CSM- Size and Teacher</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="mains.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body class="bg-light">
 

  <?php require('header.php') ?>



    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-y">
                <h3 class="mb-4"><i class="bi bi-house-heart-fill"></i> Size and Policy</h3>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0 fw-bold"><i class="bi bi-bell"></i> Size and volume</h5>
                            <button type="button" class="btn btn-warning btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#facilities">
                            <i class="bi bi-file-plus"></i> Add
                            </button>
                        </div>


                           <div class="table-responsive-md" style="height:450px; overflow-y:scroll;">
                           <table class="table table-hover border">
                            <thead>
                                <tr class="bg-secondary text-white">
                                <th scope="col">#</th>
                                <th scope="col"width="65%">Name</th>
                                <th scope="col"  width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody id="facilities_data">
                          
                             
                           
                            </tbody>
                            </table>
                            </div>

                        </div>
                    </div>
                    

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0 fw-bold"><i class="bi bi-chat-square-heart"></i> Faculty Member</h5>
                            <button type="button" class="btn btn-warning btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#features">
                            <i class="bi bi-file-plus"></i> Add
                            </button>
                        </div>


                           <div class="table-responsive-md" style="height:450px; overflow-y:scroll;">
                           <table class="table table-hover border">
                            <thead>
                                <tr class="bg-secondary text-white">
                                <th scope="col">#</th>
                                <th scope="col">Faculty Name</th>
                                <th scope="col" width="40%">Department</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="features_data">
                          
                             
                           
                            </tbody>
                            </table>
                            </div>

                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0 fw-bold"><i class="bi bi-chat-square-heart"></i> Add Course</h5>
                            <button type="button" class="btn btn-warning btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#course">
                            <i class="bi bi-file-plus"></i> Add
                            </button>
                        </div>


                           <div class="table-responsive-md" style="height:450px; overflow-y:scroll;">
                           <table class="table table-hover border">
                            <thead>
                                <tr class="bg-secondary text-white">
                                <th scope="col">#</th>
                                <th scope="col">Course </th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="course_data">
                          
                             
                           
                            </tbody>
                            </table>
                            </div>

                        </div>
                    </div>


            </div>
        </div>
    </div>

        <!---- Facilities Modal-->

        <div class="modal fade" id="facilities" data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="facilities_form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-title"><i class="bi bi-bell"></i> Add Unit</div>
                        </div>
                        <div class="modal-body"> 
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" id="facilities_name" class="form-control shadow-none">
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

           <!---- Features Modal-->

           <div class="modal fade" id="features" data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="features_form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-title"><i class="bi bi-chat-square-heart"></i> Add Faculty Member</div>
                        </div>
                        <div class="modal-body"> 
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="features_name" class="form-control shadow-none">
                            </div>
                            <div class="mb-3">
                                
                <label class="form-label mb-3"> Select Department
                <select class='form-select shadow-none' aria-label='Default select example' name="features_desc" required>
                    <option disabled selected value="">Select Department...</option> <!-- placeholder option -->
                    <option value="biology">Biology</option>
                    <option value="chemistry">Chemistry</option>
                </select>
            </label>
                                

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

        
        <div class="modal fade" id="course" data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="course_form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-title"><i class="bi bi-bell"></i> Add Course</div>
                        </div>
                        <div class="modal-body"> 
                            <div class="mb-3">
                                <label class="form-label fw-bold">Course Name</label>
                                <input type="text" id="course_name" class="form-control shadow-none">
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



 <?php 
require ("script.php");
?> 
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let facilities_form = document.getElementById('facilities_form');
    let features_form = document.getElementById('features_form');
    let course_form = document.getElementById('course_form');

    facilities_form.addEventListener('submit', function(e){
        e.preventDefault();
        add_facilities();
    });

    function add_facilities(){
        let data= new FormData();
        data.append('name',facilities_form.elements['facilities_name'].value);
        data.append('add_facilities','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","facilities_ajax.php",true);

        xhr.onload = function(){
            var myModalEl = document.getElementById('facilities')
            var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
            modal.hide();

            if(this.responseText==1){
                Swal.fire(
                'Good job!',
                'New Size or Volume Added',
                'success'
                )

                facilities_form.elements['facilities_name'].values='';
                get_facilities();
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

    function get_facilities(){
        let xhr = new XMLHttpRequest();
        xhr.open("POST","facilities_ajax.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        
        xhr.onload = function (){
            document.getElementById('facilities_data').innerHTML = this.responseText;
        }

        xhr.send('get_facilities');
    } 


    function rem_facilities(val){
        let xhr = new XMLHttpRequest();
        xhr.open("POST","facilities_ajax.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
 
        xhr.onload = function (){
            if(this.responseText==1){
                Swal.fire(
                'Good job!',
                'Size and Volume Removed Successfully',
                'success'
                )
                get_facilities();
            }
            else if(this.responseText== 'room_added'){
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'A Size and Volume Removed  is added to the stock item.',
                })
                
            }
            else{
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'A Size and Volume Removed  is added to the stock item.',
                })
            }
        }

        xhr.send('rem_facilities='+val);
    }



    features_form.addEventListener('submit', function(e){
        e.preventDefault();
        add_features();
    });


    function add_features(){
        let data= new FormData();
        data.append('name',features_form.elements['features_name'].value);
        // data.append('icon',features_form.elements['features_icon'].files[0]);
        data.append('desc',features_form.elements['features_desc'].value);
        data.append('add_features','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","facilities_ajax.php",true);

        xhr.onload = function(){

         
            var myModalEl = document.getElementById('features')
            var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
            modal.hide();

            if(this.responseText== 'inv_img'){
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Only SVG images are supported',
                })
                
            }
            else if(this.responseText== 'inv_size'){
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Image shoud be less than 1MB in size',
                })
               
            }
            else if(this.responseText == 'upd_failed'){
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Image Upload failed',
                })
           
            }
            else{
                                Swal.fire(
                'Good job!',
                'New Faculty Added',
                'success'
                )
             
                features_form.reset();
                get_features();
                
            }

        }
        xhr.send(data);
    }

    function get_features(){
        let xhr = new XMLHttpRequest();
        xhr.open("POST","facilities_ajax.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        
        xhr.onload = function (){
            document.getElementById('features_data').innerHTML = this.responseText;
        }

        xhr.send('get_features');
    } 

    function rem_features(val){
        let xhr = new XMLHttpRequest();
        xhr.open("POST","facilities_ajax.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
 
        xhr.onload = function (){
            if(this.responseText==1){
                Swal.fire(
                'Good job!',
                'Faculty Removed Successfully',
                'success'
                )
                
                get_features();
            }
            else if(this.responseText== 'room_added'){
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'A Policy is added to the room.',
                })
               
            }
            else{
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'A Faculty is added to the Faculty Member.',
                })
            }
        }

        xhr.send('rem_features='+val);
    }


    course_form.addEventListener('submit', function(e){
        e.preventDefault();
        add_course();
    });

    function add_course(){
        let data= new FormData();
        data.append('name',course_form.elements['course_name'].value);
        data.append('add_course','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","facilities_ajax.php",true);

        xhr.onload = function(){
            var myModalEl = document.getElementById('course')
            var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
            modal.hide();

            if(this.responseText==1){
                Swal.fire(
                'Good job!',
                'New Course Added Success',
                'success'
                )

                course_form.elements['course_name'].values='';
                get_course();
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

    function get_course(){
        let xhr = new XMLHttpRequest();
        xhr.open("POST","facilities_ajax.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        
        xhr.onload = function (){
            document.getElementById('course_data').innerHTML = this.responseText;
        }

        xhr.send('get_course');
    } 

    function rem_course(val){
        let xhr = new XMLHttpRequest();
        xhr.open("POST","facilities_ajax.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
 
        xhr.onload = function (){
            if(this.responseText==1){
                Swal.fire(
                'Good job!',
                'Course Removed Successfully',
                'success'
                )
                get_course();
            }
            else{
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong.',
                })
            }
        }

        xhr.send('rem_course='+val);
    }



    window.onload = function(){
        get_facilities();
        get_features();
        get_course();
    }
</script>




<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
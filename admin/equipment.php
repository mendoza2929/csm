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
    <link href="./csmlogo.png" rel="icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM - Equipment</title>

    <link rel="stylesheet" href="dashmain.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

<body>

    <?php require('header.php') ?>


    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-y">
                <h3 class="mb-4"><i class="bi bi-clipboard2-pulse"></i> Equipment</h3>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body my-4">

                        <div class="text-end my-4">

                            <button type="button" class="btn btn-warning btn-sm shadow-none mb-2" data-bs-toggle="modal"
                                data-bs-target="#add-equipment">
                                <i class="bi bi-file-plus"></i> Add
                            </button>
                            <input type="text" oninput="search_equipment(this.value)"
                                class="form-control shadow-none w-25 ms-auto" placeholder="Type to search..">
                        </div>


                        <div class="table-responsive-lg" style="height:450px; overflow-y:scroll;">
                            <table class="table table-hover border text-center">
                                <thead>
                                    <tr class="bg-secondary text-white">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Details</th>
                                        <th scope="col">Date Added</th>
                                        <th scope="col">Cost</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="equipment_data">



                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>






            </div>
        </div>
    </div>


    <!----equipment Modal-->

    <div class="modal fade" id="add-equipment" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="add_equipment_form" autocomplete="off" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title fw-bold"><i class="bi bi-plus-square"></i> Add Equipment</div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Equipment Name</label>
                                <input type="text" name="name" class="form-control shadow-none">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold">Brand</label>
                                <input type="text" min="1" name="brand" class="form-control shadow-none">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold">Cost</label>
                                <input type="text" min="1" name="cost" class="form-control shadow-none">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">Quantity</label>
                                <input type="number" name="quantity" class="form-control shadow-none">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">Available</label>
                                <input type="number" min="1" name="avail" class="form-control shadow-none">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">Per Student</label>
                                <input type="number" min="1" name="student" class="form-control shadow-none">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">Date</label>
                                <select class='form-select shadow-none' aria-label='Default select example'
                                    name='month_added' required>
                                    <option disabled selected value="">Month</option> <!-- placeholder option -->
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
                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold mb-4"></label>
                                <select class='form-select shadow-none' aria-label='Default select example'
                                    name='day_added' required>
                                    <option disabled selected value="">Day</option> <!-- placeholder option -->
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
                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold mb-4"></label>
                                <select class='form-select shadow-none' aria-label='Default select example'
                                    name='year_added' required>
                                    <option disabled selected value="">Year</option> <!-- placeholder option -->
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
                                <label class="form-label fw-bold">Unit</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('features');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                            <div class='col-md-3 mb-1'>
                            <label>
                            <input type='radio' name='features' value='$opt[id]' class='form-check-input shadow-none'>
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
                        <button type="reset" class="btn btn-secondary shadow-none"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success shadow-none">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!----edit Modal-->

    <div class="modal fade" id="edit-equipment" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="edit_equipment" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title fw-bold"><i class='i bi-pencil-square'></i> Edit Equipment</div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Equipment Name</label>
                                <input type="text" name="name" class="form-control shadow-none">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold">Brand</label>
                                <input type="text" min="1" name="brand" class="form-control shadow-none">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold">Cost</label>
                                <input type="text" min="1" name="cost" class="form-control shadow-none">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">Quantity</label>
                                <input type="number" name="quantity" class="form-control shadow-none">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">Available</label>
                                <input type="number" min="1" name="avail" class="form-control shadow-none">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">Per Student</label>
                                <input type="number" min="1" name="student" class="form-control shadow-none">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">Date</label>
                                <select class='form-select shadow-none' aria-label='Default select example'
                                    name='month_added' required>
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
                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold mb-4"></label>
                                <select class='form-select shadow-none' aria-label='Default select example'
                                    name='day_added' required>
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
                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold mb-4"></label>
                                <select class='form-select shadow-none' aria-label='Default select example'
                                    name='year_added' required>
                                    <option disabled selected value="">Select Year</option> <!-- placeholder option -->
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                </select>

                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Unit</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('features');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                            <div class='col-md-3 mb-1'>
                            <label>
                            <input type='radio' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                            $opt[name]
                            </label>
                            </div>
                            ";
                                    }
                                    ?>
                                </div>
                            </div>

                            <input type="hidden" name="equipment_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary shadow-none"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success shadow-none">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>




    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>


    <?php
    require("script.php");
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        let add_equipment_form = document.getElementById('add_equipment_form');



        add_equipment_form.addEventListener('submit', function (e) {
            e.preventDefault();
            add_equipment();
        });

        function add_equipment() {
            let data = new FormData();
            data.append('add_equipment', '');
            data.append('name', add_equipment_form.elements['name'].value);
            data.append('brand', add_equipment_form.elements['brand'].value);
            data.append('quantity', add_equipment_form.elements['quantity'].value);
            data.append('avail', add_equipment_form.elements['avail'].value);
            data.append('student', add_equipment_form.elements['student'].value);
            data.append('cost', add_equipment_form.elements['cost'].value);
            data.append('month_added', add_equipment_form.elements['month_added'].value);
            data.append('day_added', add_equipment_form.elements['day_added'].value);
            data.append('year_added', add_equipment_form.elements['year_added'].value);
            // data.append('expiration_date',add_equipment_form.elements['expiration_date'].value);
            // data.append('expiration_date',add_equipment_form.elements['expiration_date'].value);
            // data.append('desc',add_equipment_form.elements['desc'].value);

            // let expiration_date = add_equipment_form.elements['month'].value;


            let features = [];

            add_equipment_form.elements['features'].forEach(el => {
                if (el.checked) {
                    features.push(el.value);
                }
            });

            data.append('features', JSON.stringify(features));


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "equipment_ajax.php", true);

            xhr.onload = function () {
                var myModalEl = document.getElementById('add-equipment')
                var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
                modal.hide();

                if (this.responseText == 1) {
                    Swal.fire(
                        'Success!',
                        'Equipment has been added',
                        'success'
                    )
                    add_equipment_form.reset();

                    get_equipment();

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                }

            }
            xhr.send(data);
        }


        function get_equipment() {

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "equipment_ajax.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                document.getElementById('equipment_data').innerHTML = this.responseText;
            }
            xhr.send('get_equipment');

        }




        let edit_equipment = document.getElementById('edit_equipment');

        function equipment_details(id) {



            let xhr = new XMLHttpRequest();
            xhr.open("POST", "equipment_ajax.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {

                let data = JSON.parse(this.responseText);
                edit_equipment.elements['name'].value = data.equipmentdata.name;
                edit_equipment.elements['brand'].value = data.equipmentdata.brand;
                edit_equipment.elements['quantity'].value = data.equipmentdata.quantity;
                edit_equipment.elements['avail'].value = data.equipmentdata.avail;
                edit_equipment.elements['student'].value = data.equipmentdata.student;
                edit_equipment.elements['cost'].value = data.equipmentdata.cost;
                edit_equipment.elements['month_added'].value = data.equipmentdata.month_added;
                edit_equipment.elements['day_added'].value = data.equipmentdata.day_added;
                edit_equipment.elements['year_added'].value = data.equipmentdata.year_added;
                edit_equipment.elements['equipment_id'].value = data.equipmentdata.id;


                edit_equipment.elements['features'].forEach(el => {
                    if (data.features.includes(Number(el.value))) {
                        el.checked = true;
                    }
                });

            }
            xhr.send('edit_equipment=' + id);
        }


        edit_equipment.addEventListener('submit', function (e) {
            e.preventDefault();
            submit_edit_equipment();
        });


        function submit_edit_equipment() {
            let data = new FormData();
            data.append('submit_edit_equipment', '');
            data.append('equipment_id', edit_equipment.elements['equipment_id'].value);
            data.append('name', edit_equipment.elements['name'].value);
            data.append('brand', edit_equipment.elements['brand'].value);
            data.append('cost', edit_equipment.elements['cost'].value);
            data.append('quantity', edit_equipment.elements['quantity'].value);
            data.append('avail', edit_equipment.elements['avail'].value);
            data.append('student', edit_equipment.elements['student'].value);
            data.append('month_added', edit_equipment.elements['month_added'].value);
            data.append('day_added', edit_equipment.elements['day_added'].value);
            data.append('year_added', edit_equipment.elements['year_added'].value);
            // data.append('desc',add_equipment_form.elements['desc'].value);


            let features = [];

            edit_equipment.elements['features'].forEach(el => {
                if (el.checked) {
                    features.push(el.value);
                }
            });

            data.append('features', JSON.stringify(features));


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "equipment_ajax.php", true);

            xhr.onload = function () {
                var myModalEl = document.getElementById('edit-equipment')
                var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
                modal.hide();

                if (this.responseText == 1) {
                    Swal.fire(
                        'Success!',
                        'Equipment has been updated',
                        'success'
                    )
                    edit_equipment.reset();
                    get_equipment();

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                }

            }
            xhr.send(data);
        }









        function toggleStatus(id, val) {

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "equipment_ajax.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (this.responseText == 1) {
                    // alert('success','Status Active');
                    get_equipment();
                }
                else {
                    alert('error', 'Status Not Active');
                }
            }
            xhr.send('toggleStatus=' + id + '&value=' + val);

        }



        function search_equipment(apparatusname) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "equipment_ajax.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                document.getElementById('equipment_data').innerHTML = this.responseText;
            }
            xhr.send('search_equipment&name=' + apparatusname);
        }




        window.onload = function () {
            get_equipment();
        }





    </script>



</body>

</html>
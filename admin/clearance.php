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
    <title>CSM - Clearance</title>

    <link rel="stylesheet" href="dashmain.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>
<body>

<?php require('header.php') ?>


<div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-y">
                <h3 class="mb-4"><i class="bi bi-clipboard2-check"></i> University Science Center Clearance</h3>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                     
                        <div class="text-end mb-4">
                            
                            <button type="button" class="btn btn-warning btn-sm shadow-none mb-2" data-bs-toggle="modal" data-bs-target="#add-clearance">
                            <i class="bi bi-file-plus"></i> Add
                            </button>
                            <!--<input type="text" oninput="search_chemical(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search..">-->
                        </div>


                           <div class="table-responsive-lg" style="height:450px; overflow-y:scroll;">
                           <table class="table table-hover border text-center">
                            <thead>
                                <tr class="bg-secondary text-white">
                                <th scope="col">Date</th>
                                <th scope="col">CAIS</th>
                                <th scope="col">CArch</th> 
                                <th scope="col">CCIE</th>
                                <th scope="col" >CoE</th>
                                <th scope="col">CCS</th> 
                                <th scope="col">CFES</th> 
                                <th scope="col">CHE</th> 
                                <th scope="col">CLA</th> 
                                <th scope="col">CLaw</th> 
                                <th scope="col">CPERS</th> 
                                <th scope="col">CSM</th> 
                                <th scope="col">CSWCD</th> 
                                <th scope="col">CTE</th> 
                                <th scope="col">ESU</th> 
                                <th scope="col">Graduate</th> 
                                <th scope="col">Action</th> 

                                </tr>
                            </thead>
                            <tbody id="clearance_data">
                          
                             
                           
                            </tbody>
                            </table>
                            </div>

                        </div>
                    </div>
                    

                    
                    


            </div>
        </div>
    </div>


      <!----chemical Modal-->

      <div class="modal fade" id="add-clearance" data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form id="add_clearance_form" autocomplete="off" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-title fw-bold"><i class="bi bi-plus-square"></i> Add Clearance</div>
                        </div>
                        <div class="modal-body"> 

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Date</label>
                                <input type="date" name="date" class="form-control shadow-none">
                            </div>

                            <div class="row">
                            
                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CAIS</label>
                                <input type="number" min="1" name="cais" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CArch</label>
                                <input type="number" min="1" name="carch" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CCIE</label>
                                <input type="number" min="1" name="ccie" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CoE</label>
                                <input type="number" min="1" name="coe" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CCS</label>
                                <input type="number" min="1" name="ccs" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CFES</label>
                                <input type="number" min="1" name="cfes" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CHE</label>
                                <input type="number" min="1" name="che" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CLA</label>
                                <input type="number" min="1" name="cla" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CLaw</label>
                                <input type="number" min="1" name="claw" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CPers</label>
                                <input type="number" min="1" name="cpers" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CSM</label>
                                <input type="number" min="1" name="csm" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CSWCD</label>
                                <input type="number" min="1" name="cswcd" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CTE</label>
                                <input type="number" min="1" name="cte" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">ESU</label>
                                <input type="number" min="1" name="esu" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">Graduate</label>
                                <input type="number" min="1" name="graduate" class="form-control shadow-none">
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


        <!----edit chemical Modal-->

      <div class="modal fade" id="edit-clearance" data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form id="edit_clearance" autocomplete="off" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-title fw-bold"><i class="bi bi-plus-square"></i> Add Clearance</div>
                        </div>
                        <div class="modal-body"> 

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Date</label>
                                <input type="date" name="date" class="form-control shadow-none">
                            </div>

                            <div class="row">
                            
                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CAIS</label>
                                <input type="number" min="1" name="cais" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CArch</label>
                                <input type="number" min="1" name="carch" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CCIE</label>
                                <input type="number" min="1" name="ccie" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CoE</label>
                                <input type="number" min="1" name="coe" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CCS</label>
                                <input type="number" min="1" name="ccs" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CFES</label>
                                <input type="number" min="1" name="cfes" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CHE</label>
                                <input type="number" min="1" name="che" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CLA</label>
                                <input type="number" min="1" name="cla" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CLaw</label>
                                <input type="number" min="1" name="claw" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CPers</label>
                                <input type="number" min="1" name="cpers" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CSM</label>
                                <input type="number" min="1" name="csm" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CSWCD</label>
                                <input type="number" min="1" name="cswcd" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">CTE</label>
                                <input type="number" min="1" name="cte" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">ESU</label>
                                <input type="number" min="1" name="esu" class="form-control shadow-none">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label fw-bold">Graduate</label>
                                <input type="number" min="1" name="graduate" class="form-control shadow-none">
                            </div>
                     
                     
                     


                               
                            <input type="hidden" name="clearance_id">
                          
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

let add_clearance_form = document.getElementById('add_clearance_form');



add_clearance_form.addEventListener('submit', function(e){
    e.preventDefault();
    add_clerance();
});

function add_clerance(){
        let data= new FormData();
        data.append('add_clearance','');
        data.append('date',add_clearance_form.elements['date'].value);
        data.append('cais',add_clearance_form.elements['cais'].value);
        data.append('carch',add_clearance_form.elements['carch'].value);
        data.append('ccie',add_clearance_form.elements['ccie'].value);
        data.append('coe',add_clearance_form.elements['coe'].value);
        data.append('ccs',add_clearance_form.elements['ccs'].value);
        data.append('cfes',add_clearance_form.elements['cfes'].value);
        data.append('che',add_clearance_form.elements['che'].value);
        data.append('cla',add_clearance_form.elements['cla'].value);
        data.append('claw',add_clearance_form.elements['claw'].value);
        data.append('cpers',add_clearance_form.elements['cpers'].value);
        data.append('csm',add_clearance_form.elements['csm'].value);
        data.append('cswcd',add_clearance_form.elements['cswcd'].value);
        data.append('cte',add_clearance_form.elements['cte'].value);
        data.append('esu',add_clearance_form.elements['esu'].value);
        data.append('graduate',add_clearance_form.elements['graduate'].value);



        let xhr = new XMLHttpRequest();
        xhr.open("POST","clearance_ajax.php",true);

        xhr.onload = function(){
            var myModalEl = document.getElementById('add-clearance')
            var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
            modal.hide();

            if(this.responseText==1){
                Swal.fire(
                'Good job!',
                'Clearance Added',
                'success'
                )
                add_clearance_form.reset();
                get_clearance();
                
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


function get_clearance(){
        
    let xhr = new XMLHttpRequest();
        xhr.open("POST","clearance_ajax.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        xhr.onload = function(){
         document.getElementById('clearance_data').innerHTML = this.responseText;
        }
        xhr.send('get_clearance');

}




let edit_clearance= document.getElementById('edit_clearance');

function clearance_details(id){
    

    
        let xhr = new XMLHttpRequest();
        xhr.open("POST","clearance_ajax.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        xhr.onload = function(){
        
            let data = JSON.parse(this.responseText);
            edit_clearance.elements['date'].value = data.clearancedata.date;
            edit_clearance.elements['cais'].value = data.clearancedata.cais;
            edit_clearance.elements['carch'].value = data.clearancedata.carch;
            edit_clearance.elements['ccie'].value = data.clearancedata.ccie;
            edit_clearance.elements['coe'].value = data.clearancedata.coe;
            edit_clearance.elements['ccs'].value = data.clearancedata.ccs;
            edit_clearance.elements['cfes'].value = data.clearancedata.cfes;
            edit_clearance.elements['che'].value = data.clearancedata.che;
            edit_clearance.elements['cla'].value = data.clearancedata.cla;
            edit_clearance.elements['claw'].value = data.clearancedata.claw;
            edit_clearance.elements['cpers'].value = data.clearancedata.cpers;
            edit_clearance.elements['csm'].value = data.clearancedata.csm;
            edit_clearance.elements['cswcd'].value = data.clearancedata.cswcd;
            edit_clearance.elements['cte'].value = data.clearancedata.cte;
            edit_clearance.elements['esu'].value = data.clearancedata.esu;
            edit_clearance.elements['graduate'].value = data.clearancedata.graduate;
            edit_clearance.elements['clearance_id'].value = data.clearancedata.id;
            
            
        

        }
        xhr.send('edit_clearance='+id);
}


edit_clearance.addEventListener('submit', function(e){
    e.preventDefault();
    submit_edit_clearance();
});


function  submit_edit_clearance(){
    let data= new FormData();
        data.append('submit_edit_clearance','');
        data.append('clearance_id',edit_clearance.elements['clearance_id'].value);
        data.append('date',edit_clearance.elements['date'].value);
        data.append('cais',edit_clearance.elements['cais'].value);
        data.append('carch',edit_clearance.elements['carch'].value);
        data.append('ccie',edit_clearance.elements['ccie'].value);
        data.append('coe',edit_clearance.elements['coe'].value);
        data.append('ccs',edit_clearance.elements['ccs'].value);
        data.append('cfes',edit_clearance.elements['cfes'].value);
        data.append('che',edit_clearance.elements['che'].value);
        data.append('cla',edit_clearance.elements['cla'].value);
        data.append('claw',edit_clearance.elements['claw'].value);
        data.append('cpers',edit_clearance.elements['cpers'].value);
        data.append('csm',edit_clearance.elements['csm'].value);
        data.append('cswcd',edit_clearance.elements['cswcd'].value);
        data.append('cte',edit_clearance.elements['cte'].value);
        data.append('esu',edit_clearance.elements['esu'].value);
        data.append('graduate',edit_clearance.elements['graduate'].value);





        let xhr = new XMLHttpRequest();
        xhr.open("POST","clearance_ajax.php",true);

        xhr.onload = function(){
            var myModalEl = document.getElementById('edit-clearance')
            var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
            modal.hide();

            if(this.responseText==1){
                Swal.fire(
                'Good job!',
                'Clearance Edit Successfully',
                'success'
                )
                edit_clearance.reset();
                get_clearance();
                
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









// function toggleStatus(id,val){
        
//         let xhr = new XMLHttpRequest();
//             xhr.open("POST","chemical_ajax.php",true);
//             xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        
//             xhr.onload = function(){
//                 if(this.responseText==1){
//                     // alert('success','Status Active');
//                     get_chemical();
//                 }
//                 else{
//                     alert('error','Status Not Active');
//                 }
//             }
//             xhr.send('toggleStatus='+id+'&value='+val);
    
//     }


        
//     function search_chemical(apparatusname){
//         let xhr = new XMLHttpRequest();
//         xhr.open("POST","chemical_ajax.php",true);
//         xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

//         xhr.onload = function(){
//             document.getElementById('chemical_data').innerHTML = this.responseText;
//         }
//         xhr.send('search_chemical&name='+apparatusname);
//     }




window.onload = function(){
    get_clearance();
}





</script>



</body>
</html>
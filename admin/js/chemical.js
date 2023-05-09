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


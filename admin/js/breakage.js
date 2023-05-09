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






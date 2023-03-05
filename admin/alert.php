<?php 


    // frontend data
    define('SITE_URL','http://127.0.0.1/csm/');
    define('FEATURES_IMG_PATH',SITE_URL.'img/features/');
    define('ROOM_IMG_PATH',SITE_URL.'img/room/');


     // backend data
    define('UPLOAD_IMAGE_PATH',$_SERVER['DOCUMENT_ROOT'].'/csm/img/');
    define('FEATURES_FOLDER','features/');
    define('ROOM_FOLDER','room/');
    define('USERS_FOLDER','users/');

    // sendgrid api key 
    define('SENDGRID_API_KEY',"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");
    define('SENDGRID_EMAIL',"bg201803853@wmsu.edu.ph");
    define('SENDGRID_NAME',"Mendoza");


    




    function adminLogin(){
        session_start();
        if(!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true)){
            echo "
            <script>window.location.href='index.php';</script>
             ";
             exit;
        }
        
    }


    function redirect($url){
        echo "
            <script>window.location.href='$url';</script>
        ";
        exit;
    }



    

function alert($type, $message){
    $bs_class = ($type == 'success') ? "alert-success" : "alert-danger";
    echo <<<alert


        <div class="alert $bs_class alert-dismissible fade show text-center custom-alert" role="alert">
        <strong class="m-3">$message</strong>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>


        alert;
        
}




function uploadSVGImage($image,$folder){
    $valid_mime =['image/svg+xml'];
    $img_mime=$image['type'];
    
    if(!in_array($img_mime,$valid_mime)){
        return 'inv_img'; //invalid image mime or format not supported
    }
    else if(($image['size']/(1024*1024))>1){
        return 'inv_size'; //invalid size greater than 1mb
    }
    else{
        $ext= pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname='IMG_'.random_int(11111,99999).".$ext";

        $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
        if(move_uploaded_file($image['tmp_name'],$img_path)){
            return $rname;
        }
        else{
            return 'upd_failed'; //
        }
    }

}

function uploadImage($image,$folder){
    $valid_mime = ['image/jpeg', 'image/png', 'image/webp'];
    $img_mime = $image['type'];

    if(!in_array($img_mime,$valid_mime)){
        return 'inv_img'; //invalid image mime or format not supported
    }
    else if(($image['size']/(1024*1024))>1){
        return 'inv_size'; //invalid size greater than 1mb
    }
    else{
        $ext= pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname='IMG_'.random_int(11111,99999).".$ext";

        $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
        if(move_uploaded_file($image['tmp_name'],$img_path)){
            return $rname;
        }
        else{
            return 'upd_failed'; //
        }
    }
}


function deleteImage($image, $folder){
    if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
        return true;
    }else{
        return false;
    }
}


// function uploadUserImage($image){
//     $valid_mime = ['image/jpeg', 'image/png', 'image/webp'];
//     $img_mime = $image['type'];

//     if(!in_array($img_mime,$valid_mime)){
//         return 'inv_img'; //invalid image mime or format not supported
//     }

//     else{
//         $ext= pathinfo($image['name'], PATHINFO_EXTENSION);
//         $rname='IMG_'.random_int(11111,99999).".jpeg";

//         $img_path = UPLOAD_IMAGE_PATH.USERS_FOLDER.$rname;

//         if($ext == 'png' || $ext == 'PNG'){
//             $img = imagecreatefrompng($image['tmp_name']);
//         }else if($ext == 'webp' || $ext == 'WEBP'){
//             $img = imagecreatefromwebp($image['tmp_name']);
//         }else{
//             $img = imagecreatefromjpeg($image['tmp_name']);
//         }


//         if(imagejpeg($img,$img_path,75)){
//             return $rname;
//         }
//         else{
//             return 'upd_failed'; //
//         }
//     }
// }


?>
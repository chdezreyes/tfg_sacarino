<?php

class ControllerAlerts{

    static public function ctrAlert($type, $message, $url, $html = null){
        echo'<script>
                Swal.fire({
                    type: "'.$type.'",
                    icon: "success",
                    html: "'.$html.'",
                    title: "'.$message.'",';

        if($type == "success"){
                echo 'confirmButtonColor: "#ff6b24",
                      icon: "success",';
        }else{
                echo 'confirmButtonColor: "#6C757D",
                      icon: "error",';
        };

        echo         '
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar",
                      closeOnConfirm: false
                      }).then((result)=>{
                        if(result.value){
                           window.location = "'.$url.'";
                        }
                    });
                </script>';
    }
}
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
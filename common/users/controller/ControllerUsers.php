<?php

/**
 * Controlador para el manejo de usuarios
 */
class ControllerUsers{

    // LOGIN DE USUARIO
    static public function ctrUserLogin(){

        if(isset($_POST["userEmail"])){

            // Validacion de formato de usuario yb contraseña
            if(filter_var($_POST["userEmail"],FILTER_VALIDATE_EMAIL)
                // &&
                //   preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/' , $_POST["userPassword"])
                  ){

                $table = "main_users";
                // $criptedPass = crypt($_POST["userPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                $criptedPass = $_POST["userPassword"];
                $item  = "user_email";
                $value = $_POST["userEmail"];
                $answer = ModelUsers::mdlGetUser($table, $item, $value);

                if($answer == false){
                    echo '<br><div class="alert alert-danger">Usuario no encontrado</div>';
                }else{
                    // Validación de email y contraseña si coinciden con la base de datos
                    if($answer["user_email"] == $_POST["userEmail"] && $answer["user_password"] == $criptedPass){
                        // Validación si el usuario está activado
                        if($answer["user_status"] == 1){
                            $_SESSION["userSession"] = "ok";
                            $_SESSION["userId"] = $answer["user_id"];
                            $_SESSION["userName"] = $answer["user_name"];
                            $_SESSION["userRole"] = $answer["user_role"];
                            echo '<script> window.location = "index" </script>';
                        }else{
                            echo '<br><div class="alert alert-danger">Usuario no activo. Contacte con el administrador</div>';
                        }
                    }else{
                        echo '<br><div class="alert alert-danger">La contraseña no es correcta</div>';
                    }
                }
            }else{
                echo '<br><div class="alert alert-danger">La contraseña no cumple los requisitos de seguridad</div>';
            }
        }
    }

    // REGISTRO DE USUARIO - Crear un usuario nuevo
     static public function ctrUserCreate(){

        if(isset($_POST["userName"])){

        }
     }

     static public function ctrGetUsers($item = null, $value = null){
        $table = 'main_users';
        $answer = ModelUsers::mdlGetUser($table, $item, $value);
        return $answer;
     }
}



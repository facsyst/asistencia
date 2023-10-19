<?php 
require_once("../modelo/Usuario.php");

controlador($_POST['proceso']);

function controlador($proceso){
    $objUsu = new Usuario();
    switch ($proceso){

        case "NUEVO":
            try{
                $duplicado = $objUsu->consultarUsuarioNombre($_POST['usuario']);
                if($duplicado->rowCount()==0){
                    $resultado = $objUsu->insertar($_POST['nombre'],$_POST['usuario'],$_POST['clave'], $_POST['idperfil'], $_POST['estado']);                        
                    echo 1;
                }else{
                    echo 2;
                }
            }catch(Exception $ex){
                echo 0;
            }
            break;

        case "ACTUALIZAR":            
            try{
                $duplicado = $objUsu->consultarUsuarioNombre($_POST['usuario'], $_POST['idusuario']);
                if($duplicado->rowCount()==0){
                    $resultado = $objUsu->actualizar($_POST['idusuario'],$_POST['nombre'],$_POST['usuario'], $_POST['clave'],$_POST['idperfil'], $_POST['estado']);
                    echo 1;
                }else{
                    echo 2;
                }
            }catch(Exception $ex){
                echo 0;
            }
            break;    
            
        case "ELIMINAR":
            try{
                $resultado = $objUsu->actualizarEstado($_POST['idusuario'],2);
                echo 1;
            }catch(Exception $ex){
                echo 0;
            }
            break;
        case "ANULAR":
            try{
                $resultado = $objUsu->actualizarEstado($_POST['idusuario'],0);
                echo 1;
            }catch(Exception $ex){
                echo 0;
            }
            break;
        case "ACTIVAR":
            try{
                $resultado = $objUsu->actualizarEstado($_POST['idusuario'],1);
                echo 1;
            }catch(Exception $ex){
                echo 0;
            }
            break;  
        case "CONSULTAR":
            $retorno = array();
            try{
                $resultado = $objUsu->consultarUsuario($_POST['idusuario']);
                if($resultado->rowCount()>0){
                    $retorno = $resultado->fetch(PDO::FETCH_NAMED);
                }
            }catch(Exception $ex){
                $retorno = array();
            }
            echo json_encode($retorno);
            break;            

        case "LOGIN":
            $resultado = array( 
                                "url"=>"",
                                "correcto"=>0, 
                                "mensaje"=>""
                            );
            try{
                $user = $_POST['user'];
                $clave = $_POST['clave'];
                $usuario = $objUsu->verificarUsuario($user, $clave);
                
                if($usuario->rowCount()>0){
                    $resultado["url"]="principal.php";
                    $resultado["correcto"]=1;
                    $resultado["mensaje"]="Usuario correcto";  
                     
                    $usuario = $usuario->fetch(PDO::FETCH_NAMED);
                    $_SESSION['idusuario'] = $usuario['idusuario'];
                    $_SESSION['nombre']    = $usuario['nombre'];
                    $_SESSION['usuario']   = $usuario['usuario'];
                    $_SESSION['idperfil']  = $usuario['idperfil'];
                    $_SESSION['perfil']    = $usuario['perfil'];
                }else{
                    $resultado["mensaje"]="Usuario o clave incorrecta.";   
                }

            }catch(Exception $ex){
                $resultado["url"]="";
                $resultado["correcto"]=0;
                $resultado["mensaje"]="ERROR: ".$ex->getMessage();
            }
            echo json_encode($resultado);
            break;
        default:
            echo "No se ha definido el proceso solicitado";
            break;
    }
}
?>
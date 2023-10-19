<?php 
require_once("../modelo/Perfil.php");

controlador($_POST['proceso']);

function controlador($proceso){
    $objPer = new Perfil();
    switch ($proceso){
        case "NUEVO":
            $retorno = array();
            try{
                $duplicado = $objPer->verificarDuplicado(trim($_POST['nombre']));
                if($duplicado->rowCount()==0){
                    $objPer->insertar(trim($_POST['nombre']),$_POST['estado']);                 
                    $retorno['correcto']=true;
                    $retorno['mensaje']="Registro satisfactorio";
                }else{
                    throw new Exception("Nombre de Perfil ya existe.",1);
                }                
            }catch(Exception $ex){
                $retorno['correcto']=false;
                $retorno['mensaje']=$ex->getMessage();
            }
            echo json_encode($retorno);
            break;

        case "ACTUALIZAR":
            $retorno = array();
            try{
                $duplicado = $objPer->verificarDuplicado(trim($_POST['nombre']),$_POST['idperfil']);
                if($duplicado->rowCount()==0){
                    $objPer->actualizar($_POST['idperfil'],trim($_POST['nombre']),$_POST['estado']);                 
                    $retorno['correcto']=true;
                    $retorno['mensaje']="Actualización satisfactoria";
                }else{
                    throw new Exception("Nombre de Perfil ya existe.",1);
                }                
            }catch(Exception $ex){
                $retorno['correcto']=false;
                $retorno['mensaje']=$ex->getMessage();
            }
            echo json_encode($retorno);
            break;

            case "CAMBIAR_ESTADO":
                $retorno = array();
                try{
                    $objPer->cambiarEstado($_POST['idperfil'],$_POST['estado']);                 
                    $retorno['correcto']=true;
                    $retorno['mensaje']="Cambio de estado satisfactorio";                
                }catch(Exception $ex){
                    $retorno['correcto']=false;
                    $retorno['mensaje']=$ex->getMessage();
                }
                echo json_encode($retorno);
                break;

        case 'CONSULTAR':
            $retorno = array();
            try{
                $registro = $objPer->consultar($_POST['idperfil']);
                $retorno = $registro->fetch(PDO::FETCH_NAMED); 
            }catch(Exception $ex){
                //nada
            }
            echo json_encode($retorno);
            break;
        case 'CONSULTAR_PERMISOS':
            $retorno = array();
            try{
                $registro = $objPer->obtenerPermisosPorPeril($_POST['idperfil']);
                $retorno = $registro->fetchAll(PDO::FETCH_NAMED); 
            }catch(Exception $ex){
                //nada
            }
            echo json_encode($retorno);
            break;  
        case 'ASIGNAR_ACCESO':
            $retorno = array();
            try{

                $idperfil = $_POST['idperfil'];
                $idopcion = $_POST['idopcion'];
                $estado = $_POST['estado'];

                $acceso = $objPer->consultarAcceso($idperfil, $idopcion);                

                if($acceso->rowCount()>0){
                    $objPer->actualizarAcceso($idperfil, $idopcion, $estado);
                }else{
                    $objPer->insertarAcceso($idperfil, $idopcion, $estado);
                }
            
                $retorno['correcto']=true;
                $retorno['mensaje']="Acceso actualizado";
            }catch(Exception $ex){
                $retorno['correcto']=false;
                $retorno['mensaje']=$ex->getMessage();
            }
            echo json_encode($retorno);
            break;                        
        default:
            echo "No se ha definido el proceso solicitado";
            break;
    }
}
?>
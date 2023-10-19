<?php 
require_once("../modelo/Categoria.php");

controlador($_POST['proceso']);

function controlador($proceso){
    $objCat = new Categoria();
    switch ($proceso){
        case "NUEVO":
            $retorno = array();
            try{
                $duplicado = $objCat->verificarDuplicado(trim($_POST['nombre']));
                if($duplicado->rowCount()==0){
                    $objCat->insertar(trim($_POST['nombre']),$_POST['estado']);                 
                    $retorno['correcto']=true;
                    $retorno['mensaje']="Registro satisfactorio";
                }else{
                    throw new Exception("Nombre de Categoría ya existe.",1);
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
                $duplicado = $objCat->verificarDuplicado(trim($_POST['nombre']),$_POST['idcategoria']);
                if($duplicado->rowCount()==0){
                    $objCat->actualizar($_POST['idcategoria'],trim($_POST['nombre']),$_POST['estado']);                 
                    $retorno['correcto']=true;
                    $retorno['mensaje']="Actualización satisfactoria";
                }else{
                    throw new Exception("Nombre de Categoría ya existe.",1);
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
                    $objCat->cambiarEstado($_POST['idcategoria'],$_POST['estado']);                 
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
                $registro = $objCat->consultar($_POST['idcategoria']);
                $retorno = $registro->fetch(PDO::FETCH_NAMED); 
            }catch(Exception $ex){
                //nada
            }
            echo json_encode($retorno);
            break;
        default:
            echo "No se ha definido el proceso solicitado";
            break;
    }
}
?>
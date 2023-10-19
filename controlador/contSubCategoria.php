<?php 
require_once("../modelo/Subcategoria.php");

controlador($_POST['proceso']);

function controlador($proceso){
    $objSub = new Subcategoria();
    switch ($proceso){
        case "NUEVO":
            $retorno = array();
            try{
                $duplicado = $objSub->verificarDuplicado(trim($_POST['nombre']));
                if($duplicado->rowCount()==0){
                    $objSub->insertar($_POST['idcategoria'],trim($_POST['nombre']),$_POST['estado']);                 
                    $retorno['correcto']=true;
                    $retorno['mensaje']="Registro satisfactorio";
                }else{
                    throw new Exception("Nombre de SubCategoría ya existe.",1);
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
                $duplicado = $objSub->verificarDuplicado(trim($_POST['nombre']),$_POST['idsubcategoria']);
                if($duplicado->rowCount()==0){
                    $objSub->actualizar($_POST['idsubcategoria'], $_POST['idcategoria'],trim($_POST['nombre']),$_POST['estado']);                 
                    $retorno['correcto']=true;
                    $retorno['mensaje']="Actualización satisfactoria";
                }else{
                    throw new Exception("Nombre de SubCategoría ya existe.",1);
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
                    $objSub->cambiarEstado($_POST['idsubcategoria'],$_POST['estado']);                 
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
                $registro = $objSub->consultar($_POST['idsubcategoria']);
                $retorno = $registro->fetch(PDO::FETCH_NAMED); 
            }catch(Exception $ex){
                //nada
            }
            echo json_encode($retorno);
            break;
        case 'CONSULTAR_POR_CATEGORIA':
            $retorno = array();
            try{
                $registro = $objSub->consultarPorCategoria($_POST['idcategoria']);
                $retorno = $registro->fetchAll(PDO::FETCH_NAMED); 
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
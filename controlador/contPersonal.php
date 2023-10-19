<?php 
require_once("../modelo/Personal.php");

controlador($_POST['proceso']);

function controlador($proceso){
    $objPer = new Personal();
    switch ($proceso){
        case "NUEVO":
            $retorno = array();
            try{
                $duplicado = $objPer->verificarDuplicado(trim($_POST['nrodocumento']));
                if($duplicado->rowCount()==0){
                    $objPer->insertar(trim($_POST['nombre']), 
                                            $_POST['apellido'], 
                                            $_POST['idtipodocumento'], 
                                            $_POST['nrodocumento'], 
                                            $_POST['tipopersonal'],
                                            $_POST['celular'],
                                            $_POST['email'],
                                            $_POST['estado']);                 
                    $retorno['correcto']=true;
                    $retorno['mensaje']="Registro satisfactorio";
                }else{
                    throw new Exception("Documento de Usuario ya existe.",1);
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
                $duplicado = $objPer->verificarDuplicado(trim($_POST['nrodocumento']),$_POST['idcliente']);
                if($duplicado->rowCount()==0){
                    $objPer->actualizar($_POST['idcliente'],trim($_POST['nombre']),$_POST['idtipodocumento'], $_POST['nrodocumento'], $_POST['direccion'], $_POST['estado']);                 
                    $retorno['correcto']=true;
                    $retorno['mensaje']="Actualización satisfactoria";
                }else{
                    throw new Exception("Documento de Cliente ya existe.",1);
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
                    $objPer->cambiarEstado($_POST['idcliente'],$_POST['estado']);                 
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
                $registro = $objPer->consultar($_POST['idcliente']);
                $retorno = $registro->fetch(PDO::FETCH_NAMED); 
            }catch(Exception $ex){
                //nada
            }
            echo json_encode($retorno);
            break;

            case "CONSULTAR_WS":
                $retorno = array();
                try{
                    $idtipodoc = $_POST['idtipodocumento'];
                    $nrodocumento =  $_POST['nrodocumento'];
                    $retorno = array(
                            "idtipodocumento"=>$_POST['idtipodocumento'],
                            "nombre"=>"",
                            "direccion"=>""
                        );
                    
                    $existe = $objPer->verificarDuplicado($_POST['nrodocumento']);
                    $consultarws = true;
                    if($existe->rowCount()>0){
                        $cliente = $existe->fetch(PDO::FETCH_NAMED);
                        $retorno = array(
                            "idtipodocumento"=>$cliente["idtipodocumento"],
                            "nombre"=>$cliente['nombre'],
                            "direccion"=>$cliente['direccion']
                        );
                        $consultarws = false;
                    }   

                    if($idtipodoc==1 && $consultarws){
                        $ws = "https://dniruc.apisperu.com/api/v1/dni/".$nrodocumento."?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Imx1aXN0aW1hbmFnb256YWdhQGhvdG1haWwuY29tIn0.IxAceLS9puCS0LdM3yLtHZwzsstZAX6ot6RZdTVAiZc";
                        $datos = file_get_contents($ws);
                        $datos = json_decode($datos,true);
                        if(isset($datos['nombres'])){
                            $retorno["nombre"]=$datos['nombres'].' '.$datos['apellidoPaterno'].' '.$datos['apellidoMaterno'];
                        }
                    }

                    if($idtipodoc==6 && $consultarws){
                        $ws = "http://www.vfpsteambi.solutions/vfpsapiruc/vfpsapiruc.php?ruc=$nrodocumento";
                        $datos = file_get_contents($ws);
                        $datos = json_decode($datos,true);
                        if(isset($datos['nombre'])){
                            $retorno['nombre'] = $datos['nombre'];
                            $retorno['direccion'] = $datos['domicilio'];
                        }
                    }                    
                }catch(Exception $ex){
                    $retorno = array();
                }
                echo json_encode($retorno);
                break;

        default:
            echo "No se ha definido el proceso solicitado";
            break;
    }
}
?>
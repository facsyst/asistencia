<?php 
require_once("../modelo/Asistencia.php");

controlador($_POST['proceso']);

function controlador($proceso){
    $objAs = new Asistencia();
    switch ($proceso){
        case "NUEVO":
            $retorno = array();
            try{
                #$duplicado = $objAs->verificarDuplicado(trim($_POST['idpersonal']));
                #if($duplicado->rowCount()==0){
                    $asistencia = array();
                    $asistencia["idpersonal"] = trim($_POST["idpersonal"]);
                    $asistencia["fecha"] = $_POST["fecha"];
                    $asistencia["horaentrada"] = $_POST["horaentrada"];
                    $asistencia["horasalida"] = $_POST["horasalida"];
                    $asistencia["estado"] = $_POST["estado"];                                                       
                    
                    $objAs->insertar($asistencia);  
                                   
                    $retorno['correcto']=true;
                    $retorno['mensaje']="Registro satisfactorio";
                #}else{
                   # throw new Exception("idpersonal de asistencia ya existe.",1);
                #}                
            }catch(Exception $ex){
                $retorno['correcto']=false;
                $retorno['mensaje']=$ex->getMessage();
            }
            echo json_encode($retorno);
            break;

        case "ACTUALIZAR":
            $retorno = array();
            try{
                #$duplicado = $objAs->verificarDuplicado(trim($_POST['idpersonal']),$_POST['idasistencia']);
                #if($duplicado->rowCount()==0){
                    $asistencia = array();
                    $asistencia["idasistencia"] = $_POST["idasistencia"];
                    $asistencia["idpersonal"] = trim($_POST["idpersonal"]);
                    $asistencia["fecha"] = $_POST["fecha"];
                    $asistencia["horaentrada"] = $_POST["horaentrada"];
                    $asistencia["horasalida"] = $_POST["horasalida"];
                    $asistencia["estado"] = $_POST["estado"]; 

                    $objAs->actualizar($asistencia);                 
                    
                    $retorno['correcto']=true;
                    $retorno['mensaje']="Actualización satisfactoria";
                #}else{
                 #   throw new Exception("idpersonal de asistencia ya existe.",1);
                #}                
            }catch(Exception $ex){
                $retorno['correcto']=false;
                $retorno['mensaje']=$ex->getMessage();
            }
            echo json_encode($retorno);
            break;

        case "CAMBIAR_ESTADO":
                $retorno = array();
                try{
                    $objAs->cambiarEstado($_POST['idasistencia'],$_POST['estado']);                 
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
                $registro = $objAs->consultar($_POST['idasistencia']);
                $retorno = $registro->fetch(PDO::FETCH_NAMED); 
            }catch(Exception $ex){
                //nada
            }
            echo json_encode($retorno);
            break;
        
    }
}
?>
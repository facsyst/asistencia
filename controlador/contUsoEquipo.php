<?php 
require_once("../modelo/UsoEquipo.php");

controlador($_POST['proceso']);

function controlador($proceso){
    $objUsE = new UsoEquipo();
    switch ($proceso){
        case "NUEVO":
            $retorno = array();
            try{
                #$duplicado = $objUsE->verificarDuplicado(trim($_POST['idasistencia']));
                #if($duplicado->rowCount()==0){
                    $usoequipo = array();
                    $usoequipo["idasistencia"] = trim($_POST["idasistencia"]);
                    $usoequipo["idequipo"] = $_POST["idequipo"];
                    $usoequipo["estado"] = $_POST["estado"];                                                       
                    
                    $objUsE->insertar($usoequipo);  
                                   
                    $retorno['correcto']=true;
                    $retorno['mensaje']="Registro satisfactorio";
                #}else{
                   # throw new Exception("idasistencia de usoequipo ya existe.",1);
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
                #$duplicado = $objUsE->verificarDuplicado(trim($_POST['idasistencia']),$_POST['idusoequipo']);
                #if($duplicado->rowCount()==0){
                    $usoequipo = array();
                    $usoequipo["idusoequipo"] = $_POST["idusoequipo"];
                    $usoequipo["idasistencia"] = trim($_POST["idasistencia"]);
                    $usoequipo["idequipo"] = $_POST["idequipo"];
                    $usoequipo["estado"] = $_POST["estado"]; 

                    $objUsE->actualizar($usoequipo);                 
                    
                    $retorno['correcto']=true;
                    $retorno['mensaje']="Actualización satisfactoria";
                #}else{
                 #   throw new Exception("idasistencia de usoequipo ya existe.",1);
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
                    $objUsE->cambiarEstado($_POST['idusoequipo'],$_POST['estado']);                 
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
                $registro = $objUsE->consultar($_POST['idusoequipo']);
                $retorno = $registro->fetch(PDO::FETCH_NAMED); 
            }catch(Exception $ex){
                //nada
            }
            echo json_encode($retorno);
            break;
        
    }
}
?>
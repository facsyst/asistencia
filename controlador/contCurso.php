<?php 
require_once("../modelo/Curso.php");

controlador($_POST['proceso']);

function controlador($proceso){
    $objC = new Curso();
    switch ($proceso){
        case "NUEVO":
            $retorno = array();
            try{
                $duplicado = $objC->verificarDuplicado(trim($_POST['codigo']));
                if($duplicado->rowCount()==0){
                    $curso = array();
                    $curso["codigo"] = trim($_POST["codigo"]);
                    $curso["nombre"] = $_POST["nombre"];
                    $curso["estado"] = $_POST["estado"];                                                       
                    
                    $objC->insertar($curso);  
                                   
                    $retorno['correcto']=true;
                    $retorno['mensaje']="Registro satisfactorio";
                }else{
                    throw new Exception("codigo de curso ya existe.",1);
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
                $duplicado = $objC->verificarDuplicado(trim($_POST['codigo']),$_POST['idcurso']);
                if($duplicado->rowCount()==0){
                    $curso = array();
                    $curso["idcurso"] = $_POST["idcurso"];
                    $curso["codigo"] = trim($_POST["codigo"]);
                    $curso["nombre"] = $_POST["nombre"];
                    $curso["estado"] = $_POST["estado"]; 

                    $objC->actualizar($curso);                 
                    
                    $retorno['correcto']=true;
                    $retorno['mensaje']="Actualización satisfactoria";
                }else{
                    throw new Exception("codigo de curso ya existe.",1);
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
                    $objC->cambiarEstado($_POST['idcurso'],$_POST['estado']);                 
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
                $registro = $objC->consultar($_POST['idcurso']);
                $retorno = $registro->fetch(PDO::FETCH_NAMED); 
            }catch(Exception $ex){
                //nada
            }
            echo json_encode($retorno);
            break;
        
        
        
    }
}
?>
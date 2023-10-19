<?php 
require_once("../modelo/Equipo.php");

controlador($_POST['proceso']);

function controlador($proceso){
    $objEqu = new Equipo();
    switch ($proceso){
        case "NUEVO":
            $retorno = array();
            try{
                $duplicado = $objEqu->verificarDuplicado(trim($_POST['nro']));
                if($duplicado->rowCount()==0){
                    $equipo = array();
                    $equipo["nro"] = trim($_POST["nro"]);
                    $equipo["marca"] = $_POST["marca"];
                    $equipo["modelo"] = $_POST["modelo"];
                    $equipo["serie"] = $_POST["serie"];
                    $equipo["estado"] = $_POST["estado"];                                                       
                    
                    $objEqu->insertar($equipo);  
                                   
                    $retorno['correcto']=true;
                    $retorno['mensaje']="Registro satisfactorio";
                }else{
                    throw new Exception("nro de equipo ya existe.",1);
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
                $duplicado = $objEqu->verificarDuplicado(trim($_POST['nro']),$_POST['idequipo']);
                if($duplicado->rowCount()==0){
                    $equipo = array();
                    $equipo["idequipo"] = $_POST["idequipo"];
                    $equipo["nro"] = trim($_POST["nro"]);
                    $equipo["marca"] = $_POST["marca"];
                    $equipo["modelo"] = $_POST["modelo"];
                    $equipo["serie"] = $_POST["serie"];
                    $equipo["estado"] = $_POST["estado"]; 

                    $objEqu->actualizar($equipo);                 
                    
                    $retorno['correcto']=true;
                    $retorno['mensaje']="Actualización satisfactoria";
                }else{
                    throw new Exception("nro de equipo ya existe.",1);
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
                    $objEqu->cambiarEstado($_POST['idequipo'],$_POST['estado']);                 
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
                $registro = $objEqu->consultar($_POST['idequipo']);
                $retorno = $registro->fetch(PDO::FETCH_NAMED); 
            }catch(Exception $ex){
                //nada
            }
            echo json_encode($retorno);
            break;
        
        case 'SUBIR_IMAGEN':
                try{
                    if (empty($_FILES)) {
                        throw new Exception("No se encontraron archivos para cargar.", 123);
                    }
                    $archivo = $_FILES['uploadFile'];
                    $ruta = "imagenes/equipos/IMG_".$_POST['idequipo']."_".$archivo["name"];
                    move_uploaded_file($archivo["tmp_name"], "../".$ruta);
                    $objEqu->actualizarImagen($_POST['idequipo'],$ruta);
                    echo '[]';
                }catch(Exception $ex){
                    //nada
                }
                break;   
        case 'VER_MOVIMIENTOS':
            try{

                $fechasDesde = "";
                $fechasHasta = "";
                
                if(isset($_POST['fechadesde'])){
                    $fechasDesde = $_POST['fechadesde'];
                }

                if(isset($_POST['fechahasta'])){
                    $fechasHasta = $_POST['fechahasta'];
                }

                $movimientos = $objEqu->listarMovimientosequipo($_POST['idequipo'], $fechasDesde, $fechasHasta);
                $resultado = "<table class='table table-sm table-hover table-bordered'>";
                $resultado.= "<theader><tr>";
                $resultado.= "<th>Fecha</th>";
                $resultado.= "<th>Comprobante</th>";
                $resultado.= "<th>Cliente</th>";
                $resultado.= "<th>Cantidad</th>";
                $resultado.= "<th>P.V.</th>";
                $resultado.= "</tr></theader>";
                $resultado.= "<tbody>";

                while($fila = $movimientos->fetch(PDO::FETCH_NAMED)){
                    $resultado.= "<tr>"; 
                    $resultado.= "<td>".$fila['fecha']."</td>";
                    $resultado.= "<td>".$fila['comprobante']." ".$fila['serie']."-".$fila['correlativo']."</td>";
                    $resultado.= "<td>".$fila['cliente']."</td>";
                    $resultado.= "<td>".$fila['cantidad']."</td>";
                    $resultado.= "<td>".$fila['modelo']."</td>";
                    $resultado.= "</tr>";    
                }

                $resultado.= "</tbody>";                
                $resultado.="</table>";
                echo $resultado;
            }catch(Exception $ex){

            }
            break;
        default:
            echo "No se ha definido el proceso solicitado";
            break;
    }
}
?>
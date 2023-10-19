<?php 
require_once("../modelo/Producto.php");

controlador($_POST['proceso']);

function controlador($proceso){
    $objPro = new Producto();
    switch ($proceso){
        case "NUEVO":
            $retorno = array();
            try{
                $duplicado = $objPro->verificarDuplicado(trim($_POST['nombre']));
                if($duplicado->rowCount()==0){
                    $producto = array();
                    $producto["nombre"] = trim($_POST["nombre"]);
                    $producto["codigobarra"] = $_POST["codigobarra"];
                    $producto["pventa"] = $_POST["pventa"];
                    $producto["pcompra"] = $_POST["pcompra"];
                    $producto["stock"] = $_POST["stock"];
                    $producto["idunidad"] = $_POST["idunidad"];
                    $producto["urlimagen"] = $_POST["urlimagen"];
                    $producto["idcategoria"] = $_POST["idcategoria"];
                    $producto["idsubcategoria"] = isset($_POST["idsubcategoria"])?$_POST["idsubcategoria"]:NULL;                    
                    $producto["idafectacion"] = $_POST["idafectacion"];
                    $producto["afectoicbper"] = $_POST["afectoicbper"];
                    $producto["estado"] = $_POST["estado"];
                    $producto["stockseguridad"] = $_POST["stockseguridad"];                                                         
                    
                    $objPro->insertar($producto);  
                                   
                    $retorno['correcto']=true;
                    $retorno['mensaje']="Registro satisfactorio";
                }else{
                    throw new Exception("Nombre de Producto ya existe.",1);
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
                $duplicado = $objPro->verificarDuplicado(trim($_POST['nombre']),$_POST['idproducto']);
                if($duplicado->rowCount()==0){
                    $producto = array();
                    $producto["idproducto"] = $_POST["idproducto"];
                    $producto["nombre"] = trim($_POST["nombre"]);
                    $producto["codigobarra"] = $_POST["codigobarra"];
                    $producto["pventa"] = $_POST["pventa"];
                    $producto["pcompra"] = $_POST["pcompra"];
                    $producto["stock"] = $_POST["stock"];
                    $producto["idunidad"] = $_POST["idunidad"];
                    $producto["urlimagen"] = $_POST["urlimagen"];
                    $producto["idcategoria"] = $_POST["idcategoria"];
                    $producto["idsubcategoria"] = isset($_POST["idsubcategoria"])?$_POST["idsubcategoria"]:NULL;                    
                    $producto["idafectacion"] = $_POST["idafectacion"];
                    $producto["afectoicbper"] = $_POST["afectoicbper"];
                    $producto["estado"] = $_POST["estado"];
                    $producto["stockseguridad"] = $_POST["stockseguridad"];    

                    $objPro->actualizar($producto);                 
                    
                    $retorno['correcto']=true;
                    $retorno['mensaje']="Actualización satisfactoria";
                }else{
                    throw new Exception("Nombre de Producto ya existe.",1);
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
                    $objPro->cambiarEstado($_POST['idproducto'],$_POST['estado']);                 
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
                $registro = $objPro->consultar($_POST['idproducto']);
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
                    $ruta = "imagenes/productos/IMG_".$_POST['idproducto']."_".$archivo["name"];
                    move_uploaded_file($archivo["tmp_name"], "../".$ruta);
                    $objPro->actualizarImagen($_POST['idproducto'],$ruta);
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

                $movimientos = $objPro->listarMovimientosProducto($_POST['idproducto'], $fechasDesde, $fechasHasta);
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
                    $resultado.= "<td>".$fila['pventa']."</td>";
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
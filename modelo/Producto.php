<?php 
require_once("conexion.php");

class Producto{

    function listar($nombre, $estado){
        $sql = "SELECT idproducto, urlimagen, nombre, pventa, pcompra, estado, codigobarra,
                    stock, stockseguridad  
                FROM producto
                WHERE estado<2 ";
        $parametros = array();
        if($nombre!=""){
            $sql.=" AND nombre LIKE :nombre ";
            $parametros[':nombre'] = "%".$nombre."%";            
        }
        if($estado!=""){
            $sql.=" AND estado = :estado ";
            $parametros[':estado'] = $estado;            
        }

        $sql.=" ORDER BY nombre ";

        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function insertar($producto){
        $sql = "INSERT INTO producto(idproducto, nombre, codigobarra, pventa, 
                    pcompra, stock, idunidad, urlimagen, idcategoria,
                    idsubcategoria, idafectacion, afectoicbper, estado, stockseguridad)
                VALUES (NULL, :nombre, :codigobarra, :pventa, 
                    :pcompra, :stock, :idunidad, :urlimagen, :idcategoria, 
                    :idsubcategoria, :idafectacion,
                    :afectoicbper, :estado, :stockseguridad)";
        $parametros = array(
            ":nombre"         =>$producto["nombre"],   
            ":codigobarra"    =>$producto["codigobarra"],       
            ":pventa"         =>$producto["pventa"],   
            ":pcompra"        =>$producto["pcompra"],   
            ":stock"          =>$producto["stock"],   
            ":idunidad"       =>$producto["idunidad"],   
            ":urlimagen"      =>$producto["urlimagen"],       
            ":idcategoria"    =>$producto["idcategoria"],       
            ":idsubcategoria" =>$producto["idsubcategoria"], 
            ":idafectacion"   =>$producto["idafectacion"],      
            ":afectoicbper"   =>$producto["afectoicbper"],       
            ":estado"         =>$producto["estado"],   
            ":stockseguridad"=>$producto["stockseguridad"]                  
        );
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function actualizar($producto){
        $sql = "UPDATE producto SET 
        nombre = :nombre,
        codigobarra = :codigobarra,
        pventa = :pventa,
        pcompra = :pcompra,
        stock = :stock,
        idunidad = :idunidad,
        urlimagen = :urlimagen,
        idcategoria = :idcategoria,
        idsubcategoria = :idsubcategoria,
        idafectacion = :idafectacion,
        afectoicbper = :afectoicbper,
        estado = :estado,
        stockseguridad = :stockseguridad 
        WHERE idproducto=:idproducto";
        $parametros = array(
            ":idproducto"     =>$producto["idproducto"],
            ":nombre"         =>$producto["nombre"],   
            ":codigobarra"    =>$producto["codigobarra"],       
            ":pventa"         =>$producto["pventa"],   
            ":pcompra"        =>$producto["pcompra"],   
            ":stock"          =>$producto["stock"],   
            ":idunidad"       =>$producto["idunidad"],   
            ":urlimagen"      =>$producto["urlimagen"],       
            ":idcategoria"    =>$producto["idcategoria"],
            ":idsubcategoria" =>$producto["idsubcategoria"],       
            ":idafectacion"   =>$producto["idafectacion"],      
            ":afectoicbper"   =>$producto["afectoicbper"],       
            ":estado"         =>$producto["estado"],   
            ":stockseguridad"=>$producto["stockseguridad"]                  
        );
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function cambiarEstado($idproducto, $estado){
        $sql = "UPDATE producto SET estado=:estado WHERE idproducto=:idproducto";
        $parametros = array(':idproducto'=>$idproducto,':estado'=>$estado);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function verificarDuplicado($nombre, $idproducto=0){
        $sql = "SELECT * FROM producto 
                WHERE nombre=:nombre AND idproducto<>:idproducto AND estado<2";
        $parametros = array(':nombre'=>$nombre,':idproducto'=>$idproducto);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function consultar($idproducto){
        $sql = "SELECT * FROM producto WHERE idproducto=:idproducto AND estado<2";
        $parametros = array(':idproducto'=>$idproducto);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function consultarUnidad(){
        $sql = "SELECT * FROM unidad WHERE estado=1";
        global $cnx;
        $pre = $cnx->query($sql);
        return $pre;
    }

    function consultarAfectacion(){
        $sql = "SELECT * FROM afectacion";
        global $cnx;
        $pre = $cnx->query($sql);
        return $pre;
    }

    function actualizarImagen($idproducto, $urlimagen){
        $sql = "UPDATE producto SET urlimagen=:urlimagen WHERE idproducto=:idproducto";
        $parametros = array(':idproducto'=>$idproducto,':urlimagen'=>$urlimagen);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function actualizarStock($idproducto, $cantidad){
        $sql = "UPDATE producto SET stock=stock+:cantidad WHERE idproducto=:idproducto";
        global $cnx;
        $parametros = array(":idproducto"=>$idproducto,":cantidad"=>$cantidad);
        $pre= $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function listarMovimientosProducto($idproducto, $fechaDesde="", $fechaHasta=""){
        $sql = "SELECT DATE_FORMAT(v.fecha,'%d/%m/%Y') fecha, t.nombre comprobante, 
        v.serie, v.correlativo, c.nombre cliente, d.cantidad, d.pventa
        FROM venta v
        INNER JOIN detalle d ON v.idventa=d.idventa
        INNER JOIN tipocomprobante t ON t.idtipocomprobante=v.idtipocomprobante
        LEFT JOIN cliente c on v.idcliente=c.idcliente
        WHERE v.estado=1 AND d.estado=1 AND d.idproducto=:idproducto";
        
        $parametros = array(":idproducto"=>$idproducto);

        if($fechaDesde!=""){
            $sql.=" AND v.fecha>=:fechadesde";
            $parametros[':fechadesde'] = $fechaDesde;
        }

        if($fechaHasta!=""){
            $sql.=" AND v.fecha<=:fechahasta";
            $parametros[':fechahasta'] = $fechaHasta;
        }

        global $cnx;
        $pre= $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;         
    }

}

?>
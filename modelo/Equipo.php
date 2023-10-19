<?php 
require_once("conexion.php");

class Equipo{

    function listar($nro, $estado){
        $sql = "SELECT idequipo, nro, marca, modelo, serie, estado
                FROM equipo
                WHERE estado<2 ";
        $parametros = array();
        if($nro!=""){
            $sql.=" AND nro LIKE :nro ";
            $parametros[':nro'] = "%".$nro."%";            
        }
        if($estado!=""){
            $sql.=" AND estado = :estado ";
            $parametros[':estado'] = $estado;            
        }

        $sql.=" ORDER BY nro ";

        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function insertar($equipo){
        $sql = "INSERT INTO equipo(idequipo, nro, marca, modelo,serie ,estado)
                VALUES (NULL, :nro, :marca, :modelo,:serie, :estado)";
        $parametros = array(
            ":nro"         =>$equipo["nro"],   
            ":marca"    =>$equipo["marca"],       
            ":modelo"         =>$equipo["modelo"],   
            ":serie"        =>$equipo["serie"],   
            ":estado"          =>$equipo["estado"]
                 
        );
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function actualizar($equipo){
        $sql = "UPDATE equipo SET 
        nro = :nro,
        marca = :marca,
        modelo = :modelo,
        serie = :serie,
        estado = :estado
       
        WHERE idequipo=:idequipo";
        $parametros = array(
            ":idequipo"     =>$equipo["idequipo"],
            ":nro"         =>$equipo["nro"],   
            ":marca"    =>$equipo["marca"],       
            ":modelo"         =>$equipo["modelo"],   
            ":serie"        =>$equipo["serie"],   
            ":estado"          =>$equipo["estado"] 
                           
        );
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function cambiarEstado($idequipo, $estado){
        $sql = "UPDATE equipo SET estado=:estado WHERE idequipo=:idequipo";
        $parametros = array(':idequipo'=>$idequipo,':estado'=>$estado);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function verificarDuplicado($nro, $idequipo=0){
        $sql = "SELECT * FROM equipo 
                WHERE nro=:nro AND idequipo<>:idequipo AND estado<2";
        $parametros = array(':nro'=>$nro,':idequipo'=>$idequipo);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function consultar($idequipo){
        $sql = "SELECT * FROM equipo WHERE idequipo=:idequipo AND estado<2";
        $parametros = array(':idequipo'=>$idequipo);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

  

    function listarMovimientosequipo($idequipo, $fechaDesde="", $fechaHasta=""){
        $sql = "SELECT DATE_FORMAT(v.fecha,'%d/%m/%Y') fecha, t.nombre comprobante, 
        v.serie, v.correlativo, c.nombre cliente, d.cantidad, d.pventa
        FROM venta v
        INNER JOIN detalle d ON v.idventa=d.idventa
        INNER JOIN tipocomprobante t ON t.idtipocomprobante=v.idtipocomprobante
        LEFT JOIN cliente c on v.idcliente=c.idcliente
        WHERE v.estado=1 AND d.estado=1 AND d.idequipo=:idequipo";
        
        $parametros = array(":idequipo"=>$idequipo);

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
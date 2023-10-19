<?php 
require_once("conexion.php");

class Asistencia{

    function listar($nombre, $estado){
        $sql = "SELECT t1.idsubcategoria, t1.nombre, t1.estado, t2.nombre categoria  
                FROM subcategoria t1
                LEFT JOIN categoria t2 ON t1.idcategoria=t2.idcategoria
                WHERE t1.estado<2 ";
        $parametros = array();
        if($nombre!=""){
            $sql.=" AND t1.nombre LIKE :nombre ";
            $parametros[':nombre'] = "%".$nombre."%";            
        }
        if($estado!=""){
            $sql.=" AND t1.estado = :estado ";
            $parametros[':estado'] = $estado;            
        }

        $sql.=" ORDER BY t1.nombre ";

        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function insertar($asistencia){
        $sql = "INSERT INTO asistencia(idasistencia, idpersonal, fecha, horaentrada,horasalida ,estado)
                VALUES (NULL, :idpersonal, :fecha, :horaentrada, :horasalida , :estado)";
        $parametros = array(
            ":idpersonal"         =>$asistencia["idpersonal"],   
            ":fecha"    =>$asistencia["fecha"],       
            ":horaentrada"         =>$asistencia["horaentrada"],   
            ":horasalida"        =>$asistencia["horasalida"],   
            ":estado"          =>$asistencia["estado"]
                 
        );
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function actualizar($asistencia){
        $sql = "UPDATE asistencia SET 
        idasistencia =:idasistencia,
        idpersonal = :idpersonal,
        fecha = :fecha,
        horaentrada = :horaentrada,
        horasalida = :horasalida,
        estado = :estado
       
        WHERE idasistencia=:idasistencia";
        $parametros = array(
            ":idasistencia"     =>$asistencia["idasistencia"],
            ":idpersonal"         =>$asistencia["idpersonal"],   
            ":fecha"    =>$asistencia["fecha"],       
            ":horaentrada"         =>$asistencia["horaentrada"],   
            ":horasalida"        =>$asistencia["horasalida"],   
            ":estado"          =>$asistencia["estado"] 
                           
        );
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function cambiarEstado($idasistencia, $estado){
        $sql = "UPDATE asistencia SET estado=:estado WHERE idasistencia=:idasistencia";
        $parametros = array(':idasistencia'=>$idasistencia,':estado'=>$estado);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function verificarDuplicado($nro, $idasistencia=0){
        $sql = "SELECT * FROM asistencia 
                WHERE nro=:nro AND idasistencia<>:idasistencia AND estado<2";
        $parametros = array(':nro'=>$nro,':idasistencia'=>$idasistencia);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function consultar($idasistencia){
        $sql = "SELECT * FROM asistencia WHERE idasistencia=:idasistencia AND estado<2";
        $parametros = array(':idasistencia'=>$idasistencia);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

}

?>
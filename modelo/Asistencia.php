<?php 
require_once("conexion.php");

class Asistencia{

    function listar($nombre, $estado){
        $sql = "SELECT t1.idasistencia, t2.nombre,t1.fecha,t1.horaentrada,t1.horasalida,t1.estado   
                FROM asistencia t1
                INNER JOIN docente t2 ON t1.iddocente=t2.iddocente
                WHERE t1.estado<2 ";
        $parametros = array();
        if($nombre!=""){
            $sql.=" AND t2.nombre LIKE :nombre ";
            $parametros[':nombre'] = "%".$nombre."%";            
        }
        if($estado!=""){
            $sql.=" AND t1.estado = :estado ";
            $parametros[':estado'] = $estado;            
        }

        $sql.=" ORDER BY t2.nombre ";

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
            ":fecha"              =>$asistencia["fecha"],       
            ":horaentrada"        =>$asistencia["horaentrada"],   
            ":horasalida"         =>$asistencia["horasalida"],   
            ":estado"             =>$asistencia["estado"]
                 
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

    function verificarDuplicado($idpersonal, $idasistencia=0){
        $sql = "SELECT * FROM asistencia 
                WHERE idpersonal=:idpersonal AND idasistencia<>:idasistencia AND estado<2";
        $parametros = array(':nombre'=>$nombre,':idasistencia'=>$idasistencia);
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


    
    function listarAsistenciaPersonal(){
        $sql = "SELECT a.idasistencia, p.nombre 
        FROM asistencia a
        INNER JOIN personal p ON a.idpersonal = p.idpersonal 
        WHERE a.estado <2";
        global $cnx;
        $pre = $cnx->query($sql);
        return $pre;
    }


}

?>
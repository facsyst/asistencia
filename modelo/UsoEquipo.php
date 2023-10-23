<?php 
require_once("conexion.php");

class UsoEquipo{

    function listar($nombre, $estado){
        $sql = "SELECT t1.idusoequipo,t3.nombre ,t2.fecha,t2.horaentrada,t2.horasalida,t4.nro,t4.marca ,t4.serie ,t1.estado 
        FROM usoequipo t1 
        INNER JOIN asistencia t2 ON t1.idasistencia=t2.idasistencia 
        INNER JOIN personal t3 ON t2.idpersonal=t3.idpersonal
        INNER JOIN equipo t4 ON t1.idequipo = t4.idequipo
        WHERE t1.estado<2";
        $parametros = array();
        if($nombre!=""){
            $sql.=" AND t3.nombre LIKE :nombre ";
            $parametros[':nombre'] = "%".$nombre."%";            
        }
        if($estado!=""){
            $sql.=" AND t1.estado = :estado ";
            $parametros[':estado'] = $estado;            
        }

        $sql.=" ORDER BY t3.nombre ";

        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function insertar($usoequipo){
        $sql = "INSERT INTO usoequipo(idusoequipo, idasistencia, idequipo,estado)
                VALUES (NULL, :idasistencia, :idequipo, :estado)";
        $parametros = array(
            ":idasistencia"         =>$usoequipo["idasistencia"],   
            ":idequipo"              =>$usoequipo["idequipo"],         
            ":estado"             =>$usoequipo["estado"]
                 
        );
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function actualizar($usoequipo){
        $sql = "UPDATE usoequipo SET 
        idusoequipo =:idusoequipo,
        idasistencia = :idasistencia,
        idequipo = :idequipo,
        estado = :estado
       
        WHERE idusoequipo=:idusoequipo";
        $parametros = array(
            ":idusoequipo"     =>$usoequipo["idusoequipo"],
            ":idasistencia"    =>$usoequipo["idasistencia"],   
            ":idequipo"        =>$usoequipo["idequipo"],         
            ":estado"          =>$usoequipo["estado"] 
                           
        );
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function cambiarEstado($idusoequipo, $estado){
        $sql = "UPDATE usoequipo SET estado=:estado WHERE idusoequipo=:idusoequipo";
        $parametros = array(':idusoequipo'=>$idusoequipo,':estado'=>$estado);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function verificarDuplicado($idasistencia, $idusoequipo=0){
        $sql = "SELECT * FROM usoequipo 
                WHERE idasistencia=:idasistencia AND idusoequipo<>:idusoequipo AND estado<2";
        $parametros = array(':nombre'=>$nombre,':idusoequipo'=>$idusoequipo);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function consultar($idusoequipo){
        $sql = "SELECT * FROM usoequipo WHERE idusoequipo=:idusoequipo AND estado<2";
        $parametros = array(':idusoequipo'=>$idusoequipo);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

}

?>
<?php 
require_once("conexion.php");

class Subcategoria{

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

    function insertar($idcategoria, $nombre, $estado){
        $sql = "INSERT INTO subcategoria(idsubcategoria, idcategoria, nombre, estado)
                VALUES(NULL, :idcategoria, :nombre, :estado)";
        $parametros = array(':idcategoria'=>$idcategoria,':nombre'=>$nombre, ':estado'=>$estado);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function actualizar($idsubcategoria, $idcategoria, $nombre, $estado){
        $sql = "UPDATE subcategoria SET idcategoria=:idcategoria, nombre=:nombre, estado=:estado
                WHERE idsubcategoria=:idsubcategoria";
        $parametros = array(':idsubcategoria'=>$idsubcategoria,
                            ':idcategoria'=>$idcategoria, 
                            ':nombre'=>$nombre, 
                            ':estado'=>$estado);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function cambiarEstado($idsubcategoria, $estado){
        $sql = "UPDATE subcategoria SET estado=:estado WHERE idsubcategoria=:idsubcategoria";
        $parametros = array(':idsubcategoria'=>$idsubcategoria,':estado'=>$estado);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function verificarDuplicado($nombre, $idsubcategoria=0){
        $sql = "SELECT * FROM subcategoria 
                WHERE nombre=:nombre AND idsubcategoria<>:idsubcategoria AND estado<2";
        $parametros = array(':nombre'=>$nombre,':idsubcategoria'=>$idsubcategoria);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function consultar($idsubcategoria){
        $sql = "SELECT * FROM subcategoria WHERE idsubcategoria=:idsubcategoria AND estado<2";
        $parametros = array(':idsubcategoria'=>$idsubcategoria);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function consultarPorCategoria($idcategoria){
        $sql = "SELECT * FROM subcategoria WHERE idcategoria=:idcategoria AND estado=1";
        $parametros = array(':idcategoria'=>$idcategoria);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

}

?>
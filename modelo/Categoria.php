<?php 
require_once("conexion.php");

class Categoria{

    function listar($nombre, $estado){
        $sql = "SELECT idcategoria, nombre, estado 
                FROM categoria
                WHERE estado<2 
                ";
        $parametros = array();
        if($nombre!=""){
            $sql.=" AND nombre LIKE :nombre ";
            $parametros[':nombre'] = "%".$nombre."%";            
        }
        if($estado!=""){
            $sql.=" AND estado = :estado ";
            $parametros[':estado'] = $estado;            
        }

            $sql.=" ORDER BY nombre ASC ";
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function insertar($nombre, $estado){
        $sql = "INSERT INTO categoria(idcategoria, nombre, estado)
                VALUES(NULL, :nombre, :estado)";
        $parametros = array(':nombre'=>$nombre, ':estado'=>$estado);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function actualizar($idcategoria, $nombre, $estado){
        $sql = "UPDATE categoria SET nombre=:nombre, estado=:estado
                WHERE idcategoria=:idcategoria";
        $parametros = array(':idcategoria'=>$idcategoria, 
                            ':nombre'=>$nombre, 
                            ':estado'=>$estado);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function cambiarEstado($idcategoria, $estado){
        $sql = "UPDATE categoria SET estado=:estado WHERE idcategoria=:idcategoria";
        $parametros = array(':idcategoria'=>$idcategoria,':estado'=>$estado);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function verificarDuplicado($nombre, $idcategoria=0){
        $sql = "SELECT * FROM categoria 
                WHERE nombre=:nombre AND idcategoria<>:idcategoria AND estado<2";
        $parametros = array(':nombre'=>$nombre,':idcategoria'=>$idcategoria);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function consultar($idcategoria){
        $sql = "SELECT * FROM categoria WHERE idcategoria=:idcategoria AND estado<2";
        $parametros = array(':idcategoria'=>$idcategoria);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

}

?>
<?php 
require_once("conexion.php");

class Curso{

    function listar($nombre, $estado){
        $sql = "SELECT codigo,nombre, estado
                FROM curso
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

    function insertar($curso){
        $sql = "INSERT INTO curso(idcurso, codigo, nombre ,estado)
                VALUES (NULL, :codigo,:nombre, :estado)";
        $parametros = array(
            ":codigo"         =>$curso["codigo"],   
            ":nombre"    =>$curso["nombre"],       
            ":estado"          =>$curso["estado"]
                 
        );
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function actualizar($curso){
        $sql = "UPDATE curso SET 
        codigo = :codigo,
        nombre = :nombre,
        estado = :estado
       
        WHERE idcurso=:idcurso";
        $parametros = array(
            ":idcurso"     =>$curso["idcurso"],
            ":codigo"         =>$curso["codigo"],   
            ":nombre"    =>$curso["nombre"],         
            ":estado"          =>$curso["estado"] 
                           
        );
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function cambiarEstado($idcurso, $estado){
        $sql = "UPDATE curso SET estado=:estado WHERE idcurso=:idcurso";
        $parametros = array(':idcurso'=>$idcurso,':estado'=>$estado);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function verificarDuplicado($codigo, $idcurso=0){
        $sql = "SELECT * FROM curso 
                WHERE codigo=:codigo AND idcurso<>:idcurso AND estado<2";
        $parametros = array(':codigo'=>$codigo,':idcurso'=>$idcurso);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function consultar($idcurso){
        $sql = "SELECT * FROM curso WHERE idcurso=:idcurso AND estado<2";
        $parametros = array(':idcurso'=>$idcurso);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }



}

?>
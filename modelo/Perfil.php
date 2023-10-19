<?php
require_once("conexion.php");

class Perfil{

    function listar($nombre, $estado){
        $sql = "SELECT idperfil, nombre, estado 
                FROM perfil
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
        $sql = "INSERT INTO perfil(idperfil, nombre, estado)
                VALUES(NULL, :nombre, :estado)";
        $parametros = array(':nombre'=>$nombre, ':estado'=>$estado);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function actualizar($idperfil, $nombre, $estado){
        $sql = "UPDATE perfil SET nombre=:nombre, estado=:estado
                WHERE idperfil=:idperfil";
        $parametros = array(':idperfil'=>$idperfil, 
                            ':nombre'=>$nombre, 
                            ':estado'=>$estado);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function cambiarEstado($idperfil, $estado){
        $sql = "UPDATE perfil SET estado=:estado WHERE idperfil=:idperfil";
        $parametros = array(':idperfil'=>$idperfil,':estado'=>$estado);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function verificarDuplicado($nombre, $idperfil=0){
        $sql = "SELECT * FROM perfil 
                WHERE nombre=:nombre AND idperfil<>:idperfil AND estado<2";
        $parametros = array(':nombre'=>$nombre,':idperfil'=>$idperfil);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function consultar($idperfil){
        $sql = "SELECT * FROM perfil WHERE idperfil=:idperfil AND estado<2";
        $parametros = array(':idperfil'=>$idperfil);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function obtenerPermisosPorPeril($idperfil){
        $sql = "SELECT t1.descripcion, t1.icono, t1.url, t2.idopcion 
        FROM opcion t1
        INNER JOIN acceso t2 ON t1.idopcion=t2.idopcion
        WHERE t2.idperfil=? AND t1.estado=1 AND t2.estado=1
        ORDER BY t1.orden ASC ";

        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute(array($idperfil));
        return $pre;
    }

    function listarPermisos(){
        $sql = "SELECT * FROM opcion WHERE estado=1 ORDER BY orden ASC";
        global $cnx;
        $pre = $cnx->query($sql);
        return $pre;
    }

    function insertarAcceso($idperfil, $idopcion, $estado){
        $sql = "INSERT INTO acceso(idperfil, idopcion, estado)
                VALUES (:idperfil, :idopcion, :estado)";
        $parametros = array(':idperfil' =>$idperfil, 
                            ':idopcion' =>$idopcion,
                            ':estado'   =>$estado);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function actualizarAcceso($idperfil, $idopcion, $estado){
        $sql = "UPDATE acceso SET estado=:estado 
                WHERE idperfil=:idperfil AND idopcion=:idopcion";
        $parametros = array(':idperfil' =>$idperfil, 
                            ':idopcion' =>$idopcion,
                            ':estado'   =>$estado    
                        );
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;                
    }    

    function consultarAcceso($idperfil, $idopcion){
        $sql = "SELECT * FROM acceso WHERE idperfil=:idperfil AND idopcion=:idopcion";
        $parametros = array(':idperfil' =>$idperfil, 
                            ':idopcion' =>$idopcion  
                        );
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;          
    }
}

?>
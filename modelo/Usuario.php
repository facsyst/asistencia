<?php 
require_once("conexion.php");

class Usuario{

    function listar($nombre, $estado){
        $sql = "SELECT u.*,p.nombre perfil FROM usuario u 
                LEFT JOIN perfil p ON u.idperfil=p.idperfil
                WHERE u.estado<2 AND u.nombre LIKE :nombre ";
        $parametros = array(':nombre'=>$nombre);
        if($estado!=""){
            $sql.=" AND u.estado=:estado ";
            $parametros[':estado']=$estado;
        }
        $sql.=" ORDER BY u.nombre ASC";
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }  

    function consultarUsuario($idusuario){
        $sql = "SELECT * FROM usuario WHERE idusuario=:idusuario";
        
       global $cnx;
       $pre = $cnx->prepare($sql);
       $parametros = array(':idusuario'=>$idusuario); 
       $pre->execute($parametros);
        return $pre;
    }

    function verificarUsuario($usuario, $clave){
        $sql = "SELECT t1.idusuario, t1.nombre, t1.usuario, t1.idperfil,
                        t2.nombre perfil
                FROM usuario t1                 
                INNER JOIN perfil t2 ON t1.idperfil=t2.idperfil
                WHERE t1.usuario=:usuario 
                AND t1.clave=SHA1(:clave) AND t1.estado=1 AND t2.estado=1";
        global $cnx;
        $pre = $cnx->prepare($sql);
        $parametros = array(':usuario'=>$usuario, ':clave'=>$clave);
        $pre->execute($parametros);
        return $pre;
    }

    function insertar($nombre, $usuario, $clave, $idperfil, $estado){
        $sql = "INSERT INTO usuario VALUES (NULL,:nombre,:usuario, SHA1(:clave),:idperfil, :estado)";
        global $cnx;
        $parametros = array(":nombre"=>$nombre, 
                            ":usuario"=>$usuario,
                            ":clave"=>$clave,
                            ":idperfil"=>$idperfil,
                            ":estado"=>$estado);
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function actualizar($idusuario, $nombre, $usuario, $clave, $idperfil, $estado){
        $sql = "UPDATE usuario 
                SET nombre=:nombre, 
                    usuario=:usuario,";
        
        $parametros = array(":idusuario"=>$idusuario, 
                            ":nombre"=>$nombre, 
                            ":usuario"=>$usuario,
                            ":idperfil"=>$idperfil,
                            ":estado"=>$estado);
 
        if($clave!=""){
            $sql.=" clave=SHA1(:clave), ";
            $parametros[':clave']=$clave;
        }
        $sql.=" idperfil=:idperfil,
                    estado=:estado 
                WHERE idusuario=:idusuario";
        global $cnx;
        $pre= $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function actualizarEstado($idusuario, $estado){
        $sql = "UPDATE usuario SET estado=:estado WHERE idusuario=:idusuario";
        global $cnx;
        $parametros = array(":idusuario"=>$idusuario, ":estado"=>$estado);
        $pre= $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function consultarUsuarioNombre($usuario, $idusuario=0){
        $sql = "SELECT * FROM usuario WHERE usuario=? AND idusuario<>?";
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute(array($usuario,$idusuario));
        return $pre;
    }

}

?>
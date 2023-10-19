<?php
require_once("../modelo/Perfil.php");

$objPer = new Perfil();

$listado = $objPer->listar($_POST['nombre'], $_POST['estado']);
$estados= array(0=>"ANULADO",1=>"ACTIVO");
?>
<table id="tablaPerfil" class="table table-bordered table-hover table-striped table-sm">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th>Permisos</th>
            <th>Edit</th>
            <th>Anu</th>
            <th>Elim</th>
        </tr>
    </thead>
    <tbody>
        <?php while($fila = $listado->fetch(PDO::FETCH_NAMED)){ ?>
        <tr class="<?= $fila['estado']==1?'':'text-red'?>">
            <td><?= $fila['idperfil'] ?></td>
            <td><?= $fila['nombre'] ?></td>
            <td><?= $estados[$fila['estado']] ?></td>
            <td><button class="btn btn-sm bg-navy" onclick="VerPermisos(<?= $fila['idperfil'];?>,'<?= $fila['nombre'] ?>')"><span class="fa fa-lock"></span></button></td>
            <td><button class="btn btn-sm btn-info" onclick="Editar(<?= $fila['idperfil'];?>)"><span class="fa fa-edit"></span> Editar</button></td>
            <td>
            <?php if($fila['estado']==1){?>
                <button class="btn btn-sm btn-warning" onclick="CambiarEstadoModal(<?= $fila['idperfil'];?>,0,'<?= $fila['nombre'] ?>')"><span class="fa fa-ban"></span> Anular</button>
            <?php }else{ ?>
                <button class="btn btn-sm btn-success" onclick="CambiarEstadoModal(<?= $fila['idperfil'];?>,1,'<?= $fila['nombre'] ?>')"><span class="fa fa-check"></span> Activar</button>
            <?php }?>
            </td>
            <td><button class="btn btn-sm btn-danger" onclick="CambiarEstadoModal(<?= $fila['idperfil'];?>,2,'<?= $fila['nombre'] ?>')"><span class="fa fa-trash"></span> Eliminar</button></td>
        </tr>
        <?php }?>
    </tbody>
</table>
<script>
$("#tablaPerfil").DataTable({
      "paging": true,
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "ordering": true,
      "searching": false,
      "info": true,
      "language": {
			 "info": "Del _START_ al _END_ de _TOTAL_ registros",
             "paginate": {
				       "next": "Siguiente",
                       "previous": "Anterior"
				 }
			},
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tablaPerfil_wrapper .col-md-6:eq(0)');


function Editar(idperfil){
    $.ajax({
        method: 'POST',
        url:    'controlador/contPerfil.php',
        data:{
            'proceso':'CONSULTAR',
            'idperfil': idperfil
        },
        dataType: 'json'
    }).done(function(retorno){
        $("#idperfil").val(retorno.idperfil);
        $("#nombre").val(retorno.nombre);
        $("#estado").val(retorno.estado);

        $("#proceso").val("ACTUALIZAR");
        $("#modal-formulario").modal('show');
        $("#modal-formulario").on('hidden.bs.modal', function(e){
            $("#formulario").trigger("reset");
        })
    });
}

function CambiarEstado(idperfil, estado){
    $.ajax({
        method: 'POST',
        url:    'controlador/contPerfil.php',
        data:{
            'proceso':'CAMBIAR_ESTADO',
            'idperfil': idperfil,
            'estado': estado
        },
        dataType: 'json'
    }).done(function(resultado){
        $("#modal-confirmacion").modal('hide');
        if(resultado.correcto){
            toastCorrecto(resultado.mensaje);
            Buscar();            
        }else{
            toastError(resultado.mensaje);
        }
    });
}

function CambiarEstadoModal(idperfil,estado,nombre){
    $("#idcambiarestado").val(idperfil);
    $("#cambioestado").val(estado);
    texto_accion="ELIMINAR";
    if(estado==1){ texto_accion="ACTIVAR"; }
    if(estado==0){ texto_accion="ANULAR"}
    texto_accion="<b>"+texto_accion+"</b>";
    texto_accion = texto_accion + " el perfil " + nombre;
    $("#texto_accion").html(texto_accion);
    $("#modal-confirmacion").modal('show');
    $("#modal-confirmacion").on('hidden.bs.modal', function(e){
        $("#formulario").trigger("reset");
    });
}

function CambiarEstadoConfirmacion(){
    CambiarEstado($("#idcambiarestado").val(), $("#cambioestado").val());
}

function VerPermisos(idperfil, nombre){
    $("#titulo_permiso").html(nombre);
    $("#idperfil_acceso").val(idperfil)
    $(".permiso_perfil").each(function(){
        $(this).prop("checked",false);
    });

    $.ajax({
        method: 'POST',
        url:    'controlador/contPerfil.php',
        data:{
            'proceso':'CONSULTAR_PERMISOS',
            'idperfil': idperfil
        },
        dataType: 'json'
    }).done(function(resultado){
        for(i=0; i<resultado.length; i++){
            $("#cbPermiso"+resultado[i].idopcion).prop("checked",true);
        }

        $("#modal-acceso").modal('show');
    });

}

</script>
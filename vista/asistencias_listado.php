<?php
require_once("../modelo/Asistencia.php");

$objAsistencia = new Asistencia();

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$estado = isset($_POST['estado']) ? $_POST['estado'] : null;

$listado = $objAsistencia->listar($nombre, $estado);
$estados= array(0=>"ANULADO",1=>"ACTIVO");
?>

<table id="tablaAsistencia" class="table table-bordered table-hover table-striped table-sm">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>H.Entrada</th>
            <th>H.Salida</th>
            <th>Estado</th>
            <th>Opciones</th>
           
        </tr>
    </thead>
    <tbody>
        <?php while($fila = $listado->fetch(PDO::FETCH_NAMED)){ ?>
        <tr class="<?= $fila['estado']==1?'':'text-red'?>">
            <td><?= $fila['idasistencia'] ?></td>
            <td><?= $fila['nombre'] ?></td>
            <td><?= $fila['fecha'] ?></td>
            <td><?= $fila['horaentrada'] ?></td>
            <td><?= $fila['horasalida'] ?></td>
            <td><?= $estados[$fila['estado']] ?>
            <td><button class="btn btn-sm btn-info" onclick="Editar(<?= $fila['idasistencia'];?>)"><span class="fa fa-edit"></span> </button>
            
            <?php if($fila['estado']==1){?>
                <button class="btn btn-sm btn-warning" onclick="CambiarEstadoModal(<?= $fila['idasistencia'];?>,0,'<?= $fila['nombre'] ?>')"><span class="fa fa-ban"></span> </button>
            <?php }else{ ?>
                <button class="btn btn-sm btn-success" onclick="CambiarEstadoModal(<?= $fila['idasistencia'];?>,1,'<?= $fila['nombre'] ?>')"><span class="fa fa-check"></span> </button>
            <?php }?>
            
            <button class="btn btn-sm btn-danger" onclick="CambiarEstadoModal(<?= $fila['idasistencia'];?>,2,'<?= $fila['nombre'] ?>')"><span class="fa fa-trash"></span> </button></td>
        </tr>
        <?php }?>
    </tbody>
</table>
<script>
$("#tablaAsistencia").DataTable({
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
    }).buttons().container().appendTo('#tablaAsistencia_wrapper .col-md-6:eq(0)');

modoEdicion = false;

function Editar(idasistencia){
    $.ajax({
        method: 'POST',
        url:    'controlador/contAsistencia.php',
        data:{
            'proceso':'CONSULTAR',
            'idasistencia': idasistencia
        },
        dataType: 'json'
    }).done(function(retorno){
        modoEdicion = true;
        $("#idasistencia").val(retorno.idasistencia);
        $("#idpersonal").val(retorno.idpersonal);
        $("#fecha").val(retorno.fecha);
        $("#horaentrada").val(retorno.horaentrada);
        $("#horasalida").val(retorno.horasalida);
        $("#estado").val(retorno.estado);

        $("#proceso").val("ACTUALIZAR");
        $("#modal-formulario").modal('show');
        $("#modal-formulario").on('hidden.bs.modal', function(e){
            $("#formulario").trigger("reset");
            $("#idpersonal").val("").trigger("change");
        })
    });
}

function CambiarEstado(idasistencia, estado){
    $.ajax({
        method: 'POST',
        url:    'controlador/contAsistencia.php',
        data:{
            'proceso':'CAMBIAR_ESTADO',
            'idasistencia': idasistencia,
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

function CambiarEstadoModal(idasistencia,estado,nombre){
    $("#idcambiarestado").val(idasistencia);
    $("#cambioestado").val(estado);
    texto_accion="ELIMINAR";
    if(estado==1){ texto_accion="ACTIVAR"; }
    if(estado==0){ texto_accion="ANULAR"}
    texto_accion="<b>"+texto_accion+"</b>";
    texto_accion = texto_accion + " el producto " + nombre;
    $("#texto_accion").html(texto_accion);
    $("#modal-confirmacion").modal('show');
    $("#modal-confirmacion").on('hidden.bs.modal', function(e){
        $("#formulario").trigger("reset");
    });
}

function CambiarEstadoConfirmacion(){
    CambiarEstado($("#idcambiarestado").val(), $("#cambioestado").val());
}


</script>
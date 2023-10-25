<?php
require_once("../modelo/UsoEquipo.php");

$objUsEq = new UsoEquipo();

$listado = $objUsEq->listar($_POST['nombre'], $_POST['estado']);
$estados= array(0=>"ANULADO",1=>"ACTIVO");
?>
<table id="tablaCategoria" class="table table-bordered table-hover table-striped table-sm">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Documento</th>
            <th>Fecha</th>
            <th>H.Entrada</th>
            <th>H.Salida</th>
            <th>Nro</th>
            <th>Marca</th>
            <th>Serie</th>
            <th>Estado</th>
            <th>Opciones</th> 
        </tr>
    </thead>
    <tbody>
        <?php while($fila = $listado->fetch(PDO::FETCH_NAMED)){ ?>
        <tr class="<?= $fila['estado']==1?'':'text-red'?>">
            <td><?= $fila['idusoequipo'] ?></td>
            <td><?= $fila['nombre'] ?></td>
            <td><?= $fila['nrodocumento'] ?></td>
            <td><?= $fila['fecha'] ?></td>
            <td><?= $fila['horaentrada'] ?></td>
            <td><?= $fila['horasalida'] ?></td>
            <td><?= $fila['nro'] ?></td>
            <td><?= $fila['marca'] ?></td>
            <td><?= $fila['serie'] ?></td>
            <td><?= $estados[$fila['estado']] ?></td>
            <td><button class="btn btn-sm btn-info" onclick="Editar(<?= $fila['idcategoria'];?>)"><span class="fa fa-edit"></span> </button>
            
            <?php if($fila['estado']==1){?>
                <button class="btn btn-sm btn-warning" onclick="CambiarEstadoModal(<?= $fila['idcategoria'];?>,0,'<?= $fila['nombre'] ?>')"><span class="fa fa-ban"></span> </button>
            <?php }else{ ?>
                <button class="btn btn-sm btn-success" onclick="CambiarEstadoModal(<?= $fila['idcategoria'];?>,1,'<?= $fila['nombre'] ?>')"><span class="fa fa-check"></span> </button>
            <?php }?>
            
            <button class="btn btn-sm btn-danger" onclick="CambiarEstadoModal(<?= $fila['idcategoria'];?>,2,'<?= $fila['nombre'] ?>')"><span class="fa fa-trash"></span> </button></td>
        </tr>
        <?php }?>
    </tbody>
</table>
<script>
$("#tablaCategoria").DataTable({
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
    }).buttons().container().appendTo('#tablaCategoria_wrapper .col-md-6:eq(0)');


function Editar(idusoequipo){
    $.ajax({
        method: 'POST',
        url:    'controlador/contSubcategoria.php',
        data:{
            'proceso':'CONSULTAR',
            'idusoequipo': idusoequipo
        },
        dataType: 'json'
    }).done(function(retorno){
        $("#idusoequipo").val(retorno.idusoequipo);
        $("#idcategoria").val(retorno.idcategoria).trigger("change");
        $("#nombre").val(retorno.nombre);
        $("#estado").val(retorno.estado);

        $("#proceso").val("ACTUALIZAR");
        $("#modal-formulario").modal('show');
        $("#modal-formulario").on('hidden.bs.modal', function(e){
            $("#formulario").trigger("reset");
        })
    });
}

function CambiarEstado(idusoequipo, estado){
    $.ajax({
        method: 'POST',
        url:    'controlador/contSubcategoria.php',
        data:{
            'proceso':'CAMBIAR_ESTADO',
            'idusoequipo': idusoequipo,
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

function CambiarEstadoModal(idusoequipo,estado,nombre){
    $("#idcambiarestado").val(idusoequipo);
    $("#cambioestado").val(estado);
    texto_accion="ELIMINAR";
    if(estado==1){ texto_accion="ACTIVAR"; }
    if(estado==0){ texto_accion="ANULAR"}
    texto_accion="<b>"+texto_accion+"</b>";
    texto_accion = texto_accion + " la categoría " + nombre;
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
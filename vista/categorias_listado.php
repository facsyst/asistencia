<?php
require_once("../modelo/Categoria.php");

$objCat = new Categoria();

$listado = $objCat->listar($_POST['nombre'], $_POST['estado']);
$estados= array(0=>"ANULADO",1=>"ACTIVO");
?>
<table id="tablaCategoria" class="table table-bordered table-hover table-striped table-sm">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th>Edit</th>
            <th>Anu</th>
            <th>Elim</th>
        </tr>
    </thead>
    <tbody>
        <?php while($fila = $listado->fetch(PDO::FETCH_NAMED)){ ?>
        <tr class="<?= $fila['estado']==1?'':'text-red'?>">
            <td><?= $fila['idcategoria'] ?></td>
            <td><?= $fila['nombre'] ?></td>
            <td><?= $estados[$fila['estado']] ?></td>
            <td><button class="btn btn-sm btn-info" onclick="Editar(<?= $fila['idcategoria'];?>)"><span class="fa fa-edit"></span> Editar</button></td>
            <td>
            <?php if($fila['estado']==1){?>
                <button class="btn btn-sm btn-warning" onclick="CambiarEstadoModal(<?= $fila['idcategoria'];?>,0,'<?= $fila['nombre'] ?>')"><span class="fa fa-ban"></span> Anular</button>
            <?php }else{ ?>
                <button class="btn btn-sm btn-success" onclick="CambiarEstadoModal(<?= $fila['idcategoria'];?>,1,'<?= $fila['nombre'] ?>')"><span class="fa fa-check"></span> Activar</button>
            <?php }?>
            </td>
            <td><button class="btn btn-sm btn-danger" onclick="CambiarEstadoModal(<?= $fila['idcategoria'];?>,2,'<?= $fila['nombre'] ?>')"><span class="fa fa-trash"></span> Eliminar</button></td>
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


function Editar(idcategoria){
    $.ajax({
        method: 'POST',
        url:    'controlador/contCategoria.php',
        data:{
            'proceso':'CONSULTAR',
            'idcategoria': idcategoria
        },
        dataType: 'json'
    }).done(function(retorno){
        $("#idcategoria").val(retorno.idcategoria);
        $("#nombre").val(retorno.nombre);
        $("#estado").val(retorno.estado);

        $("#proceso").val("ACTUALIZAR");
        $("#modal-formulario").modal('show');
        $("#modal-formulario").on('hidden.bs.modal', function(e){
            $("#formulario").trigger("reset");
        })
    });
}

function CambiarEstado(idcategoria, estado){
    $.ajax({
        method: 'POST',
        url:    'controlador/contCategoria.php',
        data:{
            'proceso':'CAMBIAR_ESTADO',
            'idcategoria': idcategoria,
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

function CambiarEstadoModal(idcategoria,estado,nombre){
    $("#idcambiarestado").val(idcategoria);
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
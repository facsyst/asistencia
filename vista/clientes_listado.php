<?php
require_once("../modelo/Cliente.php");

$objClie = new Cliente();

$listado = $objClie->listar($_POST['nombre'], $_POST['nrodocumento'], $_POST['estado']);
$estados= array(0=>"ANULADO",1=>"ACTIVO");

$esbusqueda = false;
if(isset($_POST['esbusqueda'])){
    if($_POST['esbusqueda']==1){
        $esbusqueda = true;
    }
}

?>
<table id="tablaCliente" class="table table-bordered table-hover table-striped table-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>N° Doc</th>
            <th>Dirección</th>
            <th>Estado</th>
            <?php if($esbusqueda){ ?>
                <th>Seleccionar</th>
            <?php } else {?>
                <th>Edit</th>
                <th>Anu</th>
                <th>Elim</th>
            <?php }?>
        </tr>
    </thead>
    <tbody>
        <?php while($fila = $listado->fetch(PDO::FETCH_NAMED)){ ?>
        <tr class="<?= $fila['estado']==1?'':'text-red'?>">
            <td><?= $fila['idcliente'] ?></td>
            <td><?= $fila['nombre'] ?></td>
            <td><?= $fila['nrodocumento'] ?></td>
            <td><?= $fila['direccion'] ?></td>
            <td><?= $estados[$fila['estado']] ?></td>

            <?php if($esbusqueda){ ?>
                <td><button class="btn btn-sm btn-info" onclick="Seleccionar(<?= $fila['idcliente'];?>)"><span class="fa fa-edit"></span> Seleccionar</button></td>
            <?php }else{ ?>
                <td><button class="btn btn-sm btn-info" onclick="Editar(<?= $fila['idcliente'];?>)"><span class="fa fa-edit"></span> Editar</button></td>
                <td>
                <?php if($fila['estado']==1){?>
                    <button class="btn btn-sm btn-warning" onclick="CambiarEstadoModal(<?= $fila['idcliente'];?>,0,'<?= $fila['nombre'] ?>')"><span class="fa fa-ban"></span> Anular</button>
                <?php }else{ ?>
                    <button class="btn btn-sm btn-success" onclick="CambiarEstadoModal(<?= $fila['idcliente'];?>,1,'<?= $fila['nombre'] ?>')"><span class="fa fa-check"></span> Activar</button>
                <?php }?>
                </td>
                <td><button class="btn btn-sm btn-danger" onclick="CambiarEstadoModal(<?= $fila['idcliente'];?>,2,'<?= $fila['nombre'] ?>')"><span class="fa fa-trash"></span> Eliminar</button></td>
            <?php } ?>
        </tr>
        <?php }?>
    </tbody>
</table>
<script>
$("#tablaCliente").DataTable({
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
    }).buttons().container().appendTo('#tablaCliente_wrapper .col-md-6:eq(0)');

<?php if(!$esbusqueda){ ?>
function Editar(idcliente){
    $.ajax({
        method: 'POST',
        url:    'controlador/contCliente.php',
        data:{
            'proceso':'CONSULTAR',
            'idcliente': idcliente
        },
        dataType: 'json'
    }).done(function(retorno){
        $("#idcliente").val(retorno.idcliente);
        $("#nombre").val(retorno.nombre);
        $("#idtipodocumento").val(retorno.idtipodocumento);
        $("#nrodocumento").val(retorno.nrodocumento);
        $("#direccion").val(retorno.direccion);
        $("#estado").val(retorno.estado);

        $("#proceso").val("ACTUALIZAR");
        $("#modal-formulario").modal('show');
        $("#modal-formulario").on('hidden.bs.modal', function(e){
            $("#formulario").trigger("reset");
        })
    });
}

function CambiarEstado(idcliente, estado){
    $.ajax({
        method: 'POST',
        url:    'controlador/contCliente.php',
        data:{
            'proceso':'CAMBIAR_ESTADO',
            'idcliente': idcliente,
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

function CambiarEstadoModal(idcliente,estado,nombre){
    $("#idcambiarestado").val(idcliente);
    $("#cambioestado").val(estado);
    texto_accion="ELIMINAR";
    if(estado==1){ texto_accion="ACTIVAR"; }
    if(estado==0){ texto_accion="ANULAR"}
    texto_accion="<b>"+texto_accion+"</b>";
    texto_accion = texto_accion + " al cliente " + nombre;
    $("#texto_accion").html(texto_accion);
    $("#modal-confirmacion").modal('show');
    $("#modal-confirmacion").on('hidden.bs.modal', function(e){
        $("#formulario").trigger("reset");
    });
}

function CambiarEstadoConfirmacion(){
    CambiarEstado($("#idcambiarestado").val(), $("#cambioestado").val());
}

<?php } ?>
</script>
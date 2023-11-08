<?php
require_once("../modelo/Docente.php");

$objPerso = new Docente();

$listado = $objPerso->listar($_POST['nombre'], $_POST['nrodocumento'], $_POST['estado']);
$estados= array(0=>"ANULADO",1=>"ACTIVO");

$esbusqueda = false;
if(isset($_POST['esbusqueda'])){
    if($_POST['esbusqueda']==1){
        $esbusqueda = true;
    }
}

?>
<table id="tablaPersonal" class="table table-bordered table-hover table-striped table-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>T.Doc</th>
            <th>N° Doc</th>
            <th>Celular</th>
            <th>Email</th>
            <th>Estado</th>
            <?php if($esbusqueda){ ?>
                <th>Seleccionar</th>
            <?php } else {?>
                <th>Opciones</th>
        
            <?php }?>
        </tr>
    </thead>
    <tbody>
        <?php while($fila = $listado->fetch(PDO::FETCH_NAMED)){ ?>
        <tr class="<?= $fila['estado']==1?'':'text-red'?>">
            <td><?= $fila['iddocente'] ?></td>
            <td><?= $fila['nombre'] ?></td>
            <td><?= $fila['tipodoc'] ?></td>
            <td><?= $fila['nrodocumento'] ?></td>
            <td><?= $fila['celular'] ?></td>
            <td><?= $fila['email'] ?></td>
            <td><?= $estados[$fila['estado']] ?></td>

            <?php if($esbusqueda){ ?>
                <td><button class="btn btn-sm btn-info" onclick="Seleccionar(<?= $fila['iddocente'];?>)"><span class="fa fa-edit"></span> Seleccionar</button></td>
            <?php }else{ ?>
                <td><button class="btn btn-sm btn-info" onclick="Editar(<?= $fila['iddocente'];?>)"><span class="fa fa-edit"></span> </button>
                
                <?php if($fila['estado']==1){?>
                    <button class="btn btn-sm btn-warning" onclick="CambiarEstadoModal(<?= $fila['iddocente'];?>,0,'<?= $fila['nombre'] ?>')"><span class="fa fa-ban"></span> </button>
                <?php }else{ ?>
                    <button class="btn btn-sm btn-success" onclick="CambiarEstadoModal(<?= $fila['iddocente'];?>,1,'<?= $fila['nombre'] ?>')"><span class="fa fa-check"></span> </button>
                <?php }?>
                
                <button class="btn btn-sm btn-danger" onclick="CambiarEstadoModal(<?= $fila['iddocente'];?>,2,'<?= $fila['nombre'] ?>')"><span class="fa fa-trash"></span> </button></td>
            <?php } ?>
        </tr>
        <?php }?>
    </tbody>
</table>
<script>
$("#tablaPersonal").DataTable({
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
    }).buttons().container().appendTo('#tablaPersonal_wrapper .col-md-6:eq(0)');

<?php if(!$esbusqueda){ ?>
function Editar(iddocente){
    $.ajax({
        method: 'POST',
        url:    'controlador/contDocente.php',
        data:{
            'proceso':'CONSULTAR',
            'iddocente': iddocente
        },
        dataType: 'json'
    }).done(function(retorno){
        $("#iddocente").val(retorno.iddocente);
        $("#nombre").val(retorno.nombre);
        $("#idtipodocumento").val(retorno.idtipodocumento).trigger("change");
        $("#nrodocumento").val(retorno.nrodocumento);
        $("#celular").val(retorno.celular);
        $("#email").val(retorno.email);
        $("#estado").val(retorno.estado);

        $("#proceso").val("ACTUALIZAR");
        $("#modal-formulario").modal('show');
        $("#modal-formulario").on('hidden.bs.modal', function(e){
            $("#formulario").trigger("reset");
        })
    });
}

function CambiarEstado(iddocente, estado){
    $.ajax({
        method: 'POST',
        url:    'controlador/contDocente.php',
        data:{
            'proceso':'CAMBIAR_ESTADO',
            'iddocente': iddocente,
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

function CambiarEstadoModal(iddocente,estado,nombre){
    $("#idcambiarestado").val(iddocente);
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
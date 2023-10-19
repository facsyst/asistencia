<?php
require_once("../modelo/Producto.php");

$objPro = new Producto();

$listado = $objPro->listar($_POST['nombre'], $_POST['estado']);
$estados= array(0=>"ANULADO",1=>"ACTIVO");
?>
<style>
    .imagen_zoom:hover{
        width: 200px;
        height: 200px;
        display: block;
    }
</style>
<table id="tablaProducto" class="table table-bordered table-hover table-striped table-sm">
    <thead>
        <tr>
            <th>Código</th>
            <th>IMG</th>
            <th>Nombre</th>
            <th>PV</th>
            <th>PC</th>
            <th>Estado</th>
            <th>Img</th>
            <th>Edit</th>
            <th>Anu</th>
            <th>Elim</th>
        </tr>
    </thead>
    <tbody>
        <?php while($fila = $listado->fetch(PDO::FETCH_NAMED)){ ?>
        <tr class="<?= $fila['estado']==1?'':'text-red'?>">
            <td><?= $fila['idproducto'] ?></td>
            <td><img src="<?= $fila['urlimagen'] ?>" width="40px" height="40px" style="cursor:pointer" onclick="VerImagen('<?= $fila['urlimagen'] ?>')" /></td>
            <td><?= $fila['nombre'] ?></td>
            <td><?= $fila['pventa'] ?></td>
            <td><?= $fila['pcompra'] ?></td>
            <td><?= $estados[$fila['estado']] ?></td>
            <td><button class="btn btn-sm bg-navy" onclick="SubirImagen(<?= $fila['idproducto'];?>)"><span class="fa fa-image"></span></button></td>
            <td><button class="btn btn-sm btn-info" onclick="Editar(<?= $fila['idproducto'];?>)"><span class="fa fa-edit"></span> Editar</button></td>
            <td>
            <?php if($fila['estado']==1){?>
                <button class="btn btn-sm btn-warning" onclick="CambiarEstadoModal(<?= $fila['idproducto'];?>,0,'<?= $fila['nombre'] ?>')"><span class="fa fa-ban"></span> Anular</button>
            <?php }else{ ?>
                <button class="btn btn-sm btn-success" onclick="CambiarEstadoModal(<?= $fila['idproducto'];?>,1,'<?= $fila['nombre'] ?>')"><span class="fa fa-check"></span> Activar</button>
            <?php }?>
            </td>
            <td><button class="btn btn-sm btn-danger" onclick="CambiarEstadoModal(<?= $fila['idproducto'];?>,2,'<?= $fila['nombre'] ?>')"><span class="fa fa-trash"></span> Eliminar</button></td>
        </tr>
        <?php }?>
    </tbody>
</table>
<script>
$("#tablaProducto").DataTable({
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
    }).buttons().container().appendTo('#tablaProducto_wrapper .col-md-6:eq(0)');

modoEdicion = false;
idsubcategoria = 0;
function Editar(idproducto){
    $.ajax({
        method: 'POST',
        url:    'controlador/contProducto.php',
        data:{
            'proceso':'CONSULTAR',
            'idproducto': idproducto
        },
        dataType: 'json'
    }).done(function(retorno){
        modoEdicion = true;
        $("#idproducto").val(retorno.idproducto);
        $("#nombre").val(retorno.nombre);
        $("#codigobarra").val(retorno.codigobarra);
        $("#pventa").val(retorno.pventa);
        $("#pcompra").val(retorno.pcompra);
        $("#stock").val(retorno.stock);
        $("#stockseguridad").val(retorno.stockseguridad);
        $("#idunidad").val(retorno.idunidad);
        idsubcategoria = retorno.idsubcategoria;
        $("#idcategoria").val(retorno.idcategoria).trigger("change");
        $("#idafectacion").val(retorno.idafectacion);
        $("#afectoicbper").val(retorno.afectoicbper);
        $("#estado").val(retorno.estado);
        $("#urlimagen").val(retorno.urlimagen);

        $("#proceso").val("ACTUALIZAR");
        $("#modal-formulario").modal('show');
        $("#modal-formulario").on('hidden.bs.modal', function(e){
            $("#formulario").trigger("reset");
            $("#idcategoria").val("").trigger("change");
            $("#idsubcategoria").val("").trigger("change");
        })
    });
}

function CambiarEstado(idproducto, estado){
    $.ajax({
        method: 'POST',
        url:    'controlador/contProducto.php',
        data:{
            'proceso':'CAMBIAR_ESTADO',
            'idproducto': idproducto,
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

function CambiarEstadoModal(idproducto,estado,nombre){
    $("#idcambiarestado").val(idproducto);
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

function SubirImagen(idproducto){
    
    $.ajax({
        method: 'POST',
        url:  'controlador/contProducto.php',
        data:{
            'proceso':'CONSULTAR',
            'idproducto': idproducto
        },
        dataType: 'json'
    }).done(function(retorno){
        modoEdicion = true;
        $("#img_idproducto").val(retorno.idproducto);
        $("#img_nombre").val(retorno.nombre);
        $("#img_urlimagen").val(retorno.urlimagen);
        $("#img_proceso").val("SUBIR_IMAGEN");

        $("#uploadFile").fileinput({
            language: 'es',
            showRemove: false,
            uploadAsync: true,
            uploadExtraData: {
                proceso: 'SUBIR_IMAGEN', 
                idproducto: $("#img_idproducto").val()
            },
            uploadUrl: 'controlador/contProducto.php',
            maxFileCount: 1,
            autoReplace: true, 
            allowedFileExtensions: ['jpg','png']
        }).on('fileuploaded', function(event, data, id, index) {
            $("#modal-imagen").modal('hide');
            Buscar();   
            $("#uploadFile").fileinput('destroy');
        });

        $("#modal-imagen").modal('show');
        $("#modal-imagen").on('hidden.bs.modal', function(e){
            $("#img_formulario").trigger("reset");
        })
    });    
}

function VerImagen(urlImagen){
    srcImagen="<img src='"+urlImagen+"' class='img-thumbnail' />";
    
    $("#divImagenVisualizar").html(srcImagen);
    $("#modal-visor-imagen").modal('show');
    $("#modal-visor-imagen").on('hidden.bs.modal', function(e){
        $("#divImagenVisualizar").html("");
    })
}
</script>
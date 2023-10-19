<?php 
require_once("../modelo/Producto.php");
require_once("../modelo/Categoria.php");

$objPro = new Producto();
$unidades = $objPro->consultarUnidad();
$afectaciones = $objPro->consultarAfectacion();

$objCat = new Categoria();
$categorias = $objCat->listar("",1);


?>
<section class="content mt-2">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Productos</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Nombre</span>
                        </div>
                        <input type="text" class="form-control" id="txtBusquedaNombre" name="txtBusquedaNombre" onkeyup="Buscar()" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Estado</span>
                        </div>
                        <select class="form-control" id="cboBusquedaEstado" name="cboBusquedaEstado" onchange="Buscar()">
                            <option value="">- Todos -</option>
                            <option value="1">Activos</option>
                            <option value="0">Anulado</option>
                        </select>
                    </div>                
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary" onclick="Buscar()"><span class="fa fa-search"></span> Buscar</button> 
                    <button type="button" class="btn btn-success" onclick="Nuevo()"><span class="fa fa-plus"></span> Nuevo</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Resultados de la búsqueda</h3>
    </div>
    <div class="card-body">
        <div id="divResultadoBusqueda">
        </div>
    </div>
</div>

<div class="modal fade" id="modal-formulario">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header bg-primary">
            <h4 class="modal-title">Producto</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formulario">
                <div class="row">
                    <div class="col-md-4">                    
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control required" id="nombre" name="nombre" />
                            <input type="hidden" id="idproducto" name="idproducto" value="0" />
                            <input type="hidden" id="proceso" name="proceso" value="" />
                        </div>
                        <div class="form-group">
                            <label>Código de Barra</label>
                            <input type="text" class="form-control" id="codigobarra" name="codigobarra" />
                        </div>
                        <div class="form-group">
                            <label>Precio de Venta</label>
                            <input type="text" class="form-control required" id="pventa" name="pventa" />
                        </div>   
                        <div class="form-group">
                            <label>Precio de Compra</label>
                            <input type="text" class="form-control" id="pcompra" name="pcompra" />
                        </div>    
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" />
                        </div>
                        <div class="form-group">
                            <label>Stock de Seguridad</label>
                            <input type="number" class="form-control" id="stockseguridad" name="stockseguridad" />
                        </div>
                        <div class="form-group">
                            <label>Unidad</label>
                            <select class="form-control required" id="idunidad" name="idunidad">
                                <option value="">- Seleccione uno-</option>
                                <?php while($fila=$unidades->fetch(PDO::FETCH_NAMED)){?>
                                    <option value="<?= $fila['idunidad']?>"><?= $fila['descripcion']?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" id="urlimagen" name="urlimagen" value="" />
                        </div> 
                        <div class="form-group">
                            <label>Afectación IGV</label>
                            <select class="form-control required" id="idafectacion" name="idafectacion">
                                <option value="">- Seleccione uno-</option>
                                <?php while($fila=$afectaciones->fetch(PDO::FETCH_NAMED)){?>
                                    <option value="<?= $fila['idafectacion']?>"><?= $fila['descripcion']?></option>
                                <?php } ?>
                            </select>
                        </div>                                                               
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Categoria</label>
                            <select class="form-control select2bs4 required" style="width: 100%;" id="idcategoria" name="idcategoria" onchange="ConsultarSubCategoria()">
                                <option value="">- Seleccione uno-</option>
                                <?php while($fila=$categorias->fetch(PDO::FETCH_NAMED)){?>
                                    <option value="<?= $fila['idcategoria']?>"><?= $fila['nombre']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sub-Categoria</label>
                            <select class="form-control select2bs4" style="width: 100%;" id="idsubcategoria" name="idsubcategoria">
                                <option value="">- Seleccione uno-</option>                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Afecto al ICBPER</label>
                            <select class="form-control" id="afectoicbper" name="afectoicbper">
                                <option value="0">NO</option>  
                                <option value="1">SI</option>                                
                            </select>
                        </div>                                                                                                                  
                        <div class="form-group">
                            <label>Estado</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="1">Activo</option>
                                <option value="0">Anulado</option>
                            </select>
                        </div>                                     
                    </div>
                </div>
            <form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="Guardar()">Guardar</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-imagen">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header bg-primary">
            <h4 class="modal-title">Producto</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="img_formulario">
                <div class="row">
                    <div class="col-md-12">                    
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" id="img_nombre" name="nombre" disabled />
                            <input type="hidden" id="img_idproducto" name="idproducto" value="0" />
                            <input type="hidden" id="img_proceso" name="proceso" value="" />
                        </div>
                        <div class="form-group">
                            <label>URL Imagen</label>
                            <input type="text" class="form-control" id="img_urlimagen" name="urlimagen" disabled />
                        </div> 
                        <form enctype="multipart/form-data">
                            <input name="uploadFile" id="uploadFile" class="file-loading" type="file" multiple data-min-file-count="1">
                        </form>            
                    </div>
                </div>
            <form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="GuardarImagen()">Guardar</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-visor-imagen">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header bg-primary">
            <h4 class="modal-title">Imagen de Producto</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" id="divImagenVisualizar" align="center">                    
                        
                    </div>
                </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



    <div class="modal fade" id="modal-confirmacion">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header bg-danger">
            <h5 class="modal-title">Confirmación</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formulario">
                <div class="row">
                    <div class="col-md-12">                    
                        <center><h4>¿Está seguro de <span id='texto_accion'></span>?</h4></center>
                        <input type="hidden" id="idcambiarestado" value="0" />
                        <input type="hidden" id="cambioestado" value="" />                                       
                    </div>
                </div>
            <form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="CambiarEstadoConfirmacion()">Confirmar</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</section>
<script>
$("#idcategoria").select2({
    theme: 'bootstrap4'
});
$("#idsubcategoria").select2({
    theme: 'bootstrap4'
});

function Buscar(){
    $.ajax({
        method: "POST",
        url: "vista/productos_listado.php",
        data:{
            nombre: $("#txtBusquedaNombre").val(),
            estado: $("#cboBusquedaEstado").val()
        }
    }).done(function(resultado){
        $("#divResultadoBusqueda").html(resultado);
    });
}

Buscar();

function Nuevo(){
    $("#proceso").val("NUEVO");
    $("#urlimagen").val("");
    $("#modal-formulario").modal('show');
    $("#modal-formulario").on('hidden.bs.modal', function(e){
        $("#formulario").trigger("reset");
        $("#idcategoria").val("").trigger("change");
        $("#idsubcategoria").val("").trigger("change");
    })
}

function Guardar(){
    if(ValidarFormulario()){
        datax = $("#formulario").serializeArray();
        $.ajax({
            method: "POST",
            url: "controlador/contProducto.php",
            data: datax,
            dataType: 'json'
        }).done(function(resultado){
            if(resultado.correcto){
                $("#modal-formulario").modal('hide');
                Buscar();
                toastCorrecto(resultado.mensaje);
            }else{
                toastError(resultado.mensaje);
            }
        });
    }else{
        toastError("Existe errores en tu formulario.");
    }
}

function ValidarFormulario(){
    retorno = true;    
    $(".required").each(function(){
        $(this).removeClass("is-invalid");
        if($(this).val()=="" || $(this).val()=="0"){
            $(this).addClass("is-invalid");
            retorno = false;
        }
    });

    if($("#nombre").val().includes("#")){
        $("#nombre").addClass("is-invalid");
        retorno = false;
    }

    if($("#nombre").val().length<5){
        $("#nombre").addClass("is-invalid");
        retorno = false;
    }

    return retorno;
}

function ConsultarSubCategoria(){
    $.ajax({
        method: "POST",
        url: "controlador/contSubCategoria.php",
        data: {
            "proceso": "CONSULTAR_POR_CATEGORIA",
            "idcategoria": $("#idcategoria").val()
        },
        dataType: 'json'
    }).done(function(resultado){
        combo='<option value="">- Seleccione uno -</option>';
        for(i=0; i<resultado.length; i++){
            combo=combo+'<option value="'+resultado[i].idsubcategoria+'">'+resultado[i].nombre+'</option>';
        }
        $("#idsubcategoria").html(combo);
        if(modoEdicion){
            $("#idsubcategoria").val(idsubcategoria).trigger("change");
        }else{
            $("#idsubcategoria").val("").trigger("change");;
        }
        modoEdicion = false;
    });
}

</script>
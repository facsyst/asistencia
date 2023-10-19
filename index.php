<?php 
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<style>
.fondo-imagen{
    background: url(imagenes/farmacia.jpg);
    background-position: center;
    background-size: cover;
}
</style>
<body class="hold-transition login-page fondo-imagen">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><b>Sistema</b>POS</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Ingresar al sistema</p>

      <form action="" method="post" onsubmit="return false">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Usuario" id="user">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Clave" id="clave">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="button" class="btn btn-primary btn-block" onclick="IngresarSistema()">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-12 text-center text-danger" id="divError">
                
            </div> 
        </div>
      </form>
      <!-- /.social-auth-links -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
<script>
function IngresarSistema(){
    $.ajax({
        method: "POST",
        url: "controlador/contUsuario.php",
        data:{
            proceso: "LOGIN",
            user: $("#user").val(),
            clave: $("#clave").val()
        },
        dataType: "json"
    }).done(function(resultado){
        if(resultado.correcto==1){
            window.open(resultado.url,"_self");
        }else{
            $("#divError").html(resultado.mensaje);
        }
    });
}
</script>
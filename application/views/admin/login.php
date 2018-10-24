<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema de Compras y Ventas | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <!--CSS LOGIN-->
 <link rel="stylesheet" href="<?php echo base_url();?>assets/template/andrejmlinarevic/css/andrejmlinarevic.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/template/sweetalert/sweetalert.css">
 
  <script src="<?php echo base_url();?>assets/template/sweetalert/sweetalert.min.js"></script>
</head>
<body>

<div class="container">
  <div class="profile">
    <button class="profile__avatar" id="toggleProfile">
     <img src="<?php echo base_url();?>img/cloud.png" alt="Avatar" /> 
    </button>
    <div class="profile__form">
      <div class="profile__fields">
        <form action="<?php echo base_url();?>Auth/login" method="POST" id="form-login">
          <div class="field">
            <input type="text" name="username" id="fieldUser" class="input" required pattern=.*\S.* />
            <label for="fieldUser" class="label">Usuario</label>
          </div>
          <div class="field">
            <input type="password" name="password" id="fieldPassword" class="input" required pattern=.*\S.* />
            <label for="fieldPassword" class="label">Contraseña</label>
          </div>
          <div class="profile__footer">
            <button type="submit" class="btn">Login</button>
          </div>
          <p align="center"><small>Proyecto de Tesis UMG</small></p>    
     
        </form>
      </div>
     </div>
     
  </div>
</div>


<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/template/jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/template/bootstrap/js/bootstrap.min.js"></script>
<script>
  base_url = "<?php echo base_url();?>";
  $("#form-login").submit(function(e){
    e.preventDefault();

    data = $(this).serialize();
    url = $(this).attr("action");


    $.ajax({
      url : url,
      type: "POST",
      data: data,
      success:function(resp){


        if (resp == "0") {

            swal({
                title: "Error",
                text: "El usuario y/o contraseña no son válidos",
                timer: 2000,
                showConfirmButton: false,
                type: 'error'
            });
                           
        }
        else{
          swal({
                title: "Autenticado",
                text: "Iniciando sesion...",
                timer: 3000,
                showConfirmButton: false,
                type: 'success'
            });
          window.location.href = base_url + "dashboard";
        }
      }
    });
  });
  /* Simple VanillaJS to toggle class */

  document.getElementById('toggleProfile').addEventListener('click', function () {
    [].map.call(document.querySelectorAll('.profile'), function(el) {
      el.classList.toggle('profile--open');
    });
  });
</script>

</body>
</html>

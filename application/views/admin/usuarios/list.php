
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Usuarios
        <small>Listado</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php if($permisos->insert == 1):?>
                        <a href="<?php echo base_url();?>administrador/usuarios/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Usuario</a>
                        <?php endif;?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>
                                    <th>Usuario</th>
                                    <th>Rol</th>
                                    <th>Cambiar Contraseña</th>
                                    <th>opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($usuarios)):?>
                                    <?php foreach($usuarios as $usuario):?>
                                        <tr>
                                            <td><?php echo $usuario->id;?></td>
                                            <td><?php echo $usuario->nombres;?></td>
                                            <td><?php echo $usuario->apellidos;?></td>
                                            <td><?php echo $usuario->email;?></td>
                                            <td><?php echo $usuario->username;?></td>
                                            <td><?php echo $usuario->rol;?></td>
                                            <td><button id="change-password" type="buttton" value="<?php echo $usuario->id;?>" class="btn btn-default" data-toggle="modal" data-target="#modal-password"><i class="fa fa-cogs"></i> Cambiar Contraseña</button></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-view-usuario" data-toggle="modal" data-target="#modal-default" value="<?php echo $usuario->id;?>">
                                                        <span class="fa fa-search"></span>
                                                    </button>
                                                    <?php if($permisos->update == 1):?>
                                                    <a href="<?php echo base_url()?>administrador/usuarios/edit/<?php echo $usuario->id;?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                    <?php endif;?>
                                                    <?php if($permisos->delete == 1):?>
                                                    <a href="<?php echo base_url();?>administrador/usuarios/delete/<?php echo $usuario->id;?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
                                                    <?php endif;?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion del Usuario</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-password">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cambio de Contraseña</h4>
      </div>
      <form action="#" method="POST" id="form-change-password">
      <div class="modal-body">
        <input type="hidden" name="idusuario">
        <div class="error"></div>
        <div class="form-group">
            <label for="">Nueva Contraseña:</label>
            <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="Nueva Contraseña" required>
        </div>
        <div class="form-group">
            <label for="">Repetir Nueva Contraseña:</label>
            <input type="password" class="form-control" name="repeatpassword" id="newpassword" placeholder="Repetir Nueva Contraseña" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

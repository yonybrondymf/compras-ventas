<?php if ($this->session->flashdata("success")): ?>
    <script>
        swal("Registro Guardado!","<?php echo $this->session->flashdata("success"); ?>", "success");
    </script>
<?php endif ?>
<?php if ($this->session->flashdata("error")): ?>
    <script>
        swal("Error al Registrar!", "Haz click en el botón para volver intentarlo.", "error");
    </script>
<?php endif ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Mesas
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
                        <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-default"><span class="fa fa-plus"></span> Agregar Mesa</button>
                        <?php endif;?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-9">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    
                                    <th>Numero</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                        
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($mesas)):?>
                                    <?php $i=1;?>
                                    <?php foreach($mesas as $mesa):?>
                                        <tr>
                                           
                                            <td><?php echo $mesa->numero;?></td>
                                         
                                            <td>
                                                <?php if($mesa->estado == 0):?>
                                                <div class="btn-group">
                                                     <span class="label label-danger">Ocupada</span>
                                                     <?php else:?>
                                                         <span class="label label-success">Disponible</span>
                                                     <?php endif;?>
                                                </div>
                                            </td>
                                            <td>
                                                <?php if($mesa->estado == 1):?>
                                                    <button type="button" class="btn btn-warning btn-edit-mesa" data-toggle="modal" data-target="#modal-default" value="<?php echo $mesa->id?>">
                                                        <span class="fa fa-pencil"></span>
                                                    </button>
                                                    <a href="<?php echo base_url();?>mantenimiento/mesas/delete/<?php echo $mesa->id?>" class="btn btn-danger btn-delete">
                                                        <span class="fa fa-times"></span>
                                                    </a>
                                                <?php endif;?>
                                            </td>
                                        </tr>
                                        <?php $i++;?>
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
        <h4 class="modal-title">Informacion de la Mesa</h4>
      </div>
      <form action="<?php echo base_url();?>mantenimiento/mesas/store" method="POST">
      <div class="modal-body">
        <div class="form-group">
            <label for="numero">Numero:</label>
            <input type="text" name="numero" id="numero" class="form-control" required="required">
            <input type="hidden" name="idMesa" id="idMesa">
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

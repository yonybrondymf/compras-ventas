
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Logs
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
                        <div class="table-responsive">
                        <table id="tbusuario" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Módulo</th>
                                    <th>Actividad</th>
                                    <th>Usuario</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($logs as $log): ?>
                                    <tr>
                                        <td><?php echo $log->id?></td>
                                        <td><?php echo $log->modulo;?></td>
                                        <td><?php echo $log->accion;?></td>
                                        <td><?php echo $log->email?></td>
                                        <td><?php echo $log->fecha?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                       </div>
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
        <h4 class="modal-title">Informacion de la Marca</h4>
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

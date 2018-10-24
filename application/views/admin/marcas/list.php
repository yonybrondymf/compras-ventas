
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Marcas
        <small>Listado</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <input type="hidden" id="modulo" value="marcas">
                <div class="row">
                    <div class="col-md-12">
                        <?php if($permisos->insert == 1):?>
                        <a href="<?php echo base_url();?>mantenimiento/marcas/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Marca</a>
                        <?php endif;?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($marcas)):?>
                                    <?php foreach($marcas as $marca):?>
                                        <tr>
                                            <td><?php echo $marca->id;?></td>
                                            <td><?php echo $marca->nombre;?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-view" data-toggle="modal" data-target="#modal-default" value="<?php echo $marca->id;?>">
                                                        <span class="fa fa-search"></span>
                                                    </button>
                                                    <?php if($permisos->update == 1):?>
                                                    <a href="<?php echo base_url()?>mantenimiento/marcas/edit/<?php echo $marca->id;?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                    <?php endif;?>
                                                    <?php if($permisos->delete == 1):?>
                                                    <a href="<?php echo base_url();?>mantenimiento/marcas/delete/<?php echo $marca->id;?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
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

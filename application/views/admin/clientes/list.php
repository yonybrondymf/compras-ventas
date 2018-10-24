
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Clientes
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
                        <a href="<?php echo base_url();?>mantenimiento/clientes/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Clientes</a>
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
                                    <th>Direccion</th>
                                    <th>Telefono</th>
                                    <th>Tipo de Contribuyente</th>
                                    <th>Documento</th>
                                    <th>No. Documento</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($clientes)):?>
                                    <?php foreach($clientes as $cliente):?>
                                        <tr>
                                            <td><?php echo $cliente->id;?></td>
                                            <td><?php echo $cliente->nombre;?></td>
                                            <td><?php echo $cliente->direccion;?></td>
                                            <td><?php echo $cliente->telefono;?></td>
                                            <td><?php echo $cliente->tipocontribuyente;?></td>
                                            <td><?php echo $cliente->tipodocumento;?></td>
                                            
                                            <td><?php echo $cliente->num_documento;?></td>
                                            <?php $datacliente = $cliente->id."*".$cliente->nombre."*".$cliente->direccion."*".$cliente->telefono."*".$cliente->tipocontribuyente."*".$cliente->tipodocumento."*".$cliente->num_documento;?>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-view-cliente" data-toggle="modal" data-target="#modal-default" value="<?php echo $datacliente?>">
                                                        <span class="fa fa-search"></span>
                                                    </button>
                                                    
                                                    <?php if($permisos->update == 1):?>
                                                    <a href="<?php echo base_url()?>mantenimiento/clientes/edit/<?php echo $cliente->id;?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                    <?php endif;?>
                                                    <?php if($permisos->delete == 1):?>
                                                    <a href="<?php echo base_url();?>mantenimiento/clientes/delete/<?php echo $cliente->id;?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
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
        <h4 class="modal-title">Informacion de la Categoria</h4>
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

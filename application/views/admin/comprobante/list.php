
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Comprobantes
        <small>Listado</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <input type="hidden" id="modulo" value="comprobante">
                <div class="row">
                    <div class="col-md-12">
                        <?php if($permisos->insert == 1):?>
                        <a href="<?php echo base_url();?>mantenimiento/comprobante/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Comprobante</a>
                        <?php endif;?>
                    </div>
                </div>
                <br>
                <div class="callout callout-success">
                    <h4>Comprobante Predeterminado</h4>
                    <?php if ($comprobantePredeterminado): ?>
                        <p>
                            <strong>
                                <?php echo ucfirst($comprobantePredeterminado->nombre);?>    
                            </strong>
                            ha sido seleccionado como el  comprobante predeterminado para registro de nueva venta. Si deseas cambiar de comprobante has clic en el boton Actualizar <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-predeterminado">Actualizar</button>
                        </p>
                    <?php else: ?>
                        <p>Aún no se ha establecido el comprobante predeterminado para el registro de ventas. Para establecerlo has clic en el siguiente boton <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-predeterminado">Actualizar</button></p>
                    <?php endif ?>
                    
                  </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>IVA</th>
                                    <th>Serie</th>
                                    <th>Fecha de Registro</th>
                                    <th>No. Inicial</th>
                                    <th>No. Final</th>
                                    <th>Resolucion</th>
                                    <th>Fecha de Resolucion</th>
                                    <th>Predeterminado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($comprobantes)):?>
                                    <?php foreach($comprobantes as $comprobante):?>
                                        <tr>
                                            <td><?php echo $comprobante->id;?></td>
                                            <td><?php echo $comprobante->nombre;?></td>
                                            <td><?php echo $comprobante->iva;?></td>
                                            <td><?php echo $comprobante->serie;?></td>
                                            <td><?php echo $comprobante->fecha_registro;?></td>
                                            <td><?php echo $comprobante->no_inicial;?></td>
                                            <td><?php echo $comprobante->no_final;?></td>
                                            <td><?php echo $comprobante->resolucion;?></td>
                                            <td><?php echo $comprobante->fecha_resolucion;?></td>
                                            <td><?php echo $comprobante->predeterminado ==1? 'SI':'NO';?></td>
                                            

                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-view" data-toggle="modal" data-target="#modal-default" value="<?php echo $comprobante->id;?>">
                                                        <span class="fa fa-search"></span>
                                                    </button>
                                                    <?php if($permisos->update == 1):?>
                                                    <a href="<?php echo base_url()?>mantenimiento/comprobante/edit/<?php echo $comprobante->id;?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                    <?php endif;?>
                                                    <?php if($permisos->delete == 1):?>
                                                    <a href="<?php echo base_url();?>mantenimiento/comprobante/delete/<?php echo $comprobante->id;?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
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
        <h4 class="modal-title">Informacion del Comprobante</h4>
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

<div class="modal fade" id="modal-predeterminado">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Selección del comprobante predeterminado</h4>
      </div>
      <form action="<?php echo base_url();?>mantenimiento/comprobante/setPredeterminado" method="POST">
      <div class="modal-body">
        <div class="form-group">
            <label for="comprobante">Comprobantes</label>
            <select name="comprobante" id="comprobante" class="form-control" required="required">
                <option value="">Seleccione...</option>
                <?php foreach ($comprobantes as $comprobante): ?>
                    <option value="<?php echo $comprobante->id;?>" <?php echo $comprobante->predeterminado ==1 ? 'selected':'';?>><?php echo $comprobante->nombre;?></option>
                <?php endforeach ?>
            </select>
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


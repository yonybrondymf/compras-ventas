
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Reportes
        <small>Productos Vendidos</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <form action="<?php echo current_url();?>" method="POST" class="form-horizontal">
                        <div class="form-group">
                            <label for="" class="col-md-1 control-label">Desde:</label>
                            <div class="col-md-3">
                                <input type="date" class="form-control" name="fechainicio" value="<?php echo !empty($fechainicio) ? $fechainicio:date("Y-m-d");?>">
                            </div>
                            <label for="" class="col-md-1 control-label">Hasta:</label>
                            <div class="col-md-3">
                                <input type="date" class="form-control" name="fechafin" value="<?php  echo !empty($fechafin) ? $fechafin:date("Y-m-d");?>">
                            </div>
                            <div class="col-md-4">
                                <input type="submit" name="buscar" value="Buscar" class="btn btn-primary">
                                <a href="<?php echo base_url(); ?>reportes/productos" class="btn btn-danger">Restablecer</a>
                            </div>
                        </div>
                    </form>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <table id="inventario-productos" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Producto </th>
                                    <th>Stock</th>
                                    <th>Vendidos</th>
                                    <th>Precio</th>
                                    <th>Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($productos)): ?>
                                    <?php foreach($productos as $p):?>
                                        <tr>
                                            <td><?php echo $p->nombre;?></td>
                                            
                                            <td><?php echo $p->stock;?></td>
                                            
                                           
                                            <td><?php echo $p->totalVendidos;?></td>
                                            <td><?php echo $p->precio;?></td>
                                            <td><?php echo number_format($p->precio * $p->totalVendidos, 2, '.', '');?></td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif ?>
                            </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="4" style="text-align:right">Total:</th>
                                    <th></th>
                                </tr>
                            </tfoot>
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

<div class="modal fade" id="modal-venta">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion de la venta</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-print"><span class="fa fa-print"> </span>Imprimir</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

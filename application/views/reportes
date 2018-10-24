
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Inventario de Productos
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
                        <table id="inventario" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                   
                                    <th>Stock</th>
                                    <th>Categoria</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($productos)):?>
                                    <?php foreach($productos as $producto):?>
                                        <tr>
                                            <td><?php echo $producto->id;?></td>
                                            <td><?php echo $producto->codigo;?></td>
                                            <td><?php echo $producto->nombre;?></td>
                                            <td><?php echo $producto->precio;?></td>
                                            <?php if($producto->condicion == "1"):?>
                                                
                                                <?php if ($producto->stock <= $producto->stock_minimo): ?>
                                                    <td style="color: red;"><b><?php echo $producto->stock;?></b></td>
                                                <?php else:?>
                                                    <td style="color: green;"><b><?php echo $producto->stock;?></b></td>
                                                <?php endif ?>
                                                
                                            <?php else: ?>
                                                
                                                <td>N/A</td>
                                            <?php endif;?>

                                            <td><?php echo $producto->categoria;?></td>
                                            
                                         
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

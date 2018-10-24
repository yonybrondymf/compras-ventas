
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Productos
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
                        <a href="<?php echo base_url();?>mantenimiento/productos/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Productos</a>
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
                                    <th>Cod. Barras</th>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Marca</th>
                                    <th>Presentacion</th>
                                   
                                    <th>Precio</th>
                                    <th>Precio de Compra</th>
                                    <th>Stock Min.</th>
                                    <th>Stock</th>
                                    
                                    <th>Categoria</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($productos)):?>
                                    <?php foreach($productos as $producto):?>
                                        <tr>
                                            <td><?php echo $producto->id;?></td>
                                             <!--echo img(array('src'=>'image/picture.jpg', 'alt'=> 'alt information')); -->
                                            <td>
                                                <img src="<?php echo base_url().'assets/barcode/'.$producto->codigo_barras.".png";?>" alt="">
                                            </td>
                                            <td><img src="<?php echo base_url().'assets/imagenes_productos/'.$producto->imagen?>" alt="<?php echo $producto->nombre?>" style="width: 100px; " class="img-responsive"></td>           
                                            <td><?php echo $producto->nombre;?></td>
                                            <td><?php echo $producto->marca;?></td>
                                            <td><?php echo $producto->presentacion;?></td>
                                            
                                            <td><?php echo $producto->precio;?></td>
                                            <td><?php echo $producto->precio_compra;?></td>
                                            
                                                <td><?php echo $producto->stock_minimo;?></td>
                                                <?php if ($producto->stock <= $producto->stock_minimo): ?>
                                                    <td style="color: red;"><b><?php echo $producto->stock;?></b></td>
                                                <?php else:?>
                                                    <td style="color: green;"><b><?php echo $producto->stock;?></b></td>
                                                <?php endif ?>
                                                
                                            
                                            <td><?php echo $producto->categoria;?></td>
                                            <td>
                                                <div class="btn-group-vertical">
                                                    <button type="button" class="btn btn-default btn-view-barcode" data-toggle="modal" data-target="#modal-barcode" value="<?php echo $producto->codigo_barras;?>">
                                                        <span class="fa fa-barcode"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-info btn-view-producto" data-toggle="modal" data-target="#modal-default" value="<?php echo $producto->id;?>">
                                                        <span class="fa fa-search"></span>
                                                    </button>
                                                    <?php if($permisos->update == 1):?>
                                                    <a href="<?php echo base_url()?>mantenimiento/productos/edit/<?php echo $producto->id;?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                    <?php endif;?>
                                                    <?php if($permisos->delete == 1):?>
                                                    <a href="<?php echo base_url();?>mantenimiento/productos/delete/<?php echo $producto->id;?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
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
        <h4 class="modal-title">Informacion del Producto</h4>
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

<div class="modal fade" id="modal-barcode">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Codigo de Barras</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-print-barcode"> 
            <span class="fa fa-print"></span>
        </button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


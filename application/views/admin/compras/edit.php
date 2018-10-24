
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Ordenes
        <small>Editar</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8">
                        <form action="<?php echo base_url();?>movimientos/ordenes/update" method="POST" id="add-orden">
                            <input type="hidden" name="idPedido" value="<?php echo $orden->id;?>">
                            <h4>Productos Agregado a la Orden</h4>
                            <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="tborden">
                                <thead>
                                    <tr>
                                        <th style="width:50%;">Producto</th>
                                        <th style="width:25%;">Stock Max</th>
                                        <th style="width:25%;">Cantidad</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($productos as $producto): ?>
                                        <tr>
                                            <td>
                                                <input type="hidden" value="<?php echo $producto->producto_id?>">
                                                <?php echo $producto->nombre;?>
                                                    
                                            </td>
                                            
                                            <td><?php echo $producto->stock;?></td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                    <button class="btn btn-danger btn-menos" type="button" disabled="disabled"><span class="fa fa-minus"></span></button></span>
                                                    <input type="number" class="form-control input-cantidad" readonly="readonly" style="font-weight: bold;" value="<?php echo $producto->cantidad - $producto->pagados;?>" min="1" max="">
                                                    <span class="input-group-btn">
                                                    <button class="btn btn-primary btn-mas" type="button" disabled="disabled"><span class="fa fa-plus"></span></button></span>
                                                </div>
                                            </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-quitarprod" value="<?php echo $orden->id."*".$producto->producto_id."*".($producto->cantidad - $producto->pagados)."*".$producto->id;?>" data-toggle="modal" data-target="#modal-default"><span class="fa fa-times"></span></button>
                                                </td>
                                            
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            </div>
                            <?php 
                                $mesasActual = "";
                                foreach ($pedidomesas as $pedidomesa){
                                    $mesasActual .= $pedidomesa->numero.",";
                                }
                            ?>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <strong>Mesa Actual</strong>:<?php echo $mesasActual; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">

                                    <label for="">Unir mesa con:</label>
                                    <select name="mesa" id="mesa" class="form-control">
                                       <option value="">Seleccione Mesa</option>
                                       <?php foreach ($mesas as $mesa): ?>
                                           <option value="<?php echo $mesa->id;?>"><?php echo $mesa->numero;?></option>
                                       <?php endforeach ?>
                                   </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="nuevamesa">Cambiar Mesa:</label>
                                    <select name="nuevamesa" id="nuevamesa" class="form-control">
                                       <option value="">Seleccione Mesa</option>
                                       <?php foreach ($mesas as $mesa): ?>
                                           <option value="<?php echo $mesa->id;?>"><?php echo $mesa->numero;?></option>
                                       <?php endforeach ?>
                                    </select>
                                </div>
                                
                            </div>
                            
                            <div class="form-group">
                                <button id="btn-success" type="submit" class="btn btn-success btn-flat">Guardar</button>
                                <a href="<?php echo base_url();?>movimientos/ordenes" class="btn btn-danger">Volver</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <h4>Seleccion de Productos</h4>
                        <div class="form-group">
                            <select name="categoria" id="categoria" class="form-control">
                                <option value="">Seleccione Categoria</option>
                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?php echo $categoria->id;?>"><?php echo $categoria->nombre;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <table class="table table-bordered table-hover" id="tbproductos">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Seleccionar</th>
                                </tr>
                            </thead>
                            <tbody>
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
<div class="modal fade" id="modal-venta">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion de la orden</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button id="btn-cmodal" type="button" class="btn btn-danger pull-left btn-cerrar-imp" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-flat btn-print"><span class="fa fa-print"></span> Imprimir</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Eliminar producto de la orden</h4>
      </div>
      <form action="#" method="POST" id="form-clave">
      <div class="modal-body">
        <div class="form-group">
            <label for="">Ingrese Clave de Permiso</label>
            <input type="password" class="form-control" name="clave">
            <input type="hidden" name="idOrden" id="idOrden">
            <input type="hidden" name="idProducto" id="idProducto">
            <input type="hidden" name="idPedidoProd" id="idPedidoProd">
        </div>
        <div class="form-group">
            <label for="">Cantidad a eliminar</label>
            <input type="text" class="form-control" name="cantEliminar" id="cantEliminar" max="1">
        </div>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-print"></span> Guardar</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

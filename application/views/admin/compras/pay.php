
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Ordenes
        <small>Pagar</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        
                            <h4>Productos de la Orden</h4>
                            
                            <p class="text-muted">Marque los productos a pagar y luego haga click en Procesar</p>
                            <div class="checkbox">
                              <label><input type="checkbox" id="check-all">Seleccionar Todos</label>
                            </div>
                            
                            <table class="table table-hover table-bordered" id="tborden">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Producto</th>
                                        <th>Cant. Comprada</th>
                                        <th>Cant. Pagada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sumaCant = 0;
                                        $sumaPag = 0;
                                        foreach ($productos as $producto): ?>
                                        <tr>
                                            <?php
                                                $sumaCant = $sumaCant + $producto->cantidad;
                                                $sumaPag = $sumaPag + $producto->pagados;
                                                $data = $producto->idprod."*".$producto->nombre."*".$producto->precio."*".$producto->cantidad."*".$producto->pagados."*".$producto->id;
                                            ?>
                                            <?php 
                                                $opciones ="";
                                                if ($producto->estado=="1") {
                                                    $opciones ="checked"." "."disabled";
                                                } 
                                            ?>
                                            <td>
                                                <input type="checkbox" id="cbox1" value="<?php echo $data;?>" <?php echo $opciones;?>>
                                            </td>
                                            <td>
                                                <?php echo $producto->nombre;?>
                                                    
                                            </td>
                                            <td><?php echo $producto->cantidad;?>
                                            </td>
                                            <td><?php echo $producto->pagados;?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            
                            <input type="hidden" name="sumaPag" id="sumaPag" value="<?php echo $sumaPag;?>">
                            <input type="hidden" name="sumaCant" id="sumaCant" value="<?php echo $sumaCant;?>">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-procesar btn-flat">Procesar</button>
                                <a href="<?php echo base_url();?>movimientos/ordenes" class="btn btn-danger">Volver</a>

                            </div>
                        
                    </div>
                    <div class="col-md-6">
                        <form action="<?php echo base_url();?>movimientos/ventas/store" method="post" id="form-venta">
                            <input type="hidden" name="idPedido" value="<?php echo $orden->id;?>">
                            <input type="hidden" name="estadoPedido" id="estadoPedido" value="0">
                            <h4>Productos a pagar</h4>
                            <div class="form-group">
                                <label for="">Cliente:</label>
                                <div class="input-group">
                                  <input type="text" class="form-control" placeholder="Buscar Cliente..." id="cliente" data-toggle="modal" data-target="#modal-default" required="required">

                                  <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                                  </span>
                                </div><!-- /input-group -->
                            </div>
                            <input type="hidden" name="idcliente" id="idcliente">
                            <div class="form-group">
                                <label for="">Comprobante:</label>
                                <select name="comprobante" id="comprobante" class="form-control">
                                    <?php foreach($tipocomprobantes as $tipocomprobante):?> 
                                            <option value="<?php echo $tipocomprobante->id;?>" <?php echo $tipocomprobante->predeterminado=="1"?"selected":"";?>><?php echo $tipocomprobante->nombre?></option>
                                    <?php endforeach;?>
                                </select>
                                <input type="hidden" name="idComprobante" id="idComprobante" value="<?php echo $comprobantePredeterminado->id;?>">
                                <input type="hidden" name="serie" id="serie" value="<?php echo $comprobantePredeterminado->serie;?>">
                                <?php 

                                    $numero = $comprobantePredeterminado->cantidad + 1;



                                ?>
                                <input type="hidden" name="numero" id="numero" value="<?php echo str_pad($numero, 6, "0", STR_PAD_LEFT); ?>">
                                <input type="hidden" name="igv" id="igv" value="<?php echo $comprobantePredeterminado->igv;?>">
                            </div>
                            <table class="table table-bordered table-striped" id="tbpago">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Importe</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" style="text-align: right;">Subtotal:</th>
                                        <td><input type="hidden" name="subtotal" id="subtotal"><p class="subtotal"></p></td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" style="text-align: right;">IVA:</th>
                                        <td><input type="hidden" name="iva" id="iva"><p class="iva"></p></td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" style="text-align: right;">Descuento:</th>
                                        <td><input type="hidden" name="descuento" id="descuento" value="0.00"><p class="descuento"></p></td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" style="text-align: right;">Total</th>
                                        <td><input type="hidden" name="total" id="total"><p class="total"></p></td>
                                    </tr>
                                    
                                </tfoot>
                            </table>

                            <div class="form-group">
                                 <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default2">Aplicar Descuento</button>
                            </div>
                        </div>
                    </form>
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
                <h4 class="modal-title">Clientes</h4>
            </div>
            <div class="modal-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#tab_1" data-toggle="tab">Listado</a></li>
                      <li><a href="#tab_2" data-toggle="tab">Registrar</a></li>
                      
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Direccion</th>
                                        <th>Telefono</th>
                                        <th>Opcion</th>
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
                                                <?php $datacliente = $cliente->id."*".$cliente->nombre."*".$cliente->telefono."*".$cliente->direccion;?>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-check" value="<?php echo $datacliente;?>"><span class="fa fa-check"></span></button>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                </tbody>
                            </table>

                        </div>
                        <!-- /.tab-pane -->
                      <div class="tab-pane" id="tab_2">
                        <form action="<?php echo base_url();?>movimientos/ventas/savecliente" method="POST" id="form-cliente">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                
                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion:</label>
                                <input type="text" class="form-control" id="direccion" name="direccion">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-flat">Guardar y Seleccionar</button>
                            </div>
                        </form>
                      </div>
                      <!-- /.tab-pane -->
                      
                    </div>
                    <!-- /.tab-content -->
                </div>


                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<div class="modal fade" id="modal-venta">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Informacion de la venta</h4>
      </div>
      <div class="modal-body">
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left btn-cerrar" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-print"><span class="fa fa-print"> </span>Imprimir</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-default2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Datos del Descuento</h4>
            </div>
            <div class="modal-body">

                <form action="#" method="POST" id="form-comprobar-password">
                    <div class="form-group">
                        <label for="">Monto</label>
                        <input type="text" name="montoDescuento" id="montoDescuento" class="form-control" placeholder="Monto...">
                    </div>
                    <div class="form-group">
                        <label for="">Introduzca Contraseña</label>
                        <input type="password" name="password" class="form-control" placeholder="Contraseña...">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Comprobar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Ventas
        <small>Editar</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">

                <div class="row">
                    <form action="<?php echo base_url();?>movimientos/ventas/update" method="POST" class="form-horizontal">
                    <!--Inicio Primer Columna-->
                    <div class="col-md-9">
                        <input type="hidden" id="modulo" value="ventas">
                        <input type="hidden" name="idVenta" value="<?php echo $venta->id; ?>">
                        <div class="col-md-12">
                            <label for="">Producto:</label>
                            <div class="input-group barcode">
                                <div class="input-group-addon">
                                    <i class="fa fa-barcode"></i>
                                </div>
                                <input type="text" class="form-control" id="searchProductoVenta" placeholder="Buscar por codigo de barras o nombre del proucto">
                            </div>
                        </div>
                    
                        <div class="col-md-12">
                            <table id="tbventas" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Marca</th>
                                        <th>Precio</th>
                                        <th>Stock Max.</th>
                                        <th>Cantidad</th>
                                        <th>Importe</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($detalles)): ?>
                                        <?php foreach ($detalles as $detalle): ?>
                                            <tr>
                                                <td>
                                                    <input type='hidden' name='idproductos[]' value="<?php echo $detalle->producto_id;?>">
                                                    <?php echo $detalle->codigo_barras;?>
                                                </td>
                                                <td><?php echo $detalle->nombre;?></td>
                                                <td><?php echo $detalle->marca;?></td>
                                                <td>
                                                    <input type='hidden' name='precios[]' value="<?php echo $detalle->precio;?>">
                                                    <?php echo $detalle->precio;?>
                                                </td>
                                                <td><?php echo $detalle->stock?></td>
                                                <td>
                                                    <input type="text" name="cantidades[]" class="cantidadesVenta" value="<?php echo $detalle->cantidad;?>">
                                                </td>
                                                <td>
                                                    <input type='hidden' name='importes[]' value="<?php echo $detalle->importe;?>">
                                                    <p><?php echo $detalle->importe;?></p>  
                                                </td>
                                                <td><button type='button' class='btn btn-danger btn-remove-producto-compra'><span class='fa fa-times'></span></button></td>
                                            </tr>
                                          
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--Inicio 2da Columna-->
                    <div class="col-md-3">
                               
                        <label for="">Comprobante:</label>
                        <select name="comprobante" id="comprobanteVenta" class="form-control" required>
                            <option value="">Seleccione...</option>
                            <?php foreach($tipocomprobantes as $tipocomprobante):?> 
                                <?php $data = $tipocomprobante->id."*".$tipocomprobante->nombre."*".$tipocomprobante->iva;?>
                                <option value="<?php echo $data;?>" <?php echo $venta->tipo_comprobante_id == $tipocomprobante->id ? 'selected' : '';?>><?php echo $tipocomprobante->nombre?></option>
                            <?php endforeach;?>
                            <input type="hidden" id="iva" value="<?php echo $venta->porcentaje;?>">
                            <input type="hidden" name="comprobante_id" id="comprobante_id" value="<?php echo $venta->tipo_comprobante_id;?>">
                        </select>
                        <label for="">Serie y Nro de Documento</label>
                        <input type="text" class="form-control" readonly="readonly" value="<?php echo $venta->serie." - ".$venta->num_documento;?>">
                               
                        <label for="">Tipo de Pago:</label>
                        <select name="tipo_pago" id="tipo_pago" class="form-control" required>
                            
                            <option value="1" <?php echo $venta->estado == 1? 'selected':'';?>>Efectivo</option>
                            <option value="2" <?php echo $venta->estado == 2? 'selected':'';?>>Credito</option>
                        </select>
                                 
                        <label for="">Fecha:</label>
                        <input type="date" class="form-control" name="fecha" value="<?php echo $venta->fecha;?>" required>
                    
                        <label for="">Cliente:</label>
                        <div class="input-group">
                            <input type="hidden" name="idcliente" id="idcliente" value="<?php echo $venta->cliente_id?>">
                            <input type="text" class="form-control" " id="cliente" value="<?php echo $venta->nombre;?>">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default" ><span class="fa fa-search"></span> Buscar</button>
                            </span>
                        </div><!-- /input-group -->
                            
                        <label for="">Monto Recibido:</label>
                        <input type="text" class="form-control" id="monto_recibido" name="monto_recibido">
               
                         <br>
                        <div class="input-group">
                            <span class="input-group-addon">Subtotal:</span>
                            <input type="text" class="form-control" placeholder="0.00" name="subtotal" readonly="readonly"  value="<?php echo $venta->subtotal; ?>">
                        </div>
                               
                        <div class="input-group">
                            <span class="input-group-addon">IVA:</span>
                            <input type="text" class="form-control" placeholder="IVA" name="iva" readonly="readonly" value="<?php echo $venta->iva ?>">
                        </div>
                           
                        <div class="input-group">
                            <span class="input-group-addon">Descuento:</span>
                            <input type="text" class="form-control" placeholder="descuento" name="descuento" id="descuento" value="<?php echo $venta->descuento;?>" readonly="readonly">
                            <span class="input-group-btn">
                                <button class="btn btn-danger" id="btn-descuento" type="button" data-toggle="modal" data-target="#modal-default2">
                                    Aplicar
                                </button>
                            </span>
                        </div>
                    
                        <div class="input-group">
                            <span class="input-group-addon">Total:</span>
                            <input type="text" class="form-control" placeholder="0.00" name="total" readonly="readonly" value="<?php echo $venta->total ?>">
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">Cambio:</span>
                            <input type="text" class="form-control" placeholder="0.00" name="cambio" readonly="readonly">
                        </div>
                        <br>
                        
                            <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Guardar Venta</button>
                             
                            <a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>" class="btn btn-danger btn-flat"><i class="fa fa-times"></i> Cancelar</a>
                        
                    </div>
                    </form>
                            
        
                </div>

                <!--end row-->
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
                                        <th>Documento</th>
                                        <th>Numero</th>
                                        <th>Nombre</th>
                                        <th>Opcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($clientes)):?>
                                        <?php foreach($clientes as $cliente):?>
                                            <tr>
                                                <td><?php echo $cliente->tipodocumento;?></td>
                                                <td><?php echo $cliente->num_documento;?></td>
                                                <td><?php echo $cliente->nombre;?></td>
                                                <?php $datacliente = $cliente->id."*".$cliente->nombre."*".$cliente->tipocontribuyente."*".$cliente->tipodocumento."*".$cliente->num_documento."*".$cliente->telefono."*".$cliente->direccion;?>
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
                                <label for="tipocliente">Tipo de Cliente</label>
                                <select name="tipocliente" id="tipocliente" class="form-control" required>
                                    <option value="">Seleccione...</option>
                                    <?php foreach ($tipoclientes as $tipocliente) :?>
                                        <option value="<?php echo $tipocliente->id;?>" ><?php echo $tipocliente->nombre ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tipodocumento">Tipo de Documento</label>
                                <select name="tipodocumento" id="tipodocumento" class="form-control" required>
                                    <option value="">Seleccione...</option>
                                    <?php foreach ($tipodocumentos as $tipodocumento) :?>
                                        <option value="<?php echo $tipodocumento->id;?>" ><?php echo $tipodocumento->nombre ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="numero">No. de Documento:</label>
                                <input type="text" class="form-control" id="numero" name="numero" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="telefono">Telefono:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion:</label>
                                <input type="text" class="form-control" id="direccion" name="direccion">
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
<div class="modal fade" id="modal-default2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Datos del Administrador</h4>
            </div>
            <div class="modal-body">

                <form action="#" method="POST" id="form-comprobar-password">
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

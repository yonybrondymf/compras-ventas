<?php $predeterminado = ''; $iva = "0";?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Ventas
        <small>Nuevo</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <!--Inicio Primer Columna-->
                    <div class="col-md-9">
                        <input type="hidden" id="modulo" value="ventas">
                        <form action="<?php echo base_url();?>movimientos/ventas/store" method="POST" class="form-horizontal">
                         <!--   <input type="hidden" name="estado" value="<?php// echo $estado; ?>">-->
                        
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
                                    </tr>
                                </thead>
                                <tbody>
                                
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
                                            <?php 
                                                if ($tipocomprobante->predeterminado ==1) {
                                                    $predeterminado = $tipocomprobante->id;
                                                    $iva = $tipocomprobante->iva;
                                                }
                                                $data = $tipocomprobante->id."*".$tipocomprobante->nombre."*".$tipocomprobante->iva;?>
                                            <option value="<?php echo $data;?>" <?php echo $tipocomprobante->predeterminado == 1 ? 'selected':'';?>><?php echo $tipocomprobante->nombre?></option>
                                        <?php endforeach;?>
                                        <input type="hidden" id="iva" value="0">
                                        <input type="hidden" name="comprobante_id" id="comprobante_id" value="<?php echo $predeterminado;?>">
                                    </select>
                               
                                    <label for="">Tipo de Pago:</label>
                                    <select name="tipo_pago" id="tipo_pago" class="form-control" required>
                                        
                                        <option value="1">Efectivo</option>
                                        <option value="2">Credito</option>
                                    </select>
                                 
                                    <label for="">Fecha:</label>
                                    <input type="date" class="form-control" name="fecha" value="<?php echo date("Y-m-d");?>" required>
                                
                                    <label for="">Cliente:</label>
                                    <div class="input-group">
                                        <input type="hidden" name="idcliente" id="idcliente">
                                        <input type="text" class="form-control" " id="cliente">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default" ><span class="fa fa-search"></span> Buscar</button>
                                        </span>
                                    </div><!-- /input-group -->
                            
                                    <label for="">Monto Recibido:</label>
                                    <input type="text" class="form-control" id="monto_recibido" name="monto_recibido">
                           
                                     <br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Subtotal:</span>
                                        <input type="text" class="form-control" placeholder="0.00" name="subtotal" readonly="readonly">
                                    </div>
                               
                                    <div class="input-group">
                                        <span class="input-group-addon">IVA:</span>
                                        <input type="text" class="form-control" placeholder="0.00" name="iva" readonly="readonly">
                                    </div>
                           
                                    <div class="input-group">
                                        <span class="input-group-addon">Descuento:</span>
                                        <input type="text" class="form-control" placeholder="descuento" name="descuento" id="descuento" value="0.00" readonly="readonly">
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger" id="btn-descuento" type="button" data-toggle="modal" data-target="#modal-default2">
                                                Aplicar
                                            </button>
                                        </span>
                                    </div>
                    
                                    <div class="input-group">
                                        <span class="input-group-addon">Total:</span>
                                        <input type="text" class="form-control" placeholder="0.00" name="total" readonly="readonly">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon">Cambio:</span>
                                        <input type="text" class="form-control" placeholder="0.00" name="cambio" readonly="readonly">
                                    </div>
                               <br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-flat" id="btn-guardar-venta"><i class="fa fa-save"></i> Guardar Venta</button>
                                     
                                    <a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>" class="btn btn-danger btn-flat"><i class="fa fa-times"></i> Cancelar</a>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <!--Fin de Primer Columna-->
                </div>

                <!--end row1-->
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

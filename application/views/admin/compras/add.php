<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Compras
        <small>Nueva</small>
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
                        <form action="<?php echo base_url();?>movimientos/compras/store" method="POST" class="form-horizontal">
                         <!--   <input type="hidden" name="estado" value="<?php// echo $estado; ?>">-->
                        
                                <div class="col-md-12">
                                    <label for="">Producto:</label>
                                    <div class="input-group barcode">
                                    <div class="input-group-addon">
                                        <i class="fa fa-barcode"></i>
                                    </div>
                                    <input type="text" class="form-control" id="searchProductoCompra" placeholder="Buscar por codigo de barras o nombre del proucto">
                                </div>
                            
                            </div>
                        
                                <div class="col-md-12">
                            <table id="tbcompras" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Marca</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Importe</th>
                                        <th></th>
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
                                    <input type="text" name="comprobante" class="form-control">
                               
                                
                                    <label for="">Tipo de Pago:</label>
                                    <select name="tipo_pago" id="tipo_pago" class="form-control" required>
                                        <option value="">Seleccione...</option>
                                        <?php foreach ($tipo_pagos as $tipo_pago): ?>
                                            <option value="<?php echo $tipo_pago->id?>"><?php echo $tipo_pago->nombre?></option>
                                        <?php endforeach ?>
                                        
                                    </select>
                                 
                                    <label for="">Serie:</label>
                                    <input type="text" class="form-control" id="serie" name="serie" placeholder="Escriba la Serie">
                              
                               
                                    <label for="">No. Comprobante:</label>
                                    <input type="text" class="form-control"  name="numero" placeholder="Escriba el No. de Factura">
                              
                                    <label for="">Fecha de Compra:</label>
                                    <input type="date" class="form-control" name="fecha" value="<?php echo date("Y-m-d");?>" required>
                                
                                    <label for="">Proveedor:</label>
                                    <input type="text" class="form-control"  name="proveedor" id="proveedor" placeholder="Escriba el nombre del Proveedor">
                                    <input type="hidden" name="idproveedor" id="idproveedor">
                              
    
                                     <br>
                                    <div class="input-group">
                                        <span class="input-group-addon">Subtotal:</span>
                                        <input type="text" class="form-control" placeholder="0.00" name="subtotal" readonly="readonly">
                                    </div>
                            
                                    <div class="input-group">
                                        <span class="input-group-addon">Total:</span>
                                        <input type="text" class="form-control" placeholder="0.00" name="total" readonly="readonly">
                                    </div>
                               <br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-flat" id="btn-guardar-compra"><i class="fa fa-save"></i> Guardar Compra</button>
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
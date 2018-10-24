
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Ordenes
        <small>Nuevo</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8">
                        <form action="<?php echo base_url();?>movimientos/ordenes/store" method="POST" id="add-orden">
                            <h4>Productos Agregado a la Orden</h4>
                            <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="tborden">
                                <thead>
                                    <tr>
                                        <th style="width:50%;">Producto</th>
                                        <th style="width:25%;">Stock Max</th>
                                        <th style="width:25%;">Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                            </div>
                            <div class="form-group">
                                <label for="">Mesas</label>
                                <select name="mesas[]" class="form-control select2" multiple="multiple" data-placeholder="Seleccione mesas" style="width: 100%;" required="required">
                                  <?php foreach ($mesas as $mesa): ?>
                                      <option value="<?php echo $mesa->id;?>"><?php echo $mesa->numero;?></option>
                                  <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button id="btn-success" type="submit" class="btn btn-success btn-flat btn-guardar" disabled="disabled">Guardar</button>
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

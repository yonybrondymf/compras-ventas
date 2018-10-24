<?php $meses = ["ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SETIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"];?>
<?php if ($mensaje == "error"): ?>
    <script>
        swal({
            position: 'center',
            type: 'warning',
            title: 'No se han registrado ningun inventario para el mes y año seleccionado',
            showConfirmButton: false,
            timer: 4000
        });
    </script>
<?php endif ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Saldo y movimientos
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <form action="<?php echo current_url()?>" method="POST">
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon">Mes:</span>
                            <select name="month" id="month" class="form-control" required="required">
                                <option value="">Seleccione...</option>
                                <?php 
                                    for ($i=1; $i <=12 ; $i++) { 
                                        if ($month == $i) {
                                            $selected = "selected";
                                        }else{
                                            $selected = "";
                                        }
                                        echo "<option value='".$i."' ".$selected.">".$meses[$i-1]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon">Año:</span>
                            <select name="year" id="year" class="form-control" required="required">
                                <option value="">Seleccione...</option>
                                <?php foreach ($years as $y): ?>
                                    <option value="<?php echo $y->year;?>" <?php echo $year == $y->year ? 'selected':'';?>><?php echo $y->year;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" name="filtrar" value="Filtrar" class="btn btn-success">
                    </div>
                </div>
                </form>
                
                <div class="row">
                    <div class="col-md-12">
                        
                        <?php if (!empty($month) && !empty($year)): ?>
                            <h3 class="text-center" style="background: red; color: #FFF;">SALDO INICIAL Y MOVIMIENTOS DE PRODUCTOS DEL MES <?php echo $meses[$month-1]?> DEL AÑO <?php echo $year ?></h3>
                        <?php else: ?>
                            <h3 class="text-center" style="background: red; color: #FFF;">SALDO INICIAL Y MOVIMIENTOS DE PRODUCTOS</h3>
                        <?php endif ?>
                        <table id="table-with-buttons" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>PRODUCTO</th>
                                    <th>MARCA</th>
                                    <th>SALDO INICIAL</th>
                                    <th>ENTRADAS</th>
                                    <th>SALIDAS</th>
                                    <th>SALDO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($productos)):?>
                                    <?php $i = 1;?>
                                    <?php foreach($productos as $producto):?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $producto->nombre;?></td>
                                            <td><?php echo $producto->marca;?></td>
                                            <td><?php echo $producto->cantidad;?></td>
                                            
                                            <td><?php echo $producto->compra;?></td>
                                            <td><?php echo $producto->venta;?></td>
                                            <td><?php echo ($producto->cantidad + $producto->compra - $producto->venta);?></td>

                                        </tr>
                                        <?php $i++;?>
                                    <?php endforeach;?>
                                    
                                <?php endif;?>
                            </tbody>
                        </table>
                        <?php if (!empty($productos)): ?>
                            
                        <?php endif ?>
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

<div class="modal fade" id="modal-compra">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion de la Compra</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-flat btn-print"><span class="fa fa-print"></span> Imprimir</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

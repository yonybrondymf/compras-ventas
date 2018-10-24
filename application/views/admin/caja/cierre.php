
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Cierre
        <small>Caja</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php if($this->session->flashdata("error")):?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                                
                             </div>
                        <?php endif;?>
                        <?php if ($cierre): ?>
                            <div class="panel panel-default">
                                <div class="panel-body contenido-cierre">
                                    <h4><strong>CIERRE DE CAJA</strong></h4>
                                    <p><b>Usuario:</b> <?php echo ucwords($cierre->nombres." ".$cierre->apellidos);?></p>
                                    <p><b>Monto de Apertura:</b> <?php echo $apertura->monto;?></p>
                                    <p><b>Monto de ventas:</b> <?php echo $ventas->total;?></p>
                                    <p><b>Monto Efectivo:</b> <?php echo $cierre->efectivo;?></p>
                                    <p><b>Fecha y Hora:</b> <?php echo $cierre->fecha;?></p>
                                    <p><b>Observacion:</b> <?php echo $cierre->observacion;?></p>
                                </div>
                                <div class="panel-footer">
                                    <button type="button" class="btn btn-primary btn-flat btn-print-cierre">Imprimir</button>
                                </div>
                            </div>
                        <?php endif;?>
                            <form action="<?php echo base_url();?>caja/cierre/store" method="POST" id="form-cierre">
                                <input type="hidden" value="<?php echo !empty($cierre->id)? $cierre->id:'';?>" name="idcierre">
                                <div class="form-group">
                                    <label for="fecha">Fecha:</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date("Y-m-d");?>" disabled="disabled">
                                </div>
                                <?php 
                                    if(!$apertura){
                                        $aperturamonto = "";
                                    }else{
                                        $aperturamonto = $apertura->monto;
                                    }

                                ?>
                                <div class="form-group">
                                    <label for="monto">Monto de Apertura:</label>
                                    <input type="text" class="form-control" id="monto_apertura" name="monto_apertura" readonly="readonly" value="<?php echo $aperturamonto; ?>">
                                    <?php if ($aperturamonto == ""): ?>
                                        <span class="help-block">Aun no se ha colocado un valor de apertura de caja</span>
                                    <?php endif ?>
                                    
                                </div>

                                <?php 

                                    if($ventas->total==""){
                                        $totalventas = "0.00";
                                    }else{
                                        $totalventas = $ventas->total;
                                    }

                                ?>
                                <div class="form-group">
                                    <label for="monto">Monto de Ventas:</label>
                                    <input type="text" class="form-control" id="monto_ventas" name="monto_ventas" readonly="readonly" value="<?php echo $totalventas;?>">
                                </div>
                                <div class="form-group">
                                    <label for="monto_efectivo">Monto Efectivo:</label>
                                    <input type="text" class="form-control" id="monto_efectivo" name="monto_efectivo" value="<?php echo !empty($cierre->efectivo)? $cierre->efectivo:'';?>">
                                </div>
                                <input type="hidden" name="total_cierre" value="<?php echo $aperturamonto + $totalventas;?>">
                                <input type="hidden" name="observacion" id="observacion" value="<?php echo !empty($cierre->observacion)? $cierre->observacion:'';?>">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                    <a href="<?php echo base_url();?>dashboard" class="btn btn-danger btn-flat">Volver</a>
                                </div>
                            </form>

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


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Apertura
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
                        <?php if (!$apertura): ?>
                            <form action="<?php echo base_url();?>caja/apertura/store" method="POST">
                            
                                <div class="form-group">
                                    <label for="fecha">Fecha:</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date("Y-m-d");?>" disabled="disabled">
                                </div>
                                <div class="form-group">
                                    <label for="monto">Monto:</label>
                                    <input type="text" class="form-control" id="monto" name="monto" required="required">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                    <a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>" class="btn btn-danger btn-flat">Volver</a>
                                </div>
                            </form>
                        <?php else:?>
                            <div class="panel panel-default" id="panelApertura">
                                <div class="panel-heading">
                                    Informacion de la Apertura de Caja
                                </div>
                                <div class="panel-body">
                                    <p><b>Usuario:</b> <?php echo $apertura->nombres." ".$apertura->apellidos;?></p>
                                    <p><b>Monto:</b> <?php echo $apertura->monto;?></p>
                                    <p><b>Fecha y Hora:</b> <?php echo $apertura->fecha;?></p>
                                </div>

                                <div class="panel-footer">
                                    <button type="button" class="btn btn-primary" id="btnActualizarApertura">Actualizar</button>
                                    <a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>" class="btn btn-danger btn-flat">Volver</a>
                                </div>
                            </div>
                            

                            <form action="<?php echo base_url();?>caja/apertura/update" method="POST" id="formActualizarApertura" style="display: none;">
                                <input type="hidden" name="idapertura" value="<?php echo $apertura->id;?>">
                                <div class="form-group">
                                    <label for="fecha">Fecha:</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $apertura->fecha;?>" disabled="disabled">
                                </div>
                                <div class="form-group">
                                    <label for="monto">Monto:</label>
                                    <input type="text" class="form-control" id="monto" name="monto" required="required" value="<?php echo $apertura->monto;?>">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                    <a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>" class="btn btn-danger btn-flat">Volver</a>
                                </div>
                            </form>
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

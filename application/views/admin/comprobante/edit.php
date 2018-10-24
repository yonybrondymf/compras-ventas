
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Documento
        <small>Editar</small>
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
                        <form action="<?php echo base_url();?>mantenimiento/comprobante/update" method="POST">
                            <input type="hidden" value="<?php echo $comprobante->id;?>" name="idComprobante">
                            <div class="form-group <?php echo form_error('nombre') == true ? 'has-error': '';?>">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $comprobante->nombre?>">
                                <?php echo form_error("nombre","<span class='help-block'>","</span>");?>
                            </div>
                             <div class="form-group <?php echo form_error('iva') == true ? 'has-error': '';?>">
                                <label for="iva">IVA:</label>
                                <input type="text" class="form-control" id="iva" name="iva" value="<?php echo $comprobante->iva?>">
                                <?php echo form_error("iva","<span class='help-block'>","</span>");?>
                            </div>
                            <div class="form-group <?php echo form_error('serie') == true ? 'has-error': '';?>">
                                <label for="serie">Serie:</label>
                                <input type="text" class="form-control" id="serie" name="serie" value="<?php echo $comprobante->serie?>">
                                <?php echo form_error("serie","<span class='help-block'>","</span>");?>
                            </div>

                             <div class="form-group">
                                <label for="fecha_registro">Fecha de Registro:</label>
                                <input type="text" class="form-control" id="fecha_registro" name="fecha_registro" value="<?php echo $comprobante->fecha_registro?>">
                            </div>
                             <div class="form-group <?php echo form_error('no_inicial') == true ? 'has-error': '';?>">
                                <label for="no_inicial">No. Inicial:</label>
                                <input type="text" class="form-control" id="no_inicial" name="no_inicial" value="<?php echo $comprobante->no_inicial?>" >
                                <?php echo form_error("no_inicial","<span class='help-block'>","</span>");?>
                            </div>

                            <div class="form-group <?php echo form_error('no_final') == true ? 'has-error': '';?>">
                                <label for="no_final">No. Final:</label>
                                <input type="text" class="form-control" id="no_final" name="no_final" value="<?php echo $comprobante->no_final?>">
                                <?php echo form_error("no_final","<span class='help-block'>","</span>");?>
                            </div>

                             <div class="form-group <?php echo form_error('resolucion') == true ? 'has-error': '';?>">
                                <label for="resolucion">Resolucion:</label>
                                <input type="text" class="form-control" id="resolucion" name="resolucion" value="<?php echo $comprobante->resolucion?>" >
                                <?php echo form_error("resolucion","<span class='help-block'>","</span>");?>
                            </div>

                            <div class="form-group">
                                <label for="fecha_resolucion">Fecha de Resolucion:</label>
                                <input type="text" class="form-control" id="fecha_resolucion" name="fecha_resolucion" value="<?php echo $comprobante->fecha_resolucion?>">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                <a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>" class="btn btn-danger btn-flat">Volver</a>
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

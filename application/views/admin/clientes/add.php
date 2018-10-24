
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Clientes
        <small>Nuevo</small>
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
                        <form action="<?php echo base_url();?>mantenimiento/clientes/store" method="POST">
                            <div class="form-group <?php echo form_error("nombre") != false ? 'has-error':'';?>">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo set_value("nombre");?>" required="required">
                                <?php echo form_error("nombre","<span class='help-block'>","</span>");?>
                            </div>
                            <div class="form-group <?php echo form_error("tipocontribuyente") != false ? 'has-error':'';?>">
                                <label for="tipocontribuyente">Tipo de Cliente</label>
                                <select name="tipocontribuyente" id="tipocontribuyente" class="form-control" required="required">
                                    <option value="">Seleccione...</option>
                                    <?php foreach ($tipocontribuyentes as $tipocontribuyente) :?>
                                        <option value="<?php echo $tipocontribuyente->id;?>" <?php echo set_select("tipocontribuyente",$tipocontribuyente->id);?>><?php echo $tipocontribuyente->nombre ?></option>
                                    <?php endforeach;?>
                                </select>
                                <?php echo form_error("tipocontribuyente","<span class='help-block'>","</span>");?>
                            </div>
                            <div class="form-group <?php echo form_error("tipodocumento") != false ? 'has-error':'';?>">
                                <label for="tipodocumento">Tipo de Documento</label>
                                <select name="tipodocumento" id="tipodocumento" class="form-control" required="required">
                                    <option value="">Seleccione...</option>
                                    <?php foreach ($tipodocumentos as $tipodocumento) :?>
                                        <option value="<?php echo $tipodocumento->id;?>" <?php echo set_select("tipodocumento",$tipodocumento->id);?>><?php echo $tipodocumento->nombre ?></option>
                                    <?php endforeach;?>
                                </select>
                                <?php echo form_error("tipodocumento","<span class='help-block'>","</span>");?>
                            </div>
                            <div class="form-group <?php echo form_error("numero") != false ? 'has-error':'';?>">
                                <label for="numero">No. del Documento:</label>
                                <input type="text" class="form-control" id="numero" name="numero" value="<?php echo set_value("numero");?>" required="required">
                                <?php echo form_error("numero","<span class='help-block'>","</span>");?>
                            </div>
                            
                            <div class="form-group">
                                <label for="telefono">Telefono:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" required="required">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion:</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" required="required">
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

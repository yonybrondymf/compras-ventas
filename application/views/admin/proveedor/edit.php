
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Proveedores
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
                        <form action="<?php echo base_url();?>mantenimiento/proveedor/update" method="POST">
                            <input type="hidden" value="<?php echo $proveedor->id;?>" name="idProveedor">
                            <div class="form-group <?php echo form_error('nombre') == true ? 'has-error': '';?>">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $proveedor->nombre?>">
                                <?php echo form_error("nombre","<span class='help-block'>","</span>");?>
                            </div>
                            <div class="form-group">
                                <label for="nit">Nit:</label>
                                <input type="text" class="form-control" id="nit" name="nit" value="<?php echo $proveedor->nit?>">
                            </div>
                            <div class="form-group <?php echo form_error("tipo_contribuyente") != false ? 'has-error':'';?>">
                                <label for="tipo_contribuyente">Tipo de Contribuyente</label>
                                <select name="tipo_contribuyente" id="tipo_contribuyente" class="form-control">
                                    <option value="">Seleccione...</option>
                                    <?php if(form_error("tipo_contribuyente")!=false || set_value("tipo_contribuyente") != false): ?>
                                        <?php foreach ($tipo_contribuyentes as $tipo_contribuyente) :?>
                                            <option value="<?php echo $tipo_contribuyente->id;?>" <?php echo set_select("tipo_contribuyente",$tipo_contribuyente->id);?>><?php echo $tipo_contribuyente->nombre ?></option>
                                        <?php endforeach;?>
                                    <?php else: ?>
                                        <?php foreach ($tipo_contribuyentes as $tipo_contribuyente) :?>
                                            <option value="<?php echo $tipo_contribuyente->id;?>" <?php echo $tipo_contribuyente->id == $proveedor->contribuyente_id ? 'selected':'';?>><?php echo $tipo_contribuyente->nombre ?></option>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                </select>
                                <?php echo form_error("tipo_contribuyente","<span class='help-block'>","</span>");?>
                            </div>

                            <div class="form-group">
                                <label for="direccion">Direccion:</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $proveedor->direccion?>">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $proveedor->telefono?>">
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $proveedor->email?>">
                            </div>
                            <div class="form-group">
                                <label for="contacto">Contacto:</label>
                                <input type="text" class="form-control" id="contacto" name="contacto" value="<?php echo $proveedor->contacto?>">
                            </div>
                            <div class="form-group">
                                <label for="tel_contacto">Telefono del Contacto:</label>
                                <input type="text" class="form-control" id="tel_contacto" name="tel_contacto" value="<?php echo $proveedor->tel_contacto?>">
                            </div>
                            <div class="form-group">
                                <label for="banco">Banco:</label>
                                <input type="text" class="form-control" id="banco" name="banco" value="<?php echo $proveedor->banco?>">
                            </div>
                            <div class="form-group">
                                <label for="no_cuenta">No. de Cuenta:</label>
                                <input type="text" class="form-control" id="no_cuenta" name="no_cuenta" value="<?php echo $proveedor->no_cuenta?>">
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

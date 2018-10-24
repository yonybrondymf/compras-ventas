
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Empresa
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
                        <form action="<?php echo base_url();?>administrador/empresa/update" method="POST">
                            <input type="hidden" value="<?php echo $empresa->id;?>" name="idCategoria">
                            <div class="form-group <?php echo form_error('nombre') == true ? 'has-error': '';?>">
                                <label for="nombre">Nombre de la Empresa:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $empresa->nombre?>">
                                <?php echo form_error("nombre","<span class='help-block'>","</span>");?>
                            </div>
                            <div class="form-group <?php echo form_error('nombre') == true ? 'has-error': '';?>">
                                <label for="propietario">Propietario:</label>
                                <input type="text" class="form-control" id="propietario" name="propietario" value="<?php echo $empresa->propietario?>">
                                <?php echo form_error("propietario","<span class='help-block'>","</span>");?>
                            </div>
                            <div class="form-group <?php echo form_error('nombre') == true ? 'has-error': '';?>">
                                <label for="nit">NIT:</label>
                                <input type="text" class="form-control" id="nit" name="nit" value="<?php echo $empresa->nit?>">
                                <?php echo form_error("nit","<span class='help-block'>","</span>");?>
                            </div>
                             <div class="form-group <?php echo form_error('nombre') == true ? 'has-error': '';?>">
                                <label for="logotipo">Logotipo:</label>
                                <input type="text" class="form-control" id="logotipo" name="logotipo" value="<?php echo $empresa->logotipo?>">
                                <?php echo form_error("logotipo","<span class='help-block'>","</span>");?>
                            </div>
                            
                            <div class="form-group <?php echo form_error("tipo_moneda") != false ? 'has-error':'';?>">
                                <label for="tipo_moneda">Tipo de Moneda</label>
                                <select name="tipo_moneda" id="tipo_moneda" class="form-control">
                                    <option value="">Seleccione una moneda...</option>
                                    <?php if(form_error("tipo_moneda")!=false || set_value("tipo_moneda") != false): ?>
                                        <?php foreach ($tipo_monedas as $tipo_moneda) :?>
                                            <option value="<?php echo $tipo_contribuyente->id;?>" <?php echo set_select("tipo_moneda",$tipo_moneda->id);?>><?php echo $tipo_moneda->nombre ?></option>
                                        <?php endforeach;?>
                                    <?php else: ?>
                                        <?php foreach ($tipo_monedas as $tipo_moneda) :?>
                                            <option value="<?php echo $tipo_moneda->id;?>" <?php echo $tipo_moneda->id == $empresa->moneda_id ? 'selected':'';?>><?php echo $tipo_moneda->nombre ?></option>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                </select>
                                <?php echo form_error("tipo_moneda","<span class='help-block'>","</span>");?>
                            </div>

                            <div class="form-group">
                                <label for="direccion">Direccion:</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $empresa->direccion?>">
                            </div>

                            <div class="form-group">
                                <label for="facebook">Facebook:</label>
                                <input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo $empresa->facebook?>">
                            </div>
                            <div class="form-group">
                                <label for="web">Pagina Web:</label>
                                <input type="text" class="form-control" id="web" name="web" value="<?php echo $empresa->web?>">
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripcion:</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $empresa->descripcion?>">
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $empresa->email?>">
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

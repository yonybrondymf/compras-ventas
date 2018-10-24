
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Permisos
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
                        <form action="<?php echo base_url();?>administrador/permisos/store" method="POST">
                                                       
                            <div class="form-group">
                                <label for="rol">Roles:</label>
                                <select name="rol" id="rol" class="form-control">
                                    <?php foreach($roles as $rol):?>
                                        <option value="<?php echo $rol->id;?>"><?php echo $rol->nombre;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="menu">Menus:</label>
                                <select name="menu" id="menu" class="form-control">
                                    <?php foreach($menus as $menu):?>
                                        <option value="<?php echo $menu->id;?>"><?php echo $menu->nombre;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="read">Leer:</label>
                                <label class="radio-inline">
                                    <input type="radio" name="read" value="1" checked="checked">Si
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="read" value="0" >No
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="read">Agregar:</label>
                                <label class="radio-inline">
                                    <input type="radio" name="insert" value="1" checked="checked">Si
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="insert" value="0" >No
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="read">Editar:</label>
                                <label class="radio-inline">
                                    <input type="radio" name="update" value="1" checked="checked">Si
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="update" value="0" >No
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="read">Eliminar:</label>
                                <label class="radio-inline">
                                    <input type="radio" name="delete" value="1" checked="checked">Si
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="delete" value="0" >No
                                </label>
                            </div>
                             <div class="form-group">
                                <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Guardar</button>
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

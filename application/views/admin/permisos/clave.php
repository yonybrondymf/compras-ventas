
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Clave de Permiso Especial
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Definir Clave de Permiso Especial</h3>
            </div>
            <div class="box-body">
                <form action="<?php echo base_url();?>administrador/permisos/setClave" method="POST">
                <div class="row">
                    <div class="col-md-12">
                        <p>Mediante esta clave podras eliminar productos de una orden, asi mismo el aplicar descuento al pago de las ordenes </p>
                    </div>  
                </div>
                <div class="row">
                    <input type="hidden" name="idClave" value="<?php echo isset($clave->id) ? $clave->id:"";?>">
                    <div class="col-md-3 form-group">
                        <input type="password" class="form-control" name="clave" id="clave" value="<?php echo isset($clave->clave_permiso) ? $clave->clave_permiso:"";?>" placeholder="Ingrese Clave">
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="checkbox-inline"><input type="checkbox" value="" id="showCaracteres">Mostrar Caracteres</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">

                        <button type="submit" class="btn btn-success btn-flat">Grabar</button>
                    </div>
                </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

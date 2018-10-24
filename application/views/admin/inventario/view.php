<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Inventario
        </h1>
    </section>
    <!-- Main content -->
    <?php $meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre"];?>
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            <span class="fa fa-check"></span> Inventario abiento del 01-<?php echo date("m-Y");?> al <?php echo date("t-m-Y", strtotime(date("Y-m-d"))); ?>
                        </div>
                    </div>
                </div>
                <!--end row1-->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>

    <!-- /.content -->

</div>
<!-- /.content-wrapper -->